# Ekbotix Email Verifier

Independent PHP 8 email verification product for CRM and marketing automation workflows.

**Not official Reacher software.** Technical reference: [reacherhq/check-if-email-exists](https://github.com/reacherhq/check-if-email-exists).

## Endpoints

- UI: `/products/email-verifier`
- API: `POST /products/email-verifier/api/verify.php`

Request:

```json
{ "to_email": "someone@example.com", "_csrf": "..." }
```

CSRF token is required (session cookie + `_csrf` / `X-CSRF-Token`).

## Pipeline

Normalize → syntax → DNS/MX → SMTP (optional) → catch-all probe → disposable → role account → classify (`safe` | `risky` | `invalid` | `unknown`).

SMTP never sends mail. Ambiguous responses yield `unknown`.

## Hosting requirements

| Capability | Required | Notes |
|------------|----------|-------|
| PHP 8.x | Yes | `filter`, `json`, sockets |
| DNS resolution | Yes | `dns_get_record` / `getmxrr` |
| Outbound TCP 25 | Optional | Many cloud hosts block it |

If port 25 is blocked, set `EKBOTIX_SMTP_VERIFY=false` or accept `smtp.skipped` with `is_reachable: unknown` when MX exists.

Env vars:

- `EKBOTIX_SMTP_VERIFY` — `true`/`false`
- `EKBOTIX_SMTP_HELO` — HELO/EHLO domain

## Security

- POST only
- CSRF
- Rate limiting
- Max input length
- Timeouts
- No user-controlled host/port
- No shell execution
- Structured logging without secrets

## Tests

```bash
php products/email-verifier/tests/run-tests.php
```

## License / attribution

See `docs/REACHER-LICENSE.md`. This PHP code is an independent implementation; Reacher’s AGPL/commercial dual license applies to *their* codebase, not to a clean-room reimplementation. Do not copy Reacher Rust sources into this tree.
