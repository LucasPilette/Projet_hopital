<?php

// RECUPERATION DONNES PDO

require_once(dirname(__FILE__).'/../config/constForm.php');
require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');
require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointments.php');

date_default_timezone_set('Europe/Paris');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // PRENOM
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($firstname)) {
        $errors['firstname'] = 'Veuillez saisir votre prénom';
    } else {
        $checkedFirstname = filter_var(
            $firstname,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => '/' . REG_EXP_NAME . '/'))
        );
        if (!$checkedFirstname) {
            $errors['firstname'] = 'Veuillez saisir un prénom valide';
        }
    }


    // NOM
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS));
    if (empty($lastname)) {
        $errors['lastname'] = 'Veuillez saisir votre nom';
    } else {
        $checkedLastname = filter_var(
            $lastname,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => '/' . REG_EXP_NAME . '/'))
        );
        if (!$checkedLastname) {
            $errors['lastname'] = 'Veuillez saisir un nom valide';
        }
    }
    
    //DATE DE NAISSANCE
    $actualDate = date('Y-m-d');
    $birthDate = filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_NUMBER_INT);

    //Age < 120 et Age >0
    $actualDateObject = new Datetime($actualDate);
    $birthDateObject = new Datetime($birthDate);
    $actualYear = $actualDateObject->format('Y');
    $diff = $actualDateObject->diff($birthDateObject);
    $ageUser = $diff->format('%Y');
    $yearOfBirthUser = $birthDateObject->format('Y');
    $monthOfBirthUser = $birthDateObject->format('m');
    $dayOfBirthUser = $birthDateObject->format('d');

    if (empty($birthDate)) {
        $errors['birthDate'] = 'Veuillez saisir votre date de naissance';
    } else {
        $checkedBirthDate = checkdate($monthOfBirthUser, $dayOfBirthUser, $yearOfBirthUser);
        if (!$checkedBirthDate || $ageUser > 120 || $yearOfBirthUser >= $actualYear) {
            $errors['birthDate'] = 'Veuillez saisir une date de naissance valide';
        }
    }

    // TELEPHONE
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
    if(empty($phone)){
        $errors['phone'] = 'Veuillez saisir votre numéro de téléphone';
    } else {
        $checkedPhone = filter_var(
            $phone,
            FILTER_VALIDATE_REGEXP,
            array("options" => array("regexp" => '/' . REG_EXP_PHONE . '/'))
        );
        if(!$checkedPhone){
            $errors['phone'] = 'Veuillez saisir un numéro de téléphone valide';
        }
    }

    // EMAIL
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    if (empty($email)) {
        $errors['email'] = 'Veuillez saisir votre email';
    } else {
        $checkedEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$checkedEmail) {
            $errors['email'] = 'Veuillez saisir un email valide';
        }
        if(Patient::isExist($email)){
            $errors['email'] = 'L\'email saisi est déjà utilisé.';
        }
    }

    // CHECK DATE

    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT));
    $dateNow = date('Y-m-d');
    $dateObject = new DateTime($date);
    $dateNowObject = new DateTime($dateNow);

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
}

include(dirname(__FILE__).'/../views/templates/header.php');


if($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)){

        $dbh = DataBase::dbConnect() ;

        $dbh->beginTransaction();

        $patient = new Patient($lastname,$firstname,$birthDate,$phone,$email);

        $addPatient = $patient->add();

        $app = new Appointments($schedule,$addPatient);

        $addApp = $app->add();


        
        if($addPatient !== NULL && $addApp === true ){
            $dbh->commit();
            header('location: /liste-patient');
        } else {
            $dbh->rollBack(); 
        }
    
} else {
    include(dirname(__FILE__).'/../views/ajout-patient-rendez-vous.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');