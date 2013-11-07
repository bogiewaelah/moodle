<?php

/**
 * Manages notification to be pushed to Google Cloud Messaging service.
 *
 * @package    admin.tool
 * @subpackage gcm
 * @author Ananta Aryadewa <ananta_aryadewa@aniseasia.com>
 * @copyright  2013 Anise Asia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $ADMIN->add('reports', new admin_externalpage('toolgcm', get_string('pluginname', 'tool_gcm'), "$CFG->wwwroot/$CFG->admin/tool/gcm/index.php"));
}