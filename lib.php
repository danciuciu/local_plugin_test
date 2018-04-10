<?php

/**
 * @package   local_plugin_test
 * @copyright 2017 onwards SC Elearning & Software SRL  {@link http://elearningsoftware.ro/}
 */



/**
 * Add new elements to admin settings block
 * @global type $CFG
 * @global type $PAGE
 * @param type $settingsnav
 * @param type $context
 * @return type
 */
function local_plugin_test_extend_settings_navigation($settingsnav, $context) {
    global $CFG, $PAGE;

    if (!has_capability('moodle/site:config', context_system::instance())) {
        return;
    }

    if($settingsnav) {
        $plugin_testNode = navigation_node::create(
            get_string('plugin_test', 'local_plugin_test'),
            null,
            navigation_node::NODETYPE_BRANCH,
            'plugin_test_category',
            'plugin_test_category',
            null
        );
        $plugin_testBranch = $settingsnav->add_node($plugin_testNode);

        $label = get_string('plugin_test', 'local_plugin_test');
        $url = new moodle_url('/local/plugin_test/index.php');
        $newNode = navigation_node::create(
            $label,
            $url,
            navigation_node::NODETYPE_LEAF,
            'local_plugin_test_index',
            'local_plugin_test_index',
            new pix_icon('i/settings', $label)
        );
        $plugin_testBranch->add_node($newNode);
        if ($PAGE->url->compare($url, URL_MATCH_BASE)) {
            $newNode->make_active();
        }

    }
}


function local_plugin_test_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=array()) {

// Leave this line out if you set the itemid to null in make_pluginfile_url (set $itemid to 0 instead).
    $itemid = array_shift($args); // The first item in the $args array.

// Use the itemid to retrieve any relevant data records and perform any security checks to see if the
// user really does have access to the file in question.

// Extract the filename / filepath from the $args array.
    $filename = array_pop($args); // The last item in the $args array.

    if (!$args) {
        $filepath = '/'; // $args is empty => the path is '/'
    } else {
        $filepath = '/'.implode('/', $args).'/'; // $args contains elements of the filepath
    }

// Retrieve the file from the Files API.
    $fs = get_file_storage();
    $file = $fs->get_file('1', 'local_plugin_test', $filearea, $itemid, $filepath, $filename);
    if (!$file) {
        return false; // The file does not exist.
    }
// We can now send the file back to the browser - in this case with a cache lifetime of 1 day and no filtering.
    send_stored_file($file, 1, 0, $forcedownload, $options);
}
