<?php

// RECUPERATION DONNES PDO

require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');
require_once(dirname(__FILE__).'/../models/Patient.php');

$patient = new Patient();
$patientList = $patient->getAll();




// AFFICHAGE DES VUES

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/liste-patient.php');
include(dirname(__FILE__).'/../views/templates/footer.php');