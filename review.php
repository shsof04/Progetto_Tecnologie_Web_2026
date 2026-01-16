<?php
require_once("bootstrap.php"); // include DatabaseHelper e sessione
requireLogin(); // verifica se l'utente è loggato

$templateParams["titolo"] = "UniboRankings - Review";
$templateParams["nome"] = "review-form.php";

// Tutti i professori per il select
$templateParams["professori"] = $dbh->getAllProfessors();

// Professori + corsi + anni per il JS dinamico
$templateParams["professori_corsi"] = $dbh->getProfessorsAndCoursesWithYears();

// Tutti gli appelli per il JS dinamico
$templateParams["appelli"] = $dbh->getAppelli();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $utente_id = $_SESSION["utente_id"];
    $professore_id = $_POST["professore_id"] ?? null;
    $corso_id = $_POST["corso_id"] ?? null;
    $anno_accademico = $_POST["anno_accademico"] ?? null;
    $data_appello = $_POST["data_appello"] ?? null;
    $voto_recensione = $_POST["voto_recensione"] ?? null;
    $testo = trim($_POST["testo"] ?? "");
    $voto_esame = $_POST["voto_esame"] ?? null;

    // Voto esame null se "respinto"
    if ($voto_esame === "respinto") {
        $voto_esame = null;
    } else {
        $voto_esame = intval($voto_esame);
    }

    if ($dbh->checkReviewExists($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello)) {
        $templateParams["errore"] = "Hai già scritto una recensione per questo appello!";
    } else {
        $ok = $dbh->insertRecensione($utente_id, $professore_id, $corso_id, $anno_accademico, $voto_recensione, $voto_esame, $data_appello, $testo);                            

        if ($ok) {;
            header("Location: profile.php");
            exit;
        } else {
            $templateParams["errore"] = "Errore durante l'inserimento della recensione.";
        }
    }

}

require("template/base.php");
?>
