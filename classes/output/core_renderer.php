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
 * Core renderer overrides for theme_lore.
 *
 * @package theme_lore
 * @copyright 2026 Jean Lúcio
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_lore\output;

use moodle_url;

/**
 * Overrides specific core renderer methods to apply theme_lore admin settings.
 */
class core_renderer extends \theme_boost\output\core_renderer {
    /**
     * Returns the URL for the custom logo uploaded in theme settings.
     * Overrides get_logo_url (large logo, used in non-navbar contexts).
     *
     * @param int|null $maxwidth Maximum width (kept for signature compatibility).
     * @param int|null $maxheight Maximum height (kept for signature compatibility).
     * @return moodle_url|false Logo URL or false when no logo is available.
     */
    public function get_logo_url($maxwidth = null, $maxheight = 200) {
        $url = theme_lore_normalize_theme_setting_url(theme_lore_get_setting_file_url('logo'));
        if ($url) {
            return $url;
        }
        return parent::get_logo_url($maxwidth, $maxheight);
    }

    /**
     * Returns the compact logo URL used by the Boost navbar template.
     * The navbar template calls {{output.get_compact_logo_url}} and only
     * displays the logo when should_display_navbar_logo() is true.
     *
     * @param int $maxwidth Maximum width (kept for signature compatibility).
     * @param int $maxheight Maximum height (kept for signature compatibility).
     * @return moodle_url|false Compact logo URL or false when no logo is available.
     */
    public function get_compact_logo_url($maxwidth = 300, $maxheight = 300) {
        $url = theme_lore_normalize_theme_setting_url(theme_lore_get_setting_file_url('logo'));
        if ($url) {
            return $url;
        }
        return parent::get_compact_logo_url($maxwidth, $maxheight);
    }

    /**
     * Whether to display the logo in the navbar.
     * Returns true whenever the theme logo setting has a file uploaded,
     * or falls back to the parent logic (compact site logo from core_admin).
     *
     * @return bool
     */
    public function should_display_navbar_logo() {
        $url = theme_lore_get_setting_file_url('logo');
        if ($url) {
            return true;
        }
        return parent::should_display_navbar_logo();
    }

    /**
     * Returns the favicon URL from theme settings, falling back to the
     * site-wide favicon configured in Administration → Appearance → Logos.
     *
     * @return moodle_url Favicon URL.
     */
    public function favicon(): moodle_url {
        $url = theme_lore_normalize_theme_setting_url(theme_lore_get_setting_file_url('favicon'));
        if ($url) {
            return $url;
        }
        return parent::favicon();
    }
}
