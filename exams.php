<?php
require_once("bootstrap.php");
requireLogin();

$templateParams["titolo"] = "UniboRankings - Esami";
$templateParams["nome"] = "pagina-esame.php";
$templateParams["js"] = ["js/search.js"];

// elenco anni disponibili
$templateParams["anni_accademici"] = $dbh->getAcademicYears();

// anno scelto (default: CURRENT_AA)
$aa = isset($_GET["aa"]) ? $_GET["aa"] : CURRENT_AA;

// opzionale: tutti gli anni
if ($aa === "all") {
    $templateParams["anno_accademico"] = "all";
    $templateParams["esami"] = $dbh->getExamsAllYears();
} else {
    $templateParams["anno_accademico"] = $aa;
    $templateParams["esami"] = $dbh->getExamsByAcademicYear($aa);
}

require("template/base.php");
?>
