<?php

/**
 * Manages notification to be pushed to Google Cloud Messaging service.
 *
 * @package    message.output
 * @subpackage push
 * @author Ananta Aryadewa <ananta_aryadewa@aniseasia.com>
 * @copyright  2013 Anise Asia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot.'/message/output/lib.php');

class message_output_push extends message_output {
    
    function config_form($preferences) {
        return NULL;
    }

    function load_data(&$preferences, $userid) {
        global $USER;
        return TRUE;
    }

    function process_form($form, &$preferences) {
        return TRUE;
    }

    function send_message($eventdata) {
        global $CFG, $DB;

        $result = TRUE;
        if ($this->is_system_configured()){
            $userIdTo = $eventdata->userto->id;

            // skip any messaging suspended and deleted users
            if ($eventdata->userto->auth === 'nologin' or $eventdata->userto->suspended or $eventdata->userto->deleted) {
                return true;
            }

            // get device associated to target user
            $regIds = array();
            $devices = $DB->get_records('tool_gcm_device', array('userid' => $userIdTo));
            foreach ($devices as $device) {
                $regIds[] = $device->regid;
            }

            // push the message to Google Cloud Messaging service
            $url = 'https://android.googleapis.com/gcm/send';
            $params = array(
                'registration_ids' => $regIds,
                'data' => array(
                    'id' => $eventdata->savedmessageid,
                    'subject' => $eventdata->subject,
                    'message' => $eventdata->smallmessage
                )
            );

            $headers = array(
                "Authorization: key=$CFG->gcmserverkey",
                'Content-Type: application/json'
            );

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_POST => TRUE,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_POSTFIELDS => json_encode($params)
            ));

            $result = curl_exec($curl);
            curl_close($curl);

        }
        
        return $result;
    }
    
    function is_system_configured() {
        global $CFG;
        return !empty($CFG->gcmserverkey);
    }

}