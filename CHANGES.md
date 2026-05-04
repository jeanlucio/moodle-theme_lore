# Changelog — theme_lore

## v0.1.0 (2026-05-04)

Initial alpha release — Phase 1: installable skeleton.

- Core plugin structure: `version.php`, `config.php`, `lib.php`
- Theme inherits from Boost; declares only the layouts it customises
- Three SCSS callback functions (`prescsscallback`, `scss`, `extrascsscallback`)
- SCSS base layer: `_variables.scss`, `_navbar.scss`, `_cards.scss`, `_compat.scss`
- CSS custom properties contract for ecosystem plugins (`--lore-color-primary`, etc.)
- Language strings for EN and PT-BR (all F1–F7 strings pre-declared in alphabetical order)
- Privacy provider: `null_provider` (all accessibility preferences stored in localStorage only)
- Drawers layout inheriting Boost structure
- Placeholder `pix/favicon.ico` and `pix/screenshot.png`
