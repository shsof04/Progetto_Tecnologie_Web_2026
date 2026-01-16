<?php
require_once 'bootstrap.php';

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
$templateParams["recensioniutente"] = $dbh->getReviewsByUser($_SESSION['utente_id']);

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