<?php
require_once("bootstrap.php");
requireLogin();

$templateParams["titolo"] = "UniboRankings - Corsi";
$templateParams["nome"] = "pagina-corso.php";

$templateParams["anno_accademico"] = CURRENT_AA;
$templateParams["corsi"] = $dbh->getCoursesByAcademicYear(CURRENT_AA);

require("template/base.php");
?>