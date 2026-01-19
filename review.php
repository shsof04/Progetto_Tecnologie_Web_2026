<?php
require_once("bootstrap.php");
requireLogin();

$templateParams["titolo"] = "UniboRankings - Review";
$templateParams["nome"] = "review-form.php";
$templateParams["professori"] = $dbh->getAllProfessors();
$templateParams["professori_corsi"] = $dbh->getProfessorsAndCoursesWithYears();
$templateParams["appelli"] = $dbh->getAppelli();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] == 1) {

    $utente_id = $_SESSION["utente_id"];
    $professore_id = $_POST["professore_id"];
    $corso_id = $_POST["corso_id"];
    $anno_accademico = $_POST["anno_accademico"];
    $data_appello = $_POST["data_appello"];
    $voto_recensione = $_POST["voto_recensione"];
    $testo = trim($_POST["testo"] ?? "");
    $voto_esame = $_POST["voto_esame"] ?? null;

    // Voto esame null se "respinto"
    if ($voto_esame === "respinto") {
        $voto_esame = null;
    } else {
        $voto_esame = intval($voto_esame);
    }

    if ($dbh->checkReviewExists($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello)) {
        $templateParams["errore"] = "Hai già scritto una recensione per questo appello.";
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

// Modifica recensione
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] == 2) {

    $utente_id = $_SESSION['utente_id'];
    $professore_id = $_POST['professore_id'] ?? null;
    $corso_id = $_POST['corso_id'] ?? null;
    $anno_accademico = $_POST['anno_accademico'] ?? null;
    $data_appello = $_POST['data_appello'] ?? null;
    $voto_recensione = $_POST['voto_recensione'] ?? null;
    $testo = trim($_POST['testo'] ?? '');
    $voto_esame = ($_POST['voto_esame'] ?? null) === 'respinto' ? null : intval($_POST['voto_esame']);

    // Controllo che l'utente stia modificando la propria recensione
    $recensione = $dbh->getReviewByKeys($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
    if (!$recensione) {
        $templateParams['errore'] = "Recensione non trovata.";
    } else {
        $ok = $dbh->updateReview($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello, $voto_recensione, $voto_esame, $testo);
        if ($ok) {
            header("Location: profile.php?msg=Recensione modificata.");
            exit;
        } else {
            $templateParams['errore'] = "Errore durante la modifica della recensione.";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 2) {
    $utente_id = $_SESSION['utente_id'];
    $professore_id = $_GET['professore_id'] ?? null;
    $corso_id = $_GET['corso_id'] ?? null;
    $anno_accademico = $_GET['anno_accademico'] ?? null;
    $data_appello = $_GET['data_appello'] ?? null;

    $recensione = $dbh->getReviewByKeys($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
    if ($recensione) {
        $templateParams['recensione'] = $recensione;
        $templateParams['formAction'] = 2;
    } else {
        $templateParams['errore'] = "Recensione non trovata per la modifica.";
    }
}

if (isset($_GET['action']) && $_GET['action'] == 3) {
    $utente_id = $_GET['utente_id'];
    $professore_id = $_GET['professore_id'];
    $corso_id = $_GET['corso_id'];
    $anno_accademico = $_GET['anno_accademico'];
    $data_appello = $_GET['data_appello'];

    $dbh->deleteReview($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
    header("Location: profile.php?msg=Recensione cancellata!");
    exit;
}


require("template/base.php");
?>
