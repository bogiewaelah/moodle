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

require_once(dirname(__FILE__) . '/../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('./locallib.php');

// Check permissions.
require_login();

$page = optional_param('page', 0, PARAM_INT);

// Log.
add_to_log(SITEID, 'admin', 'tool gcm', 'tool/gcm/index.php');


/**********************
 * Print the content **
 *********************/

admin_externalpage_setup('toolgcm');

// Print the header.
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'tool_gcm'));

$output = $PAGE->get_renderer('tool_gcm');
$devices = new tool_gcm_device_list($page);
echo $output->render($devices);

// Footer.
echo $OUTPUT->footer();
