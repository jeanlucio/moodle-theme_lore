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
 * Theme Lore configuration.
 *
 * @package theme_lore
 * @copyright 2026 Jean Lúcio
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/lib.php');

$THEME->name             = 'lore';
$THEME->parents          = ['boost'];
$THEME->sheets           = [];
$THEME->editor_sheets    = [];
$THEME->rendererfactory  = 'theme_overridden_renderer_factory';
$THEME->requiredblocks   = '';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->haseditswitch    = true;
$THEME->usescourseindex  = true;
$THEME->yuicssmodules    = [];
$THEME->iconsystem       = \core\output\icon_system::FONTAWESOME;
$THEME->activityheaderconfig = ['notitle' => true];
$THEME->enable_dock      = false;
$THEME->scss             = function ($theme) {
    return theme_lore_get_main_scss_content($theme);
};
$THEME->prescsscallback    = 'theme_lore_get_pre_scss';
$THEME->extrascsscallback  = 'theme_lore_get_extra_scss';

$THEME->layouts = [
    'drawers' => [
        'file'          => 'drawers.php',
        'regions'       => ['side-pre'],
        'defaultregion' => 'side-pre',
    ],
    'frontpage' => [
        'file'          => 'drawers.php',
        'regions'       => ['side-pre'],
        'defaultregion' => 'side-pre',
        'options'       => ['nonavbar' => false],
    ],
    'login' => [
        'file'    => 'drawers.php',
        'regions' => [],
        'options' => ['langmenu' => true],
    ],
];
