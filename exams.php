<?php
require_once("bootstrap.php");
requireLogin();

$templateParams["titolo"] = "UniboRankings - Esami";
$templateParams["nome"] = "template/exams-content.php";

$templateParams["anno_accademico"] = CURRENT_AA;
$templateParams["esami"] = $dbh->getExamsByAcademicYear(CURRENT_AA);

require("template/base.php");
?>
