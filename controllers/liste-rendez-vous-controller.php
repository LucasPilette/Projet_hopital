<?php

require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointments.php');
require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');

$appointment = new Appointments();
$appointmentList = $appointment->getAll();


// AFFICHAGE DES VUES

include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-rendez-vous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');