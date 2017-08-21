<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package     local_nuxeolibs
 * @category    local
 * @copyright   2016 Valery Fremaux (valery.fremaux@gmail.com)
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

// Settings default init.

if (is_dir($CFG->dirroot.'/local/adminsettings')) {
    // Integration driven code.
    require_once($CFG->dirroot.'/local/adminsettings/lib.php');
    list($hasconfig, $hassiteconfig, $capability) = local_adminsettings_access();
} else {
    // Standard Moodle code.
    $capability = 'moodle/site:config';
    $hasconfig = $hassiteconfig = has_capability($capability, context_system::instance());
}

if ($hassiteconfig) {
    $settings = new admin_settingpage('nuxeolibs', get_string('pluginname', 'local_nuxeolibs'));

    $ADMIN->add('localplugins', $settings);

    $key = 'local_nuxeolibs/nuxeokey';
    $label = get_string('confignuxeokey', 'local_nuxeolibs');
    $desc = get_string('confignuxeokey_desc', 'local_nuxeolibs');
    $settings->add(new admin_setting_configtext($key, $label, $desc, ''));

    $key = 'local_nuxeolibs/xmlsettings';
    $label = get_string('configxmlsettings', 'local_nuxeolibs');
    $desc = get_string('configxmlsettings_desc', 'local_nuxeolibs');
    $settings->add(new admin_setting_configtextarea($key, $label, $desc, ''));

}

