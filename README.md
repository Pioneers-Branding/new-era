# Anew Era TMS & Psychiatry — Landing Page

Conversion-focused landing page for Anew Era TMS & Psychiatry. Single PHP
template rendered to static HTML for hosting on Netlify.

## Layout

```
LP/
  index.php          the page — content arrays at the top, markup below
  build.php          renders index.php to LP/dist/ and copies assets
  assets/
    photos/          photography, named <unsplash-id>-<w>x<h>.jpg
    insurances/      carrier logos
    logo/            brand logo + generated white-knockout variant
    bg-image/        neurons hero background
    tms-device/      Magstim Horizon product shot
    location/        clinic interior photo
netlify.toml         build config (base = LP, publish = dist)
```

## Local development

```bash
cd LP
php -S localhost:8000       # then open http://localhost:8000
```

## Build

```bash
cd LP
php build.php               # writes LP/dist/
```

The build renders each page in `$pages`, rewrites internal `.php` links to
`.html`, copies `assets/`, then verifies every local `src`/`href` it emitted
actually exists in `dist/`.

## Editing content

Everything editable lives in the arrays at the top of `index.php`:

| Variable       | Controls                                             |
| -------------- | ---------------------------------------------------- |
| `$PHONE`       | Phone number, used in every CTA                      |
| `$conditions`  | Conditions-treated cards (title, copy, image id)      |
| `$services`    | Service cards (title, copy, bullets, image, fit)      |
| `$steps`       | "How it works" timeline                              |
| `$mechanism`   | The three-stage TMS explainer                        |
| `$reviews`     | Patient review cards                                 |
| `$insurers`    | Accepted carriers (name, logo file, note)            |
| `$faqs`        | FAQ accordion                                        |

Images resolve through `img($id, $w, $h)`, which maps to
`assets/photos/<id>-<w>x<h>.jpg`. Nothing is loaded from a third-party image
CDN at render time.

## Known follow-ups

- **The consultation form POSTs to itself**, which a static host cannot
  process. Before launch, either add `data-netlify="true"` plus a hidden
  `form-name` field to use Netlify Forms, or point `action=` at a CRM endpoint.
- **`privacy.php` and `terms.php` do not exist yet.** The footer links to them
  and they are listed in `build.php`, where they skip with a warning.
- **Photography is licensed stock** apart from the clinic interior, the Magstim
  device and the logo. Replace with real practice photography before launch.
- **Star ratings are not shown on reviews** — the source data did not include
  per-review ratings.
