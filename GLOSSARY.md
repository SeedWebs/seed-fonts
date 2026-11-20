# Seed Fonts

Seed Fonts is a WordPress plugin that applies a chosen font to a site's headings and body text through CSS selectors.

## Language

### Fonts

**Bundled font**:
A font whose files ship inside the plugin package.
_Avoid_: built-in font, default font

**Custom font**:
A font the site owner adds as a folder with a `font.css`, in the active theme's `vendor/fonts/` or in `wp-content/uploads/fonts/`. It takes the place of a Bundled font with the same Font slug.
_Avoid_: uploaded font, own font

**Google font**:
A font loaded from the Google Fonts service by its family name instead of from the site.
_Avoid_: web font

**Font slug**:
The identifier of a Bundled or Custom font: its folder name and the font-family its `font.css` declares.
_Avoid_: font ID, font key

**Font name**:
The label of a font shown to the site owner; for a Google font, its exact family name.
_Avoid_: font title

**Weight**:
A numeric font weight from 100 to 900. A font declares the Weights it has files for.
_Avoid_: boldness

### Settings

**Heading font**:
The font applied to the heading Selectors (headings, navigation, buttons).
_Avoid_: header font, title font

**Body font**:
The font applied to the body Selectors, with its own size and line height.
_Avoid_: content font, text font

**Selector**:
The comma-separated CSS selectors that a Heading font or Body font applies to.
_Avoid_: target, elements

### Not part of Seed Fonts

**Font Library**:
WordPress core's own font manager (Appearance → Fonts since WordPress 7.0), separate from Seed Fonts.
_Avoid_: "Fonts menu"
