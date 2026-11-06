# Ekbotix — GitHub Pages site

This directory is the static GitHub Pages version of the Ekbotix portfolio.

## Why this is separate from the PHP app

GitHub Pages serves static HTML, CSS, JavaScript and assets. It does **not** execute PHP, so the existing root PHP application, Email Verifier API and server-side contact form remain unchanged. The Pages site is a presentation-only portfolio; project links lead to source repositories or product code.

## Local preview

From the repository root:

```bash
python3 -m http.server 8000 --directory docs
```

Open http://localhost:8000.

## Deployment

The workflow at `.github/workflows/pages.yml` publishes this `docs/` directory whenever changes land on `main`.

1. Open repository **Settings → Pages**.
2. Under **Build and deployment**, select **GitHub Actions** as the source.
3. Merge the Pages site branch into `main` (or push changes to `docs/` on `main`).
4. Watch **Actions → Deploy GitHub Pages** until the workflow succeeds.
5. The expected project-site URL is https://eneelkant.github.io/ekbotix/

The workflow uses the official GitHub Pages artifact and deploy actions. No external hosting, PHP runtime or paid domain is required.

## Add a custom domain later

When ready, add the domain in **Settings → Pages → Custom domain**. GitHub will provide the DNS instructions for your chosen apex domain or subdomain. Configure the DNS records at your registrar, wait for DNS verification, then enable **Enforce HTTPS** when available.

The Pages workflow is configured with `BASE_PATH: /ekbotix` for the repository URL. For a custom domain at the site root, change this workflow variable to an empty string (or `/`) before publishing the domain version. Review canonical and sitemap URLs at that time.

## Editing content

Edit `docs/index.html` for copy and sections, `docs/assets/site.css` for design and `docs/assets/site.js` for behavior. Keep all internal asset links relative so the repository project path works. External social/profile links can be updated in the HTML.

## Scope

- Static portfolio and project showcase
- Responsive mobile navigation
- SEO title and description
- Open Graph metadata
- Reduced-motion support
- No secrets, API keys, contact-form backend or private data
