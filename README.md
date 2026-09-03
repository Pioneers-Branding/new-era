# Anew Era TMS & Psychiatry — Landing Pages

Conversion-focused landing pages for Anew Era TMS & Psychiatry. Each one is a
self-contained folder holding its own PHP template, build script and assets,
rendered to static HTML for hosting on Netlify.

| Folder        | Page                                                    |
| ------------- | ------------------------------------------------------- |
| `tms/`        | TMS therapy for depression, anxiety and PTSD            |
| `psychiatry/` | Psychiatric evaluation, medication management, therapy  |

Add a landing page by copying an existing folder and editing its content
arrays. Netlify builds one `base` per site, so a new page needs either its own
Netlify site pointed at its folder, or a root build script that renders every
folder into a single `dist/` under separate paths.

## Layout

Both folders share the same components and brand system; what differs between
them lives in the content arrays at the top of each `index.php`, plus one
section — `#tms` on the TMS page, `#approach` on the psychiatry page.

```
tms/
  index.php          the landing page — content arrays at the top, markup below
  thank-you.php      post-submission page
  build.php          renders each page in $pages to dist/ and copies assets
  favicon.png        generated from the logo mark
  apple-touch-icon.png
  assets/
    photos/          photography, named <unsplash-id>-<w>x<h>.jpg
    insurances/      carrier logos
    insurance-check/ staging artwork, tracked but not published
    logo/            brand logo + generated white-knockout variant
    bg-image/        hero background
    tms-device/      TMS treatment photography
    location/        clinic interior photo
netlify.toml         build config (base = tms, publish = dist)
```

## Brand colours

Sampled from `tms/assets/logo/new-era-logo.webp`. These three are the logo
itself — everything else on the site is derived from them.

| Role         | Hex       | Where it appears in the logo                    |
| ------------ | --------- | ----------------------------------------------- |
| Ocean blue   | `#0F639B` | "Anew" wordmark, "TMS & Psychiatry" tagline, the blue rays of the burst |
| Orange       | `#E8922F` | "Era" wordmark, the orange rays of the burst     |
| Leaf green   | `#86BE52` | the green rays of the burst                      |

Supporting tints and shades used across the site:

| Role                | Hex       | Use                                    |
| ------------------- | --------- | -------------------------------------- |
| Navy (deep)         | `#0F2440` | headings, footer, dark sections        |
| Navy (darkest)      | `#0A1A30` | hero overlay, deepest backgrounds      |
| Navy (mid)          | `#1B3A63` | secondary dark surfaces                |
| Blue (action)       | `#1D4ED8` | primary buttons, links                 |
| Blue (hover)        | `#2563EB` | button hover                           |
| Blue (light)        | `#BFD5FE` | badges, outlines on dark               |
| Blue (tint)         | `#EFF5FF` | section backgrounds                    |
| Cyan accent         | `#0EA5E9` | gradients, small accents               |
| Body text           | `#475569` | paragraph copy                         |
| Muted text          | `#8494AB` | captions, footnotes                    |
| Border              | `#E2E8F0` | card and divider borders               |
| Off-white           | `#F4F6F9` | alternating section background         |

Note: the landing page currently runs blue-only — the logo's orange and green
are not used anywhere on it. Decide deliberately whether the homepage picks
them up as accents or keeps the same blue-only system.

## Local development

```bash
php -S localhost:8000 router.php     # from the repo root
```

Then open `http://localhost:8000/tms/` or `http://localhost:8000/psychiatry/`.

`router.php` matters. Asset paths in each page are relative, which is what lets
the same markup work at any deploy path — the pages are published under
`/inquire/tms/` and `/inquire/psychiatry/`. PHP's built-in server will serve
`psychiatry/index.php` for the URL `/psychiatry` but, unlike a real server, it
does not redirect to `/psychiatry/` first. Without that redirect the browser
resolves every relative asset one level too high and the page renders with all
images broken. The router restores the redirect. Start the server without it and
the missing trailing slash will break every image on the page.

## Build

```bash
cd tms
php build.php               # writes tms/dist/
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
