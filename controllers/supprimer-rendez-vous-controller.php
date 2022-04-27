<?php
require_once(dirname(__FILE__).'/../models/Appointments.php');
require_once(dirname(__FILE__).'/../helpers/SessionFlash.php');

$id = intval(filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT));

$meeting = Appointments::deleteOne($id);

if($meeting){
    SessionFlash::set('Rendez-vous supprimé.');
} else {
    SessionFlash::set('Erreur avec la suppression du rendez-vous.');
}

header('location: '.$_SERVER['HTTP_REFERER']);
die;
