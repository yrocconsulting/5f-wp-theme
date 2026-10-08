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
| `.github/workflows/deploy.yml` | Deploys to staging over SSH on every push (also installs Contact Form 7, pinned to 6.1.7 because 6.2+ needs PHP 8.3) |
| `.github/workflows/diagnose.yml` | Read-only server checks (PHP, plugins, theme); run from the Actions tab |

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
| `CONTACT_EMAIL` | Optional: where contact form messages go (testing default: bradley@yrocconsulting.com) |

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
| `doves-lake` | Dove Hunting card and "The Hunting Area" | (composite: doves added to `geese-lake`) |
| `creek` | Open Range card | (photo in place) |
| `creek-bottom` | Open Range page and banner | (photo in place) |
| `stock-tank` | Dove Hunting banner | (photo in place) |
| `ranch-overview` | About the Ranch, Hunting & Fishing banner | (photo in place; house cropped out) |
| `headquarters` | About the Ranch banner (the 5F barn) | (photo in place) |
| `hog-hunt-1` | Open Range "Feral Hogs" card, hog post banner | `creek-bottom` |
| `hog-hunt-2`, `hog-hunt-3`, `hog-pair` | Open Range "From the Field" (portrait versions `*-portrait.jpg`), hog post | `creek-bottom` |

`doves-lake.jpg` is a composite: the dove silhouettes were added digitally to the lake photo. Replace it if a real dove photo becomes available.

On the next deploy, new photos are imported into the Media Library once and set as featured images (page banners) on pages that don't have one yet.

## Contact form

The deploy installs **Contact Form 7** and the setup script creates a form named *5F Ranch Contact*, which the Contact page shows in a styled card. Change fields or messages in WordPress under **Contact → Contact Forms**. The theme styles any field wrapped in `<p class="fivef-field">`; put two fields side by side inside `<div class="fivef-form-grid">`.

**Version pin:** Contact Form 7 6.2 and newer need PHP 8.3+ on the website. The site's PHP is older, so the deploy pins 6.1.7 and turns off auto-updates for the plugin. Don't click "Update" on Contact Form 7 until the site's PHP (SiteGround → Devs → PHP Manager) is 8.3 or newer. After that, change `CF7_VERSION` in `deploy.yml`.

## Blog: Field Notes

The blog lives at `/field-notes/` and is in the main menu. Write posts in WordPress under **Posts → Add New**:

- Give each post a **category** (such as *Game Birds* or *Big Game*). Categories appear as filter buttons on the blog page; a new category shows up once it has a post.
- Set a **featured image**. It's used for the card on the blog page and the banner on the post.
- The first paragraph is shown slightly larger as an intro, and the excerpt (or the first lines) appears on the card.
- The homepage shows the three newest posts automatically.

The starter posts come from `setup/posts/*.html`. Each file starts with a `<!-- fivef-post {...} -->` header (title, slug, category, tags, photo slot, excerpt). New files there are published on the next deploy. Posts already created are never overwritten, and deleted ones aren't re-created.
