<?php
require_once("bootstrap.php");

// distrugge la sessione e torna al login
session_unset();
session_destroy();

header("Location: login.php");
exit;
?>