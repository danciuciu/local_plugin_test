<?php

/**
 * @package   local_plugin_test
 * @copyright 2017 onwards SC Elearning & Software SRL  {@link http://elearningsoftware.ro/}
 */

defined('MOODLE_INTERNAL') || die();

require_once $CFG->dirroot.'/local/local_plugin_test/lib.php';

function xmldb_local_plugin_test_install() {
    global $CFG, $DB;

    $dbman = $DB->get_manager();
    // admin/tool/xmldb/index.php

    return true;
}
