# Ekbotix — GitHub Pages portfolio

The static portfolio is published from this `docs/` directory.

## Sitemap

- `/` — Executive homepage
- `/about/` — Executive profile and operating principles
- `/expertise/` — MarTech architecture, lifecycle operations, lead routing and measurement
- `/case-studies/` — Anonymized illustrative engagement patterns
- `/stack/` — Technology landscape
- `/contact/` — Advisory and collaboration contact routes

## Local preview

From the repository root:

```bash
python3 -m http.server 8000 --directory docs
```

Open http://localhost:8000.

## Deployment

The workflow at `.github/workflows/pages.yml` publishes `docs/` to GitHub Pages on pushes to `main`. The repository project-site URL is:

https://eneelkant.github.io/ekbotix/

Check **Settings → Pages** and choose **GitHub Actions** as the source if Pages is not yet enabled. Monitor **Actions → Deploy GitHub Pages** for deployment status.

## Custom domain later

Add the chosen domain in **Settings → Pages → Custom domain**, configure the DNS records shown by GitHub at your registrar, wait for verification and enable HTTPS when available. Keep internal links relative so the site continues to work at the repository path and at a custom-domain root.

## Content integrity

- The 16-year experience positioning is based on the profile brief supplied for this website.
- Case studies are explicitly illustrative and anonymized, not represented as verified client engagements or testimonials.
- Quantified business outcomes, client names, certifications and credential levels are not published until substantiated and approved for public use.
- The stack page lists platforms and tools as a technology landscape, not as a claim of certification in each product.
- The contact page does not contain a fake/nonfunctional form. Add the exact LinkedIn profile and Calendly URLs when available.
- GitHub Pages is static hosting and does not execute PHP or process form submissions.

## Editing

- `docs/index.html` — homepage
- `docs/<page>/index.html` — individual pages
- `docs/assets/site.css` — shared styling
- `docs/assets/site.js` — shared navigation behavior
