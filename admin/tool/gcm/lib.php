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

/**
 * Standard cron function
 */
function tool_gcm_cron() {
    global $DB;
    
    mtrace('gcm: tool_gcm_cron() started at '. date('H:i:s'));
    mtrace('Nothing to do ...');
    
}

function trim_string($string, $length = 50, $trimword = TRUE, $ellipsis = '...') {
    if (strlen($string) > $length) {
        $string = substr($string, 0, ($length - 4));
        
        if ($trimword) {
            $string .= ' ' .$ellipsis;
        } else {
            $string = substr($string, 0, strrpos($string, ' ')). ' ' .$ellipsis;
        }
    }
    
    return $string;
}