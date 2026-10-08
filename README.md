# 5F Ranch: WordPress block theme

Custom block theme and site setup for **5F Ranch** (Alvord, Texas).
Staging: https://5f.yroc.host/

## What's here

| Path | What it is |
| --- | --- |
| `5f-ranch/` | The theme (this folder is what gets uploaded to `wp-content/themes/`) |
| `5f-ranch/theme.json` | Brand colours, fonts, spacing and block defaults |
| `5f-ranch/patterns/` | Page sections and full-page layouts (insert from the **5F Ranch** pattern categories) |
| `5f-ranch/assets/images/` | Vector logos (SVG) and placeholder art |
| `5f-ranch/assets/photos/` | Ranch photos, one file per slot (see below) |
| `setup/site-setup.php` | Creates pages, the main menu, front page and featured images (safe to re-run) |
| `tools/process-photo.sh` | Resizes and colour-grades a photo into a slot |
| `.github/workflows/deploy.yml` | Deploys to staging over SSH on every push (also installs Contact Form 7) |

## Brand

- **Colours:** Ranch Brown `#4A2C17`, Texas Tan `#D9C8A9`, Field Green `#4F6B3E`, Sky Blue `#2F5D8A`, Iron Gray `#3A3A3A`, plus Sunset Gold, Parchment, Pine and Charcoal for the dark rustic look.
- **Fonts (self-hosted):** Cinzel for headings (Trajan-style), Montserrat for body text, Yellowtail as a script accent.
- **Logos:** `logo-mark-*`, `logo-horizontal-*` and `logo-stacked-*`, each in `brown` and `cream`. They were redrawn as vectors from the approved concept and are a close match. The designer's final vector files can replace them under the same file names.

## Editing the site in WordPress

- **Pages:** Pages → edit any page. Content is normal blocks.
- **New page:** Pages → Add New, then open the inserter (+) → Patterns → **5F Ranch** to drop in hero, cards, CTA bands and other sections.
- **Menu:** Appearance → Editor → Navigation → **Main Menu**. Header and footer both use it.
- **Header/footer:** Appearance → Editor → Patterns → Template Parts.
- **Block styles:** select a block → Styles. Groups have *Paper card*, *Ticket* and *Hover card*; headings have *Eyebrow*, *Ruled* and *Script*; images have *Torn edge*; lists have *Gold checks*.

## Deploying

Every push that touches `5f-ranch/` or `setup/` runs **Deploy to staging**. It can also be run by hand from the Actions tab → *Deploy to staging* → *Run workflow*.

Repository secrets (Settings → Secrets and variables → Actions):

| Secret | Example |
| --- | --- |
| `SSH_HOST` | SiteGround SSH hostname from Site Tools → Devs → SSH Keys Manager |
| `SSH_USER` | SiteGround SSH username |
| `SSH_PORT` | `18765` (the default if left empty) |
| `SSH_PRIVATE_KEY` | Private key text |
| `SSH_KEY_PASSPHRASE` | Only if the key has a passphrase (SiteGround-generated keys do) |
| `WP_PATH` | `~/www/5f.yroc.host/public_html` |
| `CONTACT_EMAIL` | Optional: where contact form messages go (defaults to the WordPress admin email) |

No WordPress username or password is needed: the deploy runs WP-CLI on the server over SSH.

The setup script only **creates** things that are missing. It never overwrites a page, menu or image edited in WordPress, and it won't re-create a page that was deleted.

## Photos

Each slot is a file in `5f-ranch/assets/photos/<slot>.jpg`. Until a slot has a photo, the layout uses a placeholder. Add or replace one with:

```sh
tools/process-photo.sh ~/Downloads/DJI_0042.JPG aerial-ponds
```

| Slot | Used for | Until it has its own photo, uses |
| --- | --- | --- |
| `aerial-ponds` | Home hero, Fishing card, Contact banner | (photo in place) |
| `long-pond` | "Why weekends only", Fishing | (photo in place) |
| `quarry-lake` | Home intro, Fishing (wide) | (photo in place) |
| `geese-lake` | Fishing, Fishing banner | (photo in place) |
| `doves-lake` | Dove Hunting card, page and banner | (composite: doves added to `geese-lake`) |
| `creek` | Open Range card | (photo in place) |
| `creek-bottom` | Open Range page and banner | `creek` |
| `stock-tank` | spare dove-habitat slot | `doves-lake` |
| `ranch-overview` | About the Ranch, Hunting & Fishing banner | `aerial-ponds` |
| `headquarters` | About the Ranch (the 5F barn) | `quarry-lake` |

`doves-lake.jpg` is a composite: the dove silhouettes were added digitally to the lake photo. Replace it if a real dove photo becomes available.

On the next deploy, new photos are imported into the Media Library once and set as featured images (page banners) on pages that don't have one yet.

## Contact form

The deploy installs **Contact Form 7** and the setup script creates a form named *5F Ranch Contact*, which the Contact page shows in a styled card. Change fields or messages in WordPress under **Contact → Contact Forms**. The theme styles any field wrapped in `<p class="fivef-field">`; put two fields side by side inside `<div class="fivef-form-grid">`.
