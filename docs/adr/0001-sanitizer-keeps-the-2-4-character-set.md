---
status: accepted
---

# The settings sanitizer keeps the 2.4.x character set and drops only `<`

`seed_fonts_sanitize()` runs both when settings are saved and when the CSS is printed, so any character it stops allowing changes the CSS of existing sites on their next page view. The sanitizer shipped in 2.4.0 meant to allow only Thai, Latin letters, digits, `_ . ? ! -` and whitespace (2.4.2 added `,`), but the unescaped `-` in `.-\?` formed a character range that also lets `/ : ; < = >` through. That range is what allowed closing the `<style>` element (stored XSS on WordPress 6.9 and earlier), and it is also why Selectors such as `.nav > li` and `a:hover` keep working. In 2.4.3 we list those characters explicitly and drop only `<`: without `<`, a value cannot close the style element. Do not "fix" the regex by escaping the dash; that would also strip `>` and `:` and silently change existing sites' Selectors.

## Consequences

- Characters removed since 2.4.0 (`# [ ] * + ~ ( ) %`) are still removed. Restoring them, or sanitizing each field differently, changes the output of existing sites and is a separate decision for a later release.
