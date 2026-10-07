# Reacher Licensing Review

## Upstream license

[reacherhq/check-if-email-exists](https://github.com/reacherhq/check-if-email-exists) uses a **dual license model**:

1. **AGPL-3.0** (`LICENSE.AGPL`) for open-source use compatible with AGPL.
2. **Commercial license** for proprietary/commercial products (see Reacher pricing / docs).

GitHub reports `license.spdx_id: NOASSERTION` because of this dual model (`LICENSE.md` explains it).

## What Ekbotix reused

| Item | Reused? |
|------|---------|
| Rust source code | **No** — not copied |
| Upstream disposable/role text files | **No** — independently curated lists |
| API response *shape* (field names) | **Yes** — as technical interoperability reference |
| Verification *stage concepts* | **Yes** — documented publicly in upstream README |
| Trademarks / “Reacher” branding as product name | **No** |

## What was independently implemented

All PHP under `products/email-verifier/src/` is original Ekbotix code implementing similar stages (syntax, MX, SMTP probe, disposable, role, classification).

## Attribution requirements

- Product UI and README link to the upstream repository and state this is **not official Reacher**.
- Do not imply sponsorship or endorsement by Reacher maintainers.
- Do not distribute modified AGPL Rust sources without complying with AGPL.

## Notices

- Files containing third-party *code*: none from Reacher.
- Conceptual reference: documented in `docs/REACHER-PHP-ANALYSIS.md` and product page “Open Source Foundation”.

## Repository LICENSE

The Ekbotix repository root `LICENSE` is Apache-2.0 as provided by the owner. Fluxi template assets remain third-party theme materials under their original license terms; keep `/template/` as reference and migrated copies under `/assets/` for the adapted UI.
