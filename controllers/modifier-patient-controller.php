<?php

// RECUPERATION DONNES PDO


require_once(dirname(__FILE__).'/../config/constForm.php');
require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');
require_once(dirname(__FILE__).'/../models/Patient.php');


if(!empty($_GET)){
    $id = trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS));
    $patient = new Patient();
    $patientAccount = $patient->getOne($id);
}


// VERIFICATION FORMULAIRE

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
    }

};

// AFFICHAGE DES VUES

include(dirname(__FILE__).'/../views/templates/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {
    $id = trim(filter_input(INPUT_GET,'id',FILTER_SANITIZE_SPECIAL_CHARS));
    $patient = new Patient($lastname,$firstname,$birthDate,$phone,$email);
    $patient->modifyOne($id);
    header('location: /profil-patient?id='.$id);

} else {
    include(dirname(__FILE__).'/../views/modifier-patient.php');
};

include(dirname(__FILE__).'/../views/templates/footer.php');