# AGENTS.md — Ekbotix

Guidance for coding agents working on this repository.

## Product

Ekbotix is a **personal professional portfolio** for Neelkant E. (AI & Marketing Automation Specialist), plus a working Email Verifier product. It is **not** a marketing agency site.

## Hard rules

1. `/template/` is **READ-ONLY reference**. Never modify it. Production must not depend on it at runtime.
2. Root entry point is `/index.php` (no `index.html` redirect).
3. Do not invent employers, dates, or metrics — use `[VERIFY]` / `[VERIFY METRIC]`.
4. Do not claim official Reacher status for the Email Verifier.
5. Never commit secrets (API keys, tokens, passwords).

## Stack

- PHP 8.x front controller (`app/router.php`)
- Apache `.htaccess` clean URLs
- Fluxi-derived assets under `/assets/`
- Email Verifier under `products/email-verifier/`

## Local run

```bash
php -S 0.0.0.0:8080 router-dev.php
```

## Tests

```bash
find . -name '*.php' -not -path './template/*' -print0 | xargs -0 -n1 php -l
php products/email-verifier/tests/run-tests.php
```

## Docs

- `docs/FLUXI-AUDIT.md`
- `docs/REACHER-PHP-ANALYSIS.md`
- `docs/REACHER-LICENSE.md`
- `docs/EMAIL-VERIFIER-TESTING.md`
