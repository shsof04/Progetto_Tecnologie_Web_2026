<?php
//per ogni pagina html dobbiamo mapparlo in un corrispondente file php. In bootstrap metto tutte le variabili, costanti, funzioni che servono per tutte le pagine
//Fa tutte le operazioni in comune tra le pagine, includere db + istanziare oggetto della classe databasehelper 


session_start();
//dobbiamo aggiungere nella cartella db un file database.php che conterrà tutti i metodi per interagire con il database
require_once("db/database.php"); 

require("template/base.php");
require_once("utils/functions.php");

//per assegnare i parametri (servername, username, password, nomedatabase, port (il valore che vedi su xampp))
$dbh = new DatabaseHelper("localhost", "root", "", "uniborankings", 3306);

//definisco la costante per l'immagine
define("UPLOAD_DIR", "./resources/");

// anno accademico "corrente" (puoi cambiarlo quando vuoi)
define("CURRENT_AA", "2025-2026");

?>