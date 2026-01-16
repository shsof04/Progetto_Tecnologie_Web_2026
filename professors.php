
<?php
require_once("bootstrap.php");

requireLogin();

if (empty($_GET['professore_id']) || empty($_GET['corso_id'])) {
  header("Location: index.php");
  exit;
}

$professore_id = $_GET['professore_id'];
$corso_id = $_GET['corso_id'];

$templateParams["titolo"] = 'UniboRankings - Professori';
$templateParams["nome"] = 'profilo-professore.php';

$templateParams["baseUrl"] = $baseUrl;

$templateParams["professore"] = $dbh->getProfessorById($professore_id);
$templateParams["corso"] = $dbh->getCourseById($corso_id);
$templateParams["recensioniprofessore"] = $dbh->getReviewsByProfessor($professore_id, $corso_id);
$templateParams["medie"] = $dbh->getAverageByProfessorAndCourse($professore_id, $corso_id);

require("template/base.php");
?>




