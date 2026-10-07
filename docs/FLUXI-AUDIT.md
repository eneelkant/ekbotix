# Fluxi Template Audit — Ekbotix

**Source:** `/template/` (READ-ONLY reference)  
**Production base:** LTR theme at `template/fluxi/fluxi/`  
**Date:** 2026-10-07

## Summary

The repository ships the **Fluxi SEO / Digital Marketing** PHP template (LTR + RTL + documentation). Ekbotix production code treats `/template/` as reference only: assets required at runtime are copied into `/assets/`, and no production PHP path may include `../template/`.

## Top-level structure

```text
template/
├── documentation/          # HTML docs + own assets (not used in production)
└── fluxi/
    ├── fluxi/              # LTR production reference ★
    └── fluxi - Rtl/        # RTL mirror (not used)
```

## LTR PHP architecture

| Path | Role |
|------|------|
| `layout/layout-top.php` | DOCTYPE, head include, optional header |
| `layout/layout-bottom.php` | Footer, sidebar, preloader, theme switcher, scripts |
| `partials/head.php` | Meta, favicon, CSS stack |
| `partials/header.php` | Sticky desktop nav + CTA |
| `partials/sideBar.php` | Mobile MetisMenu drawer |
| `partials/footer.php` | Multi-column footer + newsletter |
| `partials/script.php` | jQuery → Bootstrap → plugins → `main.js` |
| `partials/preLoader.php` | Loading overlay |
| `partials/themeMode.php` | Light/dark toggle |
| `partials/progress.php` | Scroll progress |
| `mailer.php` | Contact POST handler (basic sanitization) |

Pages include layout top/bottom or full head/header wrappers. Homepages: `index.php` … `index-eight.php` (agency variants).

## Navigation (template)

Desktop (`header.php`) and mobile (`sideBar.php`) share deep dropdowns:

- Home (8 demos)
- Pages (About, Team, FAQ, Demo, Audit, Pricing, 404)
- Services (+ detail pages)
- Work (Case Studies)
- Blog (multiple layouts)
- Contact

**Ekbotix replaces this** with a flat portfolio nav: Home, About, Experience, Projects, Expertise, AI Lab, Products, Insights, Resume, Contact. No Services mega-menu.

## CSS stack (`partials/head.php`)

1. `assets/css/plugins/swiper.min.css`
2. `assets/css/plugins/magnific-popup.css`
3. `assets/css/plugins/metismenu.css`
4. `assets/css/vendor/bootstrap.min.css`
5. `assets/css/plugins/fontawesome.min.css`
6. `assets/css/style.css` (~458KB compiled)

Also present (optional): AOS, Unicons, hover-reveal, animate, timepickers, Font Awesome 6.

**Design tokens** (`assets/scss/default/_variables.scss`):

- Primary `#614CE1`, secondary coral `#FF6354`
- Gradients, gray surfaces `#F8F9FB`, body `#4F4F55`
- Bootstrap grid + custom section/button/card patterns

SCSS mirrors element partials under `assets/scss/elements/` (banner, blog, footer, service, CTA, etc.).

## JavaScript stack (`partials/script.php`)

| Library | Purpose |
|---------|---------|
| jQuery | Core DOM / plugins |
| Bootstrap JS | Components |
| MetisMenu | Mobile accordion nav |
| jQuery UI | UI helpers |
| Waypoints | Scroll triggers |
| Swiper | Carousels |
| Theia Sticky Sidebar | Sticky columns |
| GSAP + ScrollTrigger | Motion |
| SplitText / SplitType | Headline splits |
| WAW | Animation helper |
| Counter-up | Number counts |
| Magnific Popup | Lightboxes |
| contact-form.js | AJAX contact |
| `main.js` | Theme behaviors |

## Fonts & icons

- Font Awesome (webfonts under `assets/fonts/`, CSS plugins)
- No Inter/Roboto requirement; theme uses template typography from compiled CSS

## Images

~341 image files under `assets/images/` including:

- `logo/` (SVG light/dark)
- `banner/`, `blog/`, `about/`, `service/`, `team/`, `brand/`, `testimonials/`, etc.
- `fav.png`, `error.png`

Production copies these into `/assets/images/` and adds Ekbotix logos.

## Forms

- Contact / audit / demo pages post via `contact-form.js` → `mailer.php`
- Template mailer: strip tags, email filter, `mail()` — **insufficient** for Ekbotix (needs CSRF, rate limits, header-injection protection)

## Blog layout

Reference: `blog-grid.php`, `blog-details.php`, `partials/blog.php`

- Grid of `single-blog-area-style-one` cards (thumbnail, title, author, date)
- Detail page: breadcrumb + article body + sidebar variants

## Responsive behavior

- Bootstrap breakpoints; sticky header; hamburger `#menu-btn` opens `#side-bar`
- Desktop menu hidden on smaller viewports; mobile MetisMenu

## Dependencies (runtime)

- PHP with includes (no Composer in template)
- Apache-friendly relative asset paths
- Browser JS as listed above

## Licensing notes

- Repository root `LICENSE` is **Apache-2.0** (covers this project’s own work as licensed by the owner).
- Fluxi is a third-party commercial HTML/PHP theme; keep `/template/` for reference and do not claim Fluxi authorship for Ekbotix brand content.
- Production assets under `/assets/` are migrated copies required for the adapted UI.

## Reusable for Ekbotix

| Keep / adapt | Drop / replace |
|--------------|----------------|
| CSS/JS/font/image asset pipeline | Agency mega-menus & “Services” |
| Header sticky + mobile drawer pattern | Pricing, free audit, book-a-demo CTAs |
| Blog card + detail layout | Fake metrics / client logos as “trust” |
| Button / section / breadcrumb classes | Newsletter spam traps without backend |
| 404 visual pattern | RTL tree |
| Bootstrap grid | Documentation site |

## Assets required for production

Copied from `template/fluxi/fluxi/assets/` → `/assets/`:

- `css/` (style + plugins + vendor)
- `js/` (main + plugins + vendor)
- `fonts/`
- `images/` (used UI imagery)
- `maps/` (if referenced)
- Plus `assets/css/ekbotix.css` and `assets/images/logo/ekbotix*.svg`

## Independence rule

Production must load if `/template/` is deleted. Verify with a repository search for `template/` in runtime paths before release.
