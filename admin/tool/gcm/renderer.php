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

require_once './lib.php';

class tool_gcm_renderer extends plugin_renderer_base {
    
    protected function render_tool_gcm_device_list(tool_gcm_device_list $list) {
        $records = $list->getRecords();
        $pagingbar = $this->output->paging_bar($list->getNumOfRecords(), $list->getCurrentPage(), tool_gcm_device_list::MAX_DISPLAYED, $CFG->wwwroot. '/admin/tool/gcm/index.php');
        
        $table = new html_table();
        $table->id = 'devices';
        $table->head = array(
            get_string('table_head_user', 'tool_gcm'),
            get_string('table_head_regid', 'tool_gcm'),
            get_string('table_head_time_created', 'tool_gcm')
        );
        
        if ($list->getNumOfRecords() > 0) {
            foreach ($records as $device) {
                $cells = array();

                $cells[0] = new html_table_cell(fullname($device));
                $cells[1] = new html_table_cell(trim_string($device->regid));
                $cells[2] = new html_table_cell(userdate($device->timecreated));

                $row = new html_table_row($cells);
                $table->data[] = $row;
            }
        } else {
            $cells = array();
            $cells[0] = new html_table_cell(get_string('table_list_no_devices', 'tool_gcm'));
            $cells[0]->colspan = 3;
            $table->data[] = new html_table_row($cells);
        }
            
        $output = '';
        $output .= $pagingbar;
        $output .= html_writer::table($table);
        $output .= $pagingbar;
        return $output;
    }
}

?>
