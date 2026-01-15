<?php
require_once 'bootstrap.php';
 
$templateParams["titolo"] = 'UniboRankings - Profilo';
$templateParams["nome"] = 'profilo-utente.php';
$templateParams["recensioniutente"] = $dbh->getReviewsByUser(/*$_SESSION['utente_id']  guarda dal login*/);

require 'template/base.php';
?>