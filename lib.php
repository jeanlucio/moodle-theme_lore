<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Theme Lore library functions.
 *
 * @package theme_lore
 * @copyright 2026 Jean Lúcio
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Returns the main SCSS content for the theme (imports lore.scss).
 *
 * @param theme_config $theme The theme configuration.
 * @return string SCSS content.
 */
function theme_lore_get_main_scss_content(\theme_config $theme): string {
    global $CFG;

    $scss = '';

    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : 'lore';
    $fs = get_file_storage();
    $context = context_system::instance();

    if ($filename === 'lore') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/lore/scss/lore.scss');
    } else {
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }

    return $scss;
}

/**
 * Returns SCSS to prepend — injects Bootstrap/Boost variable overrides from admin settings.
 *
 * @param theme_config $theme The theme configuration.
 * @return string SCSS variable declarations.
 */
function theme_lore_get_pre_scss(\theme_config $theme): string {
    $scss = '';

    $colorprimary = !empty($theme->settings->colorprimary) ? $theme->settings->colorprimary : '#0f6cbf';
    $colorsecondary = !empty($theme->settings->colorsecondary) ? $theme->settings->colorsecondary : '#6c757d';
    $colorherobg = !empty($theme->settings->colorherobg) ? $theme->settings->colorherobg : '#0f6cbf';

    $scss .= '$primary: ' . $colorprimary . ";\n";
    $scss .= '$secondary: ' . $colorsecondary . ";\n";
    $scss .= '$hero-bg: ' . $colorherobg . ";\n";

    return $scss;
}

/**
 * Returns extra SCSS to append — the admin's free custom SCSS field.
 *
 * @param theme_config $theme The theme configuration.
 * @return string Raw SCSS entered by the administrator.
 */
function theme_lore_get_extra_scss(\theme_config $theme): string {
    $content = '';

    if (!empty($theme->settings->rawscss)) {
        $content .= "\n" . $theme->settings->rawscss;
    }

    return $content;
}
