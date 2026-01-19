<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("bootstrap.php");

// Home protetta: se non sei loggato vai al login
requireLogin();
 
$templateParams["titolo"] = "UniboRankings - Home";
$templateParams["nome"] = "home.php"; 

$templateParams["baseUrl"] = $baseUrl;


// script per filtrare risultati nella search bar
$templateParams["scripts"] = ["js/search.js"];

// dati per la tabella (dal DB)
$templateParams["ranking"] = $dbh->getProfessorRankings();

require("template/base.php");
?>
