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
 * Theme Lore settings page.
 *
 * @package theme_lore
 * @copyright 2026 Jean Lúcio
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new theme_boost_admin_settingspage_tabs(
        'themesettinglore',
        get_string('configtitle', 'theme_lore')
    );

    // Tab: General.
    $page = new admin_settingpage('theme_lore_general', get_string('generalsettings', 'theme_lore'));

    $setting = new admin_setting_configstoredfile(
        'theme_lore/logo',
        get_string('uploadlogo', 'theme_lore'),
        get_string('uploadlogodesc', 'theme_lore'),
        'logo',
        0,
        ['maxfiles' => 1, 'accepted_types' => ['.jpg', '.jpeg', '.png', '.gif', '.svg', '.webp']]
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configstoredfile(
        'theme_lore/favicon',
        get_string('uploadfavicon', 'theme_lore'),
        get_string('uploadfavicondesc', 'theme_lore'),
        'favicon',
        0,
        ['maxfiles' => 1, 'accepted_types' => ['.ico', '.png']]
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext(
        'theme_lore/sitename',
        get_string('sitename', 'theme_lore'),
        get_string('sitenamedesc', 'theme_lore'),
        '',
        PARAM_TEXT
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext(
        'theme_lore/siteslogan',
        get_string('siteslogan', 'theme_lore'),
        get_string('siteslogandesc', 'theme_lore'),
        '',
        PARAM_TEXT
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // Tab: Colours.
    $page = new admin_settingpage('theme_lore_colours', get_string('colorsettings', 'theme_lore'));

    $setting = new admin_setting_configcolourpicker(
        'theme_lore/colorprimary',
        get_string('colorprimary', 'theme_lore'),
        get_string('colorprimarydesc', 'theme_lore'),
        '#0f6cbf'
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configcolourpicker(
        'theme_lore/colorsecondary',
        get_string('colorsecondary', 'theme_lore'),
        get_string('colorsecondarydesc', 'theme_lore'),
        '#6c757d'
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configcolourpicker(
        'theme_lore/colorherobg',
        get_string('colorherobg', 'theme_lore'),
        get_string('colorherobgdesc', 'theme_lore'),
        '#0f6cbf'
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // Tab: Front page.
    $page = new admin_settingpage('theme_lore_frontpage', get_string('frontpagesettings', 'theme_lore'));

    $setting = new admin_setting_configtext(
        'theme_lore/herotitle',
        get_string('herotitle', 'theme_lore'),
        get_string('herotitledesc', 'theme_lore'),
        '',
        PARAM_TEXT
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext(
        'theme_lore/herosubtitle',
        get_string('herosubtitle', 'theme_lore'),
        get_string('herosubtitledesc', 'theme_lore'),
        '',
        PARAM_TEXT
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext(
        'theme_lore/heroctabutton',
        get_string('heroctabutton', 'theme_lore'),
        get_string('heroctabuttondesc', 'theme_lore'),
        '',
        PARAM_TEXT
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext(
        'theme_lore/heroctaurl',
        get_string('heroctaurl', 'theme_lore'),
        get_string('heroctaurldesc', 'theme_lore'),
        '',
        PARAM_URL
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configstoredfile(
        'theme_lore/heroimage',
        get_string('heroimage', 'theme_lore'),
        get_string('heroimagedesc', 'theme_lore'),
        'heroimage',
        0,
        ['maxfiles' => 1, 'accepted_types' => ['.jpg', '.jpeg', '.png', '.gif', '.webp']]
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // Tab: Dashboard.
    $page = new admin_settingpage('theme_lore_dashboard', get_string('dashboardsettings', 'theme_lore'));

    $setting = new admin_setting_configselect(
        'theme_lore/dashboardmaxcourses',
        get_string('dashboardmaxcourses', 'theme_lore'),
        get_string('dashboardmaxcoursesdesc', 'theme_lore'),
        12,
        [
            4  => '4',
            6  => '6',
            8  => '8',
            12 => '12',
            16 => '16',
            20 => '20',
            24 => '24',
        ]
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configcheckbox(
        'theme_lore/dashboardshowgrade',
        get_string('dashboardshowgrade', 'theme_lore'),
        get_string('dashboardshowgradedesc', 'theme_lore'),
        0
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configcheckbox(
        'theme_lore/dashboardshowlastaccess',
        get_string('dashboardshowlastaccess', 'theme_lore'),
        get_string('dashboardshowlastaccessdesc', 'theme_lore'),
        1
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // Tab: Accessibility.
    $page = new admin_settingpage('theme_lore_accessibility', get_string('accessibilitysettings', 'theme_lore'));

    $setting = new admin_setting_configcheckbox(
        'theme_lore/enableaccessibilitybar',
        get_string('enableaccessibilitybar', 'theme_lore'),
        get_string('enableaccessibilitybardesc', 'theme_lore'),
        1
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configcheckbox(
        'theme_lore/enabledyslexicfont',
        get_string('enabledyslexicfont', 'theme_lore'),
        get_string('enabledyslexicfontdesc', 'theme_lore'),
        1
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    // Tab: Advanced CSS.
    $page = new admin_settingpage('theme_lore_advancedcss', get_string('advancedcsssettings', 'theme_lore'));

    $setting = new admin_setting_scsscode(
        'theme_lore/rawscss',
        get_string('rawscss', 'theme_lore'),
        get_string('rawscssdesc', 'theme_lore'),
        '',
        PARAM_RAW
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
