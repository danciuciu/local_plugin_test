<?php

/**
 * @package   local_plugin_test
 * @copyright 2017 onwards SC Elearning & Software SRL  {@link http://elearningsoftware.ro/}
 */

function xmldb_local_plugin_test_upgrade($oldversion = 0) {
    global $CFG, $THEME, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2018032904) {

            // Define field nume to be added to local_plugin_test.
            $table = new xmldb_table('local_plugin_test');
            $field = new xmldb_field('nume', XMLDB_TYPE_CHAR, '30', null, null, null, null, 'id');
            // Conditionally launch add field nume.
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }

            $field = new xmldb_field('prenume', XMLDB_TYPE_CHAR, '30', null, null, null, null, 'nume');
            // Conditionally launch add field prenume.
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }

            $field = new xmldb_field('email', XMLDB_TYPE_CHAR, '30', null, null, null, null, 'prenume');

            // Conditionally launch add field e-mail.
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }

            $field = new xmldb_field('nrtelefon', XMLDB_TYPE_CHAR, '10', null, null, null, null, 'email');

            // Conditionally launch add field nr. telefon.
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }


            // Plugin_test savepoint reached.
            upgrade_plugin_savepoint(true, 2018032904, 'local', 'plugin_test');
        }


        if ($oldversion < 2018032905) {

               // Define field ratingtime to be added to local_plugin_test.
               $table = new xmldb_table('local_plugin_test');
               $field = new xmldb_field('ratingtime', XMLDB_TYPE_INTEGER, '1', null, null, null, null, 'nrtelefon');

               // Conditionally launch add field ratingtime.
               if (!$dbman->field_exists($table, $field)) {
                   $dbman->add_field($table, $field);
               }

               // Plugin_test savepoint reached.
               upgrade_plugin_savepoint(true, 2018032905, 'local', 'plugin_test');
           }

           if ($oldversion < 2018032907) {

        // Define field radio01 to be added to local_plugin_test.
        $table = new xmldb_table('local_plugin_test');
        $field = new xmldb_field('radio01', XMLDB_TYPE_CHAR, '1', null, null, null, null, 'ratingtime');

        // Conditionally launch add field radio01.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Plugin_test savepoint reached.
        upgrade_plugin_savepoint(true, 2018032907, 'local', 'plugin_test');
    }



    return true;
}
