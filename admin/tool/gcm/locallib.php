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

defined('MOODLE_INTERNAL') || die();

class tool_gcm_device_list implements renderable {
    const MAX_DISPLAYED = 15;
    
    private $records = array();
    private $numOfRecords = 0;
    private $currentPage = 0;

    public function __construct($currentPage = 0) {
        global $DB;
        
        $limit = tool_gcm_device_list::MAX_DISPLAYED;
        $offset = ($currentPage) * $limit;
        $query = array(
            'SELECT gcm.id AS id, gcm.regid, gcm.timecreated, u.id AS userid, u.username, u.firstname, u.lastname',
            'FROM {tool_gcm_device} gcm',
            'LEFT JOIN {user} u',
            'ON (gcm.userid = u.id)',
            'ORDER BY u.username, u.firstname, gcm.timecreated'
        );

        $this->records = $DB->get_records_sql(join(' ', $query), null, $offset, $limit);
        $this->numOfRecords = sizeof($this->records);
        $this->currentPage = $currentPage;
    }
    
    public function getRecords() {
        return $this->records;
    }

    public function setRecords($records) {
        $this->records = $records;
    }

    public function getNumOfRecords() {
        return $this->numOfRecords;
    }

    public function setNumOfRecords($numOfRecords) {
        $this->numOfRecords = $numOfRecords;
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }


}