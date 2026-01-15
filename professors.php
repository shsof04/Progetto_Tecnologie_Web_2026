<?php
require_once("bootstrap.php");

requireLogin();

if (!isset($_GET['professore_id'])  || !isset($_GET['corso_id'])) {
    header("Location: index.php");
    exit;
} 

$professore_id = $_GET['professore_id'];
$corso_id = $_GET['corso_id'];

$templateParams["titolo"] = 'UniboRankings - Professori';
$templateParams["nome"] = 'Profilo-professore.php';

$templateParams["professore"] = $dbh->getProfessorById($professore_id);
$templateParams["corso"] = $dbh->getCourseById($corso_id);
$templateParams["recensioniprofessore"] = $dbh->getReviewsByProfessor($professore_id, $corso_id);

//fare le funzioni per premdere le medie (so fa con AVG())

require("template/base.php");
?>




