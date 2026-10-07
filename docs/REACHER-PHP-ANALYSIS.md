# Reacher → PHP Analysis

**Upstream:** https://github.com/reacherhq/check-if-email-exists  
**Upstream language:** Rust (core + CLI + HTTP backend)  
**Ekbotix approach:** Independent PHP 8 implementation of the verification *pipeline and response shape*, not a line-by-line port.

## Upstream architecture

| Area | Upstream | Notes |
|------|----------|-------|
| Core crate | `core/` | `syntax`, `mx`, `smtp`, `misc`, rules |
| CLI | `cli/` | Local binary checks |
| HTTP backend | `backend/` | Docker-friendly API (`POST /v0/check_email`) |
| Extra | `rabbitmq/`, `sqs/` | Queue workers (SaaS-scale) |

Verification stages documented by upstream:

1. Syntax validation (+ optional suggestion)
2. MX / DNS accepts-mail
3. Disposable domain check
4. SMTP connect + RCPT deliverability
5. Mailbox disabled / full inbox signals
6. Catch-all detection
7. Role-account detection
8. Optional Gravatar / HIBP (misc)

Reachability enum: `safe` | `risky` | `invalid` | `unknown`.

## Feature mapping

| Feature | Status | Notes |
|---------|--------|-------|
| Syntax validation | **REPRODUCED** | PHP `FILTER_VALIDATE_EMAIL` + parse |
| Normalize / lowercase | **ADAPTED** | Trim, strip spaces, lower |
| Typo suggestion | **ADAPTED** | Small static map only (not full mailcheck) |
| MX lookup | **REPRODUCED** | `dns_get_record` / `getmxrr` |
| Disposable check | **ADAPTED** | Curated domain list (not upstream’s full set) |
| Role-account check | **ADAPTED** | Common role mailbox list |
| SMTP connect | **ADAPTED** | `stream_socket_client` :25, timeouts |
| RCPT deliverability | **ADAPTED** | Interpret 2xx/5xx; ambiguous → null |
| Catch-all probe | **ADAPTED** | Random local-part RCPT when deliverable |
| Full inbox / disabled | **ADAPTED** | Best-effort from SMTP text/codes |
| Reachability classify | **ADAPTED** | Same four labels; conservative unknown |
| Proxy support | **NOT REPRODUCED** | No SOCKS proxy input (security) |
| Headless Yahoo/Outlook specials | **NOT REPRODUCED** | Upstream provider-specific paths |
| Gravatar | **NOT REPRODUCED** | Out of scope |
| Have I Been Pwned | **NOT REPRODUCED** | Would need API keys / network policy |
| B2C provider list | **NOT REPRODUCED** | |
| RabbitMQ / SQS backends | **NOT APPLICABLE** | Portfolio product uses sync PHP API |
| Official Docker backend | **NOT APPLICABLE** | |

## Limitations

- Outbound port 25 often blocked → SMTP skipped → `unknown`.
- SMTP positive RCPT is **not proof** a mailbox exists long-term; greylisting and anti-probe defenses exist.
- Disposable list is incomplete by design.
- No claim of feature parity with Reacher.

## Testing stance

Unit/integration tests cover syntax, disposable, role, no-MX, SMTP-disabled paths. Live SMTP is environment-dependent and must not be required for CI green.
