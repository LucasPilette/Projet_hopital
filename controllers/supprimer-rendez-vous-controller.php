<?php

require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointments.php');
require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');

if(!empty($_GET)){
    $id = trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS));
    $meeting = new Appointments();
    $meeting->deleteOne($id);
    header('location: /liste-rendez-vous');
}