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

    // Always start with Boost's preset so Bootstrap and all core Moodle
    // SCSS variables (e.g. $font-family-base) are available to our partials.
    $scss = file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    $scss .= file_get_contents($CFG->dirroot . '/theme/lore/scss/lore.scss');

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

    // Colour variables.
    $colorprimary = !empty($theme->settings->colorprimary) ? $theme->settings->colorprimary : '#0f6cbf';
    $colorsecondary = !empty($theme->settings->colorsecondary) ? $theme->settings->colorsecondary : '#6c757d';
    $colorherobg = !empty($theme->settings->colorherobg) ? $theme->settings->colorherobg : '#0f6cbf';

    $scss .= '$primary: ' . $colorprimary . ";\n";
    $scss .= '$secondary: ' . $colorsecondary . ";\n";
    $scss .= '$hero-bg: ' . $colorherobg . ";\n";

    // Hero background image URL (injected as SCSS variable for use in _frontpage.scss).
    $heroimageurl = theme_lore_get_setting_file_url('heroimage');
    if ($heroimageurl) {
        $scss .= '$hero-image-url: url("' . $heroimageurl . '");' . "\n";
    } else {
        $scss .= '$hero-image-url: none;' . "\n";
    }

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

/**
 * Returns the URL for a stored-file theme setting using Moodle's theme_config API.
 *
 * The setting name and file area must match (Boost convention: both are the same string,
 * e.g. 'logo' for both 'theme_lore/logo' setting and the 'logo' file area).
 *
 * @param string $setting The setting/filearea name (e.g. 'logo', 'favicon', 'heroimage').
 * @return string|null Protocol-relative URL or null if no file is uploaded.
 */
function theme_lore_get_setting_file_url(string $setting): ?string {
    $theme = theme_config::load('lore');
    return $theme->setting_file_url($setting, $setting);
}

/**
 * Converts protocol-relative URLs from theme_config::setting_file_url() into moodle_url objects.
 *
 * setting_file_url returns a string beginning with "//hostname/..." because Moodle avoids
 * hard-coding http/https. Passing that string directly to new moodle_url() breaks rendering
 * of img src and link href in several browsers — theme Moove strips the wwwroot prefix and
 * builds a root-relative moodle_url instead (see theme_moove\output\core_renderer::favicon).
 *
 * @param string|null $protocolrelative URL returned by theme_config::setting_file_url().
 * @return moodle_url|null Null when the argument is empty.
 */
function theme_lore_normalize_theme_setting_url(?string $protocolrelative): ?\moodle_url {
    global $CFG;

    if ($protocolrelative === null || $protocolrelative === '') {
        return null;
    }

    $strippedwwwroot = preg_replace('|^https?://|i', '//', $CFG->wwwroot);
    $path = str_replace($strippedwwwroot, '', $protocolrelative);

    return new moodle_url($path);
}

/**
 * Serves files stored in the theme's file areas (logo, favicon, heroimage).
 *
 * @param stdClass $course Not used.
 * @param stdClass $cm Not used.
 * @param context $context The file context.
 * @param string $filearea The file area name.
 * @param array $args Remaining URL path arguments.
 * @param bool $forcedownload Whether to force download.
 * @param array $options Additional options.
 * @return bool False if file not found, otherwise serves and exits.
 */
function theme_lore_pluginfile(
    ?stdClass $course,
    ?stdClass $cm,
    context $context,
    string $filearea,
    array $args,
    bool $forcedownload,
    array $options = []
): bool {
    if ($context->contextlevel !== CONTEXT_SYSTEM) {
        send_file_not_found();
    }

    $allowedareas = ['logo', 'favicon', 'heroimage'];
    if (!in_array($filearea, $allowedareas)) {
        send_file_not_found();
    }

    $theme = theme_config::load('lore');

    if (!array_key_exists('cacheability', $options)) {
        $options['cacheability'] = 'public';
    }

    return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
}
