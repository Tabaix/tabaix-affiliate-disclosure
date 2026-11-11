# Tabaix Affiliate Disclosure

A WordPress plugin that automatically prepends a standard affiliate disclosure to single blog posts that mention Amazon (affiliate links, product cards or ASINs) and do not already contain a disclosure anywhere in the post. No post content is edited or stored; the box is added at display time only, so deactivating this plugin removes it everywhere instantly.

Built for [tabaix.com](https://tabaix.com/). Free to use and share (GPL-2.0-or-later).

## Features

- **Automatic** — checks single blog posts for Amazon affiliate links, product cards or ASINs and adds the disclosure box above the content.
- **No duplicates** — if the post already contains a disclosure anywhere, nothing is added.
- **Nothing stored** — no post content is edited or saved. The disclosure is added at display time only; deactivating the plugin removes it from every post instantly.

## Requirements

- WordPress. No extra libraries — the plugin only uses core WordPress functions.

## Installation

1. Download the [latest release](https://github.com/Tabaix/tabaix-affiliate-disclosure/releases) (or clone this repo).
2. Upload the `tabaix-affiliate-disclosure` folder to `/wp-content/plugins/`, **or** in WP Admin go to **Plugins > Add New > Upload Plugin** and install the ZIP.
3. Activate **Tabaix Affiliate Disclosure**. There is no settings page — it works as soon as it is active.

## Usage

Publish a post that links to Amazon (or contains a product card or an ASIN) and the disclosure appears at the top of the post. Posts without any Amazon mention are untouched.

## FAQ

**I removed the plugin and the disclosure is still on my posts. Why?**
It should not be — the disclosure is never written into post content. If a post still shows one, it is a cached page: purge the site cache and reload.

**Can I change the disclosure text?**
The text is fixed in `tabaix-affiliate-disclosure.php` (one string near the top of the file). Edit it there if your wording needs to differ.

## Links

- [tabaix.com](https://tabaix.com/)
- [Tabaix agency portfolio](https://agency.tabaix.com/portfolio/)

## Changelog

### 1.0.1

- Current release, as installed on tabaix.com.

## License

GPL-2.0-or-later — see https://www.gnu.org/licenses/gpl-2.0.html
