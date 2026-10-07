# Ekbotix

Personal professional portfolio and interactive online resume for **Neelkant E.** — **AI & Marketing Automation Specialist**.

> Building intelligent systems that turn repetitive work into automated workflows.

Career arc: Digital Marketing → Marketing Automation → CRM & MarTech → Data & Analytics → AI Automation → AI Agents.

This is **not** a marketing agency website. Ekbotix is a personal technology/product brand with real portfolio pages and a working **Email Verifier** product.

## Requirements

- PHP 8.x (`php-cli`, `curl`/`sockets` recommended, `mbstring`)
- Apache with `mod_rewrite` **or** PHP built-in server for local dev
- Outbound DNS; outbound TCP 25 optional (SMTP verification)

## Local setup

```bash
git clone https://github.com/eneelkant/ekbotix.git
cd ekbotix
php -S 0.0.0.0:8080 router-dev.php
```

Open `http://localhost:8080/`.

### Apache

Point the document root at this repository. `.htaccess` routes clean URLs to `index.php`.

### Environment (optional)

| Variable | Purpose |
|----------|---------|
| `EKBOTIX_BASE_URL` | Absolute site URL for canonicals (e.g. `https://example.com`) |
| `EKBOTIX_CONTACT_EMAIL` | Contact form recipient |
| `EKBOTIX_SMTP_VERIFY` | `true`/`false` email verifier SMTP probes |
| `EKBOTIX_SMTP_HELO` | SMTP EHLO domain |
| `EKBOTIX_LINKEDIN` | Optional LinkedIn URL |
| `EKBOTIX_ENV` | `production` / `development` |

## Directory structure

```text
index.php                 Front controller
.htaccess                 Clean URL routing
app/                      Config, router, security, helpers, data
pages/                    Page views
components/               Header, nav, footer, cards
assets/                   CSS/JS/images/fonts (production copies)
products/email-verifier/  PHP verification product + API + tests
blog/                     Insight article bodies
docs/                     Audits and licensing
template/                 READ-ONLY Fluxi reference (not required at runtime)
```

## Products

### Email Verifier

- UI: `/products/email-verifier`
- API: `POST /products/email-verifier/api/verify.php`
- Docs: `products/email-verifier/README.md`, `docs/REACHER-*.md`

Independent PHP implementation referencing [Reacher check-if-email-exists](https://github.com/reacherhq/check-if-email-exists) for stages and JSON shape. **Not official Reacher.**

## Testing

```bash
# Lint all production PHP
find . -name '*.php' -not -path './template/*' -print0 | xargs -0 -n1 php -l

# Email verifier suite
php products/email-verifier/tests/run-tests.php
```

## Template independence

`/template/` may be deleted without breaking production. Assets live under `/assets/`.

## Licensing

- Project `LICENSE`: Apache-2.0 (repository root)
- Fluxi theme: third-party reference under `/template/`
- Reacher: dual AGPL/commercial — see `docs/REACHER-LICENSE.md` (no Rust sources vendored)

## Agent notes

See `AGENTS.md`.
