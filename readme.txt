=== Seed Fonts ===
Contributors: seedwebs
Tags: fonts, google fonts, thai, typography, webfont
Requires at least: 4.9
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 2.4.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Use web fonts (@font-face) by choosing from Google Fonts, Bundled Thai-English fonts, and your own web fonts.

== Description ==

Seed Fonts is WordPress plugin that helps you use web fonts (@font-face embed) easier. You can use by

1. Google Fonts
2. Bundled Thai-English fonts
3. Your own web fonts. (Upload to /wp-content/uploads/fonts/fontname/ or /wp-content/themes/ThemeName/vendor/fonts/fontname/ - lowercase is recommended.)

The GitHub repository can be found at <a href="https://github.com/SeedWebs/seed-fonts" target="_blank">https://github.com/SeedWebs/seed-fonts</a>. 


== Installation ==


1. Upload the plugin files to the `/wp-content/plugins/seed-fonts` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Go to Appearance -> Seed Fonts to set your web fonts. Thais use รูปแบบเว็บ -> Seed Fonts


== Frequently Asked Questions ==

= How to generate and upload my own web fonts? =

Please see <a href="https://docs.seedwebs.com/article/90-upload-custom-fonts" target="_blank">https://docs.seedwebs.com/article/90-upload-custom-fonts</a>.

== External services ==

This plugin can load fonts from Google Fonts, a web font service provided by Google LLC. It only does so if you turn on "Use Google Fonts?" for the heading font and/or the body font in Appearance -> Seed Fonts. This option is off by default. Bundled fonts and fonts you upload to your own site are always served from your own site.

When Google Fonts is turned on, every front-end page of your site (and the block editor screens) loads a stylesheet from fonts.googleapis.com, and the visitor's browser then downloads the font files from fonts.gstatic.com. With these requests Google receives the visitor's IP address and browser user agent, the address of your site (as the HTTP referrer), and the font family and weight you selected. The plugin does not send any other data to Google and makes no server-side requests.

* Google Fonts: https://fonts.google.com/
* Google Fonts privacy FAQ: https://developers.google.com/fonts/faq/privacy
* Google Terms of Service: https://policies.google.com/terms
* Google APIs Terms of Service: https://developers.google.com/terms
* Google Privacy Policy: https://policies.google.com/privacy

The settings screen also contains plain links to fonts.google.com (to look up font names) and to the plugin documentation at docs.seedwebs.com. These pages are only opened if you click the links; nothing is sent automatically.

== Font credits ==

The following bundled fonts are used under open licenses. Each font folder contains the full license text.

* Anuphan by Mike Abbink, Paul van der Laan, Pieter van Rosmalen and Mint Tantisuwanna: SIL Open Font License 1.1
* Boon by Sungsit Sawaiwan (FontUni): SIL Open Font License 1.1
* IBM Plex Thai by IBM Corp.: SIL Open Font License 1.1
* Noto Sans Thai and Noto Serif Thai by Google: SIL Open Font License 1.1
* Sarabun by The Sarabun Project Authors: SIL Open Font License 1.1
* CS PraJad and CS Chatthai UI by Chanok Samiti: Creative Commons Attribution 4.0 (https://creativecommons.org/licenses/by/4.0/), converted to WOFF2

== Screenshots ==

1. Settings: Heading Font.
1. Settings: Body Font.


== Changelog ==

= 2.4.3 =
* Date: 20 NOV 2026
* Security: Fix a stored XSS in the settings that the 2.4.0 fix did not fully close (WordPress 6.9 and earlier; needs an administrator account).
* Security: Escape all output on the settings page and block direct access to the plugin file.
* Fix: PHP 8.1+ "Deprecated" notice when saving the settings.
* Fix: Fatal error when a custom fonts folder cannot be read.
* Fix: Boon no longer requests the missing 300 and 700 weight files (404).
* Fix: The Generated CSS preview showed "san-serif".
* Tweak: The menu is now Appearance -> Seed Fonts, so it no longer looks like the Fonts menu of WordPress 7.0+. The page address is unchanged.
* Tweak: Font folders are no longer scanned on every front-end page.
* Tweak: Font CSS URLs carry the plugin version (or the file date for custom fonts) instead of the WordPress version. Google Fonts URLs no longer include it.
* Tweak: License is GPLv2 or later everywhere. Added font credits, font license files and an External services section.
* Tweak: Requires WordPress 4.9 and PHP 7.4. Tested up to WordPress 7.1.

= 2.4.2 =
* Date: 8 AUG 2023
* Fix: Allow "," symbol in all settings.

= 2.4.1 =
* Date: 8 AUG 2023
* Fix: Allow "," symbol in settings.

= 2.4.0 =
* Date: 30 JUL 2023
* Fix: Cross Site Scripting (XSS)

= 2.3.1 =
* Date: 16 JUL 2021.
* New: iannnnn-Duck font.
* Tweak: Change Git repo to SeedWebs.
* Readme update (7 NOV 2022): Change to Seed Webs and update Tested up to WordPress 6.1.

= 2.3.0 =
* Date: 5 JUL 2021.
* New: Chulabhornlikit Display and Chulabhornlikit Text fonts.
* Tweak: Remove woff files. Drop support for IE.

= 2.2.0 =
* Date: 6 SEP 2020.
* New: Using font in WordPress Admin Editor (Gutenburg);
* New: Anuphan font.
* New: Optimize Loading Speed by using font-display: swap / fallback.
* Tweak: Add CSS Variables (--s-heading, --s-body, --s-body-line-height) on both backend and frontend.

= 2.1.1 =
* Date: 10 OCT 2019
* New: IBM Plex Thai font.

= 2.1.0 =
* New: Anakotmai font.

= 2.0.0 =
* Now support Google Fonts. You can choose any font and weight.
* Remove old bundled Google Fonts.
* Add new fonts - Noto Sans Thai, Noto Serif Thai and Sarabun.
* Remove old font - TH Sarabun New.

= 1.1.3 =
* Add Moonjelly and CS Chatthai UI fonts.
* Remove old font files (.eot and .ttf). Now using only .woff and .woff2.
* Now we can upload fonts to /wp-content/uploads/fonts/FONT-NAME.

= 1.1.2 =
* Fix Boon font error loading.

= 1.1.1 =
* Fix Body CSS when unchecking the heading font.
* Add font size and font size unit for body font
* Change custom fonts handler from replacing the defaults to adding all fonts together.

= 1.1.0 =
* Add body font settings and more Thai Loop fonts.

= 1.0.1 =
* Fix PHP short form tags.

= 1.0.0 =
* Use Settings API.
* Fix double trailing slash after plugin_dir_url().
* Add body class (.seed-fonts-FONT-NAME).
* Optimize code.

= 0.9.5 =
* First public version.


== Upgrade Notice ==

= 2.4.3 =
Security update: fixes a stored XSS in the settings that 2.4.0 did not fully fix (WordPress 6.9 and earlier). The menu is now Appearance -> Seed Fonts. Requires WordPress 4.9 and PHP 7.4.

= 2.0.0 =
* Now support Google Fonts. You can choose any font and weight.
* Remove old bundled Google Fonts.
* Add new fonts - Noto Sans Thai, Noto Serif Thai and Sarabun.
* Remove old font - TH Sarabun New.