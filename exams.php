<?php
require_once("bootstrap.php");
requireLogin();

$templateParams["titolo"] = "UniboRankings - Esami";
$templateParams["nome"] = "pagina-esame.php";

$templateParams["baseUrl"] = $baseUrl;
$templateParams["scripts"] = ["js/search.js"];

$templateParams["anno_accademico"] = CURRENT_AA;
$templateParams["esami"] = $dbh->getExamsByAcademicYear(CURRENT_AA);

require("template/base.php");
?>
