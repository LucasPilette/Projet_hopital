<?php

require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointments.php');
require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');

if(!empty($_GET)){
    $id = trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS));
    $app = new Appointments();
    $app->deleteAllFromPatient($id);
    $patient = new Patient();
    $patient->deletePatient($id);
    header('location: /liste-patient');
}