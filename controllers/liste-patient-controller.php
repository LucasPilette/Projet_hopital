<?php

// RECUPERATION DONNES PDO

require_once(dirname(__FILE__).'/../config/PDO/PDO_init.php');
require_once(dirname(__FILE__).'/../models/Patient.php');


if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = trim(filter_input(INPUT_GET,'page',FILTER_SANITIZE_NUMBER_INT));

} else {
    $page = 1;
}
$perPage = 10;
$offset= ($page * $perPage) - $perPage;
$total = Patient::total();
$pages = ceil($total/$perPage);
$patientList = Patient::getAll($offset,$perPage);

if(!empty($_POST)){
    $search = trim(filter_input(INPUT_POST,'search', FILTER_SANITIZE_SPECIAL_CHARS));
    $total = Patient::total($search);
    $pages = ceil($total/$perPage);
    $results = Patient::getAll($offset,$perPage,$search);
}

if(!empty($_GET["searchbox"]) ) 
{   
    // the query responsible for fetch matched data
    $sql ="SELECT *
    FROM patients 
    WHERE firstname 
    LIKE '" . $_GET["searchbox"] . "%' 
    OR lastname LIKE '" . $_GET["searchbox"] . "%'
    LIMIT 0,$perPage;";
    $sth = DataBase::dbConnect()->prepare($sql);
    $sth ->execute();
    $results = $sth->fetchAll();
    echo json_encode($results);
    die;
}


// AFFICHAGE DES VUES

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/liste-patient.php');
include(dirname(__FILE__).'/../views/templates/footer.php');