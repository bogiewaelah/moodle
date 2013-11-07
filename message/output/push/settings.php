<?php

/**
 * Add push message configuration to admin menu.
 *
 * @package    message.output
 * @subpackage push
 * @author Ananta Aryadewa <ananta_aryadewa@aniseasia.com>
 * @copyright  2013 Anise Asia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext('gcmserverkey', get_string('gcm_server_key', 'message_push'), get_string('description_gcm_server_key', 'message_push'), '', PARAM_RAW));
}