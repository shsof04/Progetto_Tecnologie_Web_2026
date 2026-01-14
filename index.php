<?php
require_once("bootstrap.php");
 
// Home protetta: se non sei loggato vai al login
requireLogin();

$templateParams["titolo"] = "UniboRankings - Home";

require("template/base.php");
?>
