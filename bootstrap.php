<!-- per ogni pagina html dobbiamo mapparlo in un corrispondente file php. In bootstrap metto tutte le variabili, costanti, funzioni che servono per tutte le pagine -->

<?php
//dobbiamo aggiungere nella cartella db un file database.php che conterrà tutti i metodi per interagire con il database
require_once("db/database.php"); 

//per assegnare i parametri (servername, username, password, nomedatabase, port (il valore che vedi su xampp))
$dbh = new DatabaseHelper("localhost", "root", "", "blogtw", 3306);

//per fare debug, stampa contenuto e tipo variabile per vedere se connessione andata a buon fine
var_dump($dbh)
define("UPLOAD_DIR", "./upload/");

?>