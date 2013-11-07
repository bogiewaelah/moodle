<?php

/**
 * Install script of Message Push notification.
 *
 * @package    message.output
 * @subpackage push.db
 * @author Ananta Aryadewa <ananta_aryadewa@aniseasia.com>
 * @copyright  2013 Anise Asia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function xmldb_message_push_install() {
    global $DB;
    $result = TRUE;

    $provider = new stdClass();
    $provider->name  = 'push';
    $DB->insert_record('message_processors', $provider);
    
    return $result;
}
