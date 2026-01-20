<?php 
require_once("bootstrap.php");
 
//BASE PARAMS
$templateParams["titolo"] = "UniboRankings - Login";
$templateParams["nome"] = "login-form.php";

// sul login non vogliamo menu laterali
$templateParams["showNav"] = false;
$templateParams["showAside"] = false;

$templateParams["errorelogin"] = "";

// Se già loggato, vai alla home
if (!empty($_SESSION["utente_id"])) {
    header("Location: index.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $utente_id = trim($_POST["email"] ?? "");
  $password = $_POST["password"] ?? "";

  $rows = $dbh->checkLogin($utente_id, $password);

  if (count($rows) === 1) {
    // salva sessione
    $_SESSION["utente_id"] = $rows[0]["utente_id"];
    $_SESSION["nome"] = $rows[0]["nome"];
    $_SESSION["ruolo"] = $rows[0]["ruolo"];
    $_SESSION["immagineprofilo"] = $rows[0]["immagineprofilo"];

    header("Location: index.php");
    exit;
  } 
      // login fallito: pulisco eventuali vecchie sessioni
    unset($_SESSION["utente_id"], $_SESSION["nome"], $_SESSION["ruolo"], $_SESSION["immagineprofilo"]);
    $templateParams["errorelogin"] = "Credenziali non valide.";
    
}

require("template/base.php");
?>


