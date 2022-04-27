<?php

// RECUPERATION DONNES PDO

require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointments.php');


if(!empty($_GET)){
    $id = trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));
    $appointmentInfos = Appointments::getOne($id);
} else {
    $error = 'Pas de rendez-vous avec cet ID.';
}

// AFFICHAGE DES VUES

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/info-rendez-vous.php');
include(dirname(__FILE__).'/../views/templates/footer.php');