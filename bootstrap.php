<!-- per ogni pagina html dobbiamo mapparlo in un corrispondente file php. In bootstrap metto tutte le variabili, costanti, funzioni che servono per tutte le pagine -->

<?php
//dobbiamo aggiungere nella cartella db un file database.php che conterrà tutti i metodi per interagire con il database
require_once("db/database.php"); 

require("template/base.php");

?>