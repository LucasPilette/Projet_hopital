<?php

require_once(dirname(__FILE__).'/../models/Patient.php');
require_once(dirname(__FILE__).'/../models/Appointments.php');
require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');



if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = trim(filter_input(INPUT_GET,'page',FILTER_SANITIZE_NUMBER_INT));

} else {
    $page = 1;
}
$perPage = 10;
$offset= ($page * $perPage) - $perPage;
$total = Appointments::total();
$pages = ceil($total/$perPage);
$appointmentList = Appointments::getAll($offset,$perPage);

// AFFICHAGE DES VUES

include(dirname(__FILE__).'/../views/templates/header.php');

include(dirname(__FILE__).'/../views/liste-rendez-vous.php');

include(dirname(__FILE__).'/../views/templates/footer.php');