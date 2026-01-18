<?php
require_once("bootstrap.php");
requireLogin();

$templateParams["titolo"] = "UniboRankings - Review";
$templateParams["nome"] = "review-form-backup.php";
$templateParams["professori"] = $dbh->getAllProfessors();
$templateParams["professori_corsi"] = $dbh->getProfessorsAndCoursesWithYears();
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


/*require_once("bootstrap.php");
require_once("utils/functions.php");
requireLogin();

$templateParams["titolo"] = "UniboRankings - Review";
$templateParams["nome"] = "review-form.php";
$templateParams["professori"] = $dbh->getAllProfessors();
$templateParams["professori_corsi"] = $dbh->getProfessorsAndCoursesWithYears();
$templateParams["appelli"] = $dbh->getAppelli();

// Controllo se è modifica tramite GET (passaggio chiavi)
$editing = false;
if (isset($_GET["action"]) && $_GET["action"] === "modifica") {
    $editing = true;
    $utente_id = $_SESSION["utente_id"];
    $professore_id = $_GET["professore_id"];
    $corso_id = $_GET["corso_id"];
    $anno_accademico = $_GET["anno_accademico"];
    $data_appello = $_GET["data_appello"];

    // Recupero recensione esistente direttamente tramite chiave composta
    $recensione = $dbh->getReviewByKeys($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
    if ($recensione) {
        $templateParams["recensione"] = $recensione;
    } else {
        $templateParams["errore"] = "Recensione non trovata.";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $utente_id = $_SESSION["utente_id"];
    $professore_id = $_POST["professore_id"] ?? null;
    $corso_id = $_POST["corso_id"] ?? null;
    $anno_accademico = $_POST["anno_accademico"] ?? null;
    $data_appello = $_POST["data_appello"] ?? null;
    $voto_recensione = intval($_POST["voto_recensione"] ?? 0);
    $testo = trim($_POST["testo"] ?? "");
    $voto_esame = $_POST["voto_esame"] ?? null;

    // Voto esame null se "respinto"
    if ($voto_esame === "respinto") {
        $voto_esame = null;
    } else {
        $voto_esame = intval($voto_esame);
    }

    // Azione da POST: inserisci, modifica, cancella
    $action = $_POST["action"] ?? "inserisci";

    if ($action === "inserisci") {
        if ($dbh->checkReviewExists($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello)) {
            $templateParams["errore"] = "Hai già scritto una recensione per questo appello!";
        } else {
            var_dump($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
exit; // fermiamo lo script per vedere i valori

            $ok = $dbh->insertRecensione($utente_id, $professore_id, $corso_id, $anno_accademico, $voto_recensione, $voto_esame, $data_appello, $testo);
            if ($ok) {
                header("Location: profile.php");
                exit;
            } else {
                $templateParams["errore"] = "Errore durante l'inserimento della recensione.";
            }
        }
    }

    elseif ($action === "modifica") {
        $ok = $dbh->updateReview($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello, $voto_recensione, $voto_esame, $testo);
        if ($ok) {
            header("Location: profile.php");
            exit;
        } else {
            $templateParams["errore"] = "Errore durante la modifica della recensione.";
        }
    }

    elseif ($action === "cancella") {
        $ok = $dbh->deleteReview($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
        if ($ok) {
            header("Location: profile.php");
            exit;
        } else {
            $templateParams["errore"] = "Errore durante la cancellazione della recensione.";
        }
    }
}

require("template/base.php");*/

?>
