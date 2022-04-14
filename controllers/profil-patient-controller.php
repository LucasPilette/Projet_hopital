<?php

// RECUPERATION DONNES PDO

require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');
require_once(dirname(__FILE__).'/../models/Patient.php');


if(!empty($_GET)){
    $id = trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS));
    $patient = new Patient();
    $patientAccount = $patient->getOne($id);

    $appList = $patient->getAppointments($id);
}

// AFFICHAGE DES VUES

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/profil-patient.php');
include(dirname(__FILE__).'/../views/templates/footer.php');