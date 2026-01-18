<?php
require_once ("bootstrap.php");

requireLogin();

$templateParams["utente"] = [
    "utente_id" => $_SESSION["utente_id"],
    "nome" => $_SESSION["nome"],
    "ruolo" => $_SESSION["ruolo"],
    "immagineprofilo" => $_SESSION["immagineprofilo"]
];
 
$templateParams["titolo"] = 'UniboRankings - Profilo';
$templateParams["nome"] = 'profilo-utente.php';
$templateParams["baseUrl"] = $baseUrl;

// Controllo se l'utente è admin
if ($_SESSION["ruolo"] === "ADMIN") {
    // Admin vede tutte le recensioni
    $templateParams["recensioniutente"] = $dbh->getAllReviewsWithProfessor();
} else {
    // Utenti normali vedono solo le proprie recensioni
    $templateParams["recensioniutente"] = $dbh->getReviewsWithProfessorByUser($_SESSION['utente_id']);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $oldPassword = $_POST["password"] ?? "";
    $newPassword = $_POST["passwordnew"] ?? "";
    $confirmPassword = $_POST["passwordconfirm"] ?? "";

    if ($newPassword !== $confirmPassword) {
        $templateParams["errore"] = "Le nuove password non coincidono.";
    } else {

        $result = $dbh->changePassword($_SESSION["utente_id"], $oldPassword, $newPassword);

        if ($result) {
            $templateParams["successo"] = "Password aggiornata con successo.";
        } else {
            $templateParams["errore"] = "Password attuale non corretta.";
        }
    }
}


require 'template/base.php';
?>