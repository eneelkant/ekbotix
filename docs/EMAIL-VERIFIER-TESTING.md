# Email Verifier Testing

## Automated

```bash
php products/email-verifier/tests/run-tests.php
```

Covers:

- Valid / malformed / missing `@` syntax
- Role account detection
- Disposable domain detection
- Classification for invalid + disposable
- No-MX domain → invalid
- SMTP disabled path → skipped

## Manual / environment

| Case | Expected |
|------|----------|
| Valid well-known domain, SMTP open | May return `safe`/`risky`/`unknown` depending on provider |
| SMTP blocked | `smtp.skipped`, reachability often `unknown` if MX ok |
| `mailinator.com` | `misc.is_disposable=true`, typically `risky` |
| `admin@…` | `misc.is_role_account=true` |
| GET to API | 405 |
| Missing CSRF | 403 |
| Oversized input | Truncated / rejected |
| Rate flood | 429 |

## Security checks

- No arbitrary host/port in request body
- No stack traces in JSON errors (production)
- Logs under `storage/logs/` without passwords

## Mock stance

CI must not depend on live mailbox providers. Prefer `EKBOTIX_SMTP_VERIFY=false` in constrained environments.
