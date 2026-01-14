<?php 
require_once("bootstrap.php");
 
//BASE PARAMS
$templateParams["titolo"] = "BUniboRankings - Login";
$templateParams["nome"] = "login-form.php";

$templateParams["errorelogin"] = "";

// Se già loggato, vai alla home
if (!empty($_SESSION["utente_id"])) {
    header("Location: index.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"] ?? "");
  $password = $_POST["password"] ?? "";

  $rows = $dbh->checkLogin($email, $password);

  if (count($rows) === 1) {
    // salva sessione
    $_SESSION["utente_id"] = $rows[0]["utente_id"];
    $_SESSION["nome"] = $rows[0]["nome"];
    $_SESSION["ruolo"] = $rows[0]["ruolo"];
    $_SESSION["immagineprofilo"] = $rows[0]["immagineprofilo"];

    header("Location: index.php");
    exit;
  } else {
    $templateParams["errorelogin"] = "Credenziali non valide.";
  }
}
/*
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";

    $user = $dbh->checkLogin($email, $password);

    if ($user) {
        $_SESSION["utente_id"] = $user["utente_id"];
        $_SESSION["nome"] = $user["nome"];
        $_SESSION["ruolo"] = $user["ruolo"];
        header("Location: index.php");
        exit;
    } else {
        $templateParams["errore_login"] = "Email o password sbagliate.";
    }
}*/

require("template/base-login.php");
?>


