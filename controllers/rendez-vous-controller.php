<?php

require_once(dirname(__FILE__).'/../config/constForm.php');
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointments.php');
require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');

date_default_timezone_set('Europe/Paris');
$test = new Patient();
$total = Patient::total();
$patientList = $test->getAll(0,$total);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // CHECK PATIENT

    $patientValue = intval(filter_input(INPUT_POST, 'patient', FILTER_SANITIZE_NUMBER_INT));
    if(empty($patientValue)){
        $errors['patient'] = 'Veuillez sélectionner un patient associé au rendez-vous.';
    } else {
        $checkedPatient = filter_var($patientValue,FILTER_VALIDATE_INT);
        if(!$checkedPatient){
            $errors['patient'] = 'Veuillez sélectionner un patient valide.';
        }
    }

    // CHECK DATE
    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT));
    $dateObject = new DateTime($date);
    $dateNowObject = new DateTime(date('Y-m-d'));

    if(empty($date)){
        $errors['date'] = ' Veuillez choisir une date pour le rendez vous ';
    } else {
        if($dateNowObject > $dateObject){
            $errors['date'] = 'Veuillez choisir une date future.';
        }
        
    }

    // CHECK HOUR 

        $hour = filter_input(INPUT_POST, 'hour', FILTER_SANITIZE_SPECIAL_CHARS);
    
        if(empty($hour)){
            $errors['schedule'] = ' Veuillez choisir une heure pour le rendez-vous ';
        } 

        $schedule = $date.' '.$hour;
            $scheduleChecked = filter_var($schedule, FILTER_VALIDATE_REGEXP,array("options" => array("regexp" => '/' . REG_EXP_DATE . '/')));
            if(!$scheduleChecked){
                $errors['shedule'] = 'Veuillez choisir un créneau valide';
            }




    if(empty($errors)){
        $meeting = new Appointments($schedule,$patientValue);
        $meeting->add();
    }
}


// AFFICHAGE DES VUES

include(dirname(__FILE__).'/../views/templates/header.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)){
    header('location: /liste-rendez-vous');
} else {
    include(dirname(__FILE__).'/../views/rendez-vous.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');