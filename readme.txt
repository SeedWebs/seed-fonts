=== Seed Fonts ===
Contributors: SeedThemes
Donate link: http://seedthemes.com/
Tags: webfont,web fonts, @font-face embed, typography
Requires at least: 4.0
Tested up to: 5.5.1
Stable tag: 2.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use web fonts (@font-face) by choosing from Google Fonts, Bundled Thai-English fonts, and your own web fonts.

== Description ==

Seed Fonts is WordPress plugin that helps you use web fonts (@font-face embed) easier. You can use by

1. Google Fonts
2. Bundled Thai-English fonts
3. Your own web fonts. (Upload to /wp-content/upload/fonts/FontName/ or /wp-content/themes/ThemeName/vendor/fonts/FontName/.)

The GitHub repository can be found at <a href="https://github.com/SeedThemes/seed-fonts" target="_blank">https://github.com/SeedThemes/seed-fonts</a>. 


== Installation ==


1. Upload the plugin files to the `/wp-content/plugins/seed-fonts` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Go to Appearance -> Fonts to set you web fonts. Thais use รูปแบบเว็บ -> ฟอนต์


== Frequently Asked Questions ==

= How to generate and upload my own web fonts? =

Please see <a href="https://www.seedthemes.com/plugin/seed-fonts/#upload-your-fonts" target="_blank">https://www.seedthemes.com/plugin/seed-fonts/#upload-your-fonts</a>.

== Screenshots ==

1. Settings: Heading Font.
1. Settings: Body Font.


== Changelog ==

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

= 2.0.0 =
* Now support Google Fonts. You can choose any font and weight.
* Remove old bundled Google Fonts.
* Add new fonts - Noto Sans Thai, Noto Serif Thai and Sarabun.
* Remove old font - TH Sarabun New.