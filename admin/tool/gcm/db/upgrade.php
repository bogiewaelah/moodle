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

/**
 * upgrade this gcm instance - this function could be skipped but it will be needed later
 * @param int $oldversion The old version of the assign module
 * @return bool
 */
function xmldb_tool_gcm_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2013102900) {

        // Define table tool_gcm_device to be created
        $table = new xmldb_table('tool_gcm_device');

        // Adding fields to table tool_gcm_device
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);
        $table->add_field('gcmid', XMLDB_TYPE_TEXT, null, null, XMLDB_NOTNULL, null, null);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null);

        // Adding keys to table tool_gcm_device
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));

        // Adding indexes to table tool_gcm_device
        $table->add_index('idx_userid', XMLDB_INDEX_NOTUNIQUE, array('userid'));
        $table->add_index('idx_gcmid', XMLDB_INDEX_UNIQUE, array('gcmid'));

        // Conditionally launch create table for tool_gcm_device
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // gcm savepoint reached
        upgrade_plugin_savepoint(true, 2013102900, 'tool', 'gcm');
    }

    return true;
}