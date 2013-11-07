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

$plugin->version   = 2013102900; // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2012061700; // Requires this Moodle version
$plugin->component = 'tool_gcm'; // Full name of the plugin (used for diagnostics)
