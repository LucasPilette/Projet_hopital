<?php
// RECUPERATION DONNES PDO

require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointments.php');
require_once(dirname(__FILE__).'/../helpers/SessionFlash.php');


if(!empty($_GET)){
    $id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));
    $patientAccount = Patient::getOne($id);
    $appList = Appointments::getAll(0,10,$id);
    // echo json_encode(['data'=>$appList]);
}

// if(($_POST)){
//     $id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));
//     var_dump($id);
//     die;

//     $meeting = new Appointments();
//     $meeting->deleteOne($id);
// }

// AFFICHAGE DES VUES

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/profil-patient.php');
include(dirname(__FILE__).'/../views/templates/footer.php');
