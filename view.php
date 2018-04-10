<?php

/**
 * @package   local_plugin_test
 * @copyright 2017 onwards SC Elearning & Software SRL  {@link http://elearningsoftware.ro/}
 */

require_once '../../config.php';
require_once $CFG->dirroot.'/local/plugin_test/lib.php';


$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/plugin_test/index.php');

$PAGE->set_title(get_string('plugin_test', 'local_plugin_test'));
$PAGE->set_heading(get_string('plugin_test', 'local_plugin_test'));
$PAGE->set_pagelayout('base');
//$PAGE->requires->css('/local/plugin_test/styles.css');

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('plugin_test', 'local_plugin_test'));

if(isset($_GET["rowid"])){
  //$DB->delete_records('local_plugin_test',array('id'=>$_GET["rowid"]));
}

//var_dump($_GET["rowid"]);die();

echo '<table style="width:100%">
      <thead>
          <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Nr telefon</th>
            <th>Checkbox</th>
            <th>Radio</th>
          </tr>
        </thead>

          ';
$results = $DB->get_records_sql('SELECT * FROM {local_plugin_test} ');
foreach($results as $result){
//$content .= $result->nume.'<br>';
  echo '<tr>
                <td>'.$result->nume.'</td>
                <td>'.$result->prenume.'</td>
                <td>'.$result->email.'</td>
                <td>'.$result->nrtelefon.'</td>
                <td>'.$result->ratingtime.'</td>
                <td>'.$result->radio01.'</td>
                <td><a class="btn btn-default"  href="http://localhost/moodle/local/plugin_test/view.php?rowid='.$result->id.'">Delete</a></td>
              </tr>';
//var_dump($result);die();
}
echo '</table>';


$newrecord = $DB->get_record_sql('SELECT * FROM {local_plugin_test} WHERE nume=?',array("paul"));

$email = $DB->get_field_sql('SELECT email FROM {local_plugin_test} WHERE nume=?',array("paul"));
//var_dump($email);die();

$record = new \stdClass();
$record->id = 4;
$record->email = 'dan@dan.com';
$record->nume = 'Dan';
$DB->update_record('local_plugin_test',$record);


//$DB->delete_records('local_plugin_test',array('id'=>4));


//echo $content;
echo $OUTPUT->footer();
