<?php
require_once("bootstrap.php");
requireLogin();

$templateParams["titolo"] = "UniboRankings - Corsi";
$templateParams["nome"] = "pagina-corso.php";
$templateParams["js"] = ["js/search.js"];

$templateParams["anno_accademico"] = CURRENT_AA;
$templateParams["corsi"] = $dbh->getCoursesByAcademicYear(CURRENT_AA);

require("template/base.php");
?>
