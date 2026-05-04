# theme_lore

Modern, accessible Moodle theme based on Boost.

## Features

- Customisable hero section on the front page
- Personalised student dashboard with course progress grid
- Accessibility toolbar (font size, contrast modes, OpenDyslexic font)
- Mega menu for primary navigation
- Custom login page with brand identity
- Full compatibility with third-party plugins (no icon greyscale issues)
- CSS custom properties contract for ecosystem plugins (`block_playerhud`, etc.)

## Requirements

- Moodle 5.1 or later
- PHP 8.2 or later
- Parent theme: Boost (included in Moodle core)

## Installation

1. Copy the `lore` folder to `<moodle>/theme/lore/`
2. Log in as administrator
3. Navigate to **Administration → Appearance → Themes → Theme selector**
4. Activate **Lore**
5. Configure the theme at **Administration → Appearance → Themes → Lore**

## Configuration

All settings are available under **Administration → Appearance → Themes → Lore**:

- **General** — logo, favicon, site name and slogan
- **Colours** — primary colour, secondary colour, hero background
- **Front page** — hero title, subtitle, call-to-action button
- **Dashboard** — maximum courses in grid, show grade, show last access
- **Accessibility** — enable accessibility toolbar, enable OpenDyslexic font
- **Advanced CSS** — free SCSS field for site-specific customisations

## Development

After editing any file in `amd/src/`, rebuild with:

```bash
grunt amd --root=<path-to-theme-lore>
```

Then commit the generated `amd/build/` files.

## Licence

GNU General Public License v3 or later — see [COPYING.txt](COPYING.txt)

## Author

Jean Lúcio — 2026
