<?php

/**
 * @package   local_plugin_test
 * @copyright 2017 onwards SC Elearning & Software SRL  {@link http://elearningsoftware.ro/}
 */

require_once '../../config.php';
require_once $CFG->dirroot.'/local/plugin_test/lib.php';
require_once($CFG->libdir.'/formslib.php');
require_once($CFG->dirroot.'/repository/lib.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url('/local/plugin_test/index.php');

$PAGE->set_title(get_string('plugin_test', 'local_plugin_test'));
$PAGE->set_heading(get_string('plugin_test', 'local_plugin_test'));
$PAGE->set_pagelayout('base');
//$PAGE->requires->css('/local/plugin_test/styles.css');
//var_dump($USER);die();

$PAGE->navbar->ignore_active();
$PAGE->navbar->add(get_string('plugin_test', 'local_plugin_test'));
$content = ' Date Formular';

class plugin_test_form extends moodleform {

    /**
     * Defines the form
     */
    public function definition() {
        global $USER, $CFG, $DB;

        $mform = $this->_form;

        $mform->addElement('text', 'nume',  get_string('nume', 'local_plugin_test'));
        $mform->setType('nume', PARAM_NOTAGS);
        $mform->addRule('nume', get_string('required'), 'required');

        $mform->addElement('text', 'prenume',  get_string('prenume', 'local_plugin_test'));
        $mform->setType('prenume', PARAM_NOTAGS);
        $mform->addRule('prenume', get_string('required'), 'required');

        $mform->addElement('text', 'email',  get_string('email', 'local_plugin_test'));
        $mform->setType('email', PARAM_NOTAGS);
        $mform->addRule('email', get_string('required'), 'required');

        $mform->addElement('text', 'nrtelefon',  get_string('nrtelefon', 'local_plugin_test'));
        $mform->setType('nrtelefon', PARAM_NOTAGS);
        $mform->addRule('nrtelefon', get_string('required'), 'required');

        $mform->addElement('advcheckbox', 'ratingtime', get_string('ratingtime', 'local_plugin_test'), 'Label displayed after checkbox', array('group' => 1), array(0, 1));

        $radioarray=array();
        $radioarray[] = $mform->createElement('radio', 'yesno', '', get_string('yes'), 1);
        $radioarray[] = $mform->createElement('radio', 'yesno', '', get_string('no'), 0);
        $mform->addGroup($radioarray, 'radioar', '', array(' '), false);

        $buttonarray = array();
        $buttonarray[] = $mform->createElement('submit', 'submit' , get_string('send', 'local_plugin_test'));
        $buttonarray[] = $mform->createElement('cancel');

        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
    }


    public function validation($data, $files) {
        $errors = parent::validation($data, $files);


        return $errors;
    }
}

$formular = new plugin_test_form();


if ($formular->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/plugin_test/index.php');
} else if ($data = $formular->get_data()) {
  //var_dump($data);die();

    //insert in DB
    $dataobject = new \stdClass();
    $dataobject->nume = $data->nume;
    $dataobject->prenume = $data->prenume;
    $dataobject->email = $data->email;
    $dataobject->nrtelefon = $data->nrtelefon;
    $dataobject->ratingtime = $data->ratingtime;
    $dataobject->radio01 = $data->yesno;
    $dataobject->userid= $USER->id;
  //  var_dump($dataobject);die();
   $DB->insert_record('local_plugin_test', $dataobject);
//redirect('http://localhost/moodle/local/plugin_test/index.php');
}


echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('plugin_test', 'local_plugin_test'));
echo $content;
echo $formular->render();
echo $OUTPUT->footer();
