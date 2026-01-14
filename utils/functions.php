<?php
//funzione per capire in che pagina sei + aggiungere classe active al menù 
function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " class='active' ";
    }
}

//per capire se utente ha loggato, controlla se è settato il campo idautore di sessione
function isUserLoggedIn(){
    return !empty($_SESSION['utente_id']);
}

//per registrare un utente loggato che dato un parametro user setta questi tre campi nella sessione
function registerLoggedUser($user){
    $_SESSION["utente_id"] = $user["utente_id"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["ruolo"] = $user["ruolo"];
    $_SESSION["immagineprofilo"] = $user["immagineprofilo"];
}
 
// redirect a login.php se l'utente non è autenticato
function requireLogin(){
    if(!isUserLoggedIn()){
        header("Location: login.php");
        exit;
    }
    
//per caricare immagini, specifico percorso per caricare immagine (percorso salvato nella costante UPLOAD.DIR) + immagine che viene caricata
function uploadImage($path, $image){

    //funzione basename che estrae nome del file dal campo dell'immagine
    $imageName = basename($image["name"]);
    $fullPath = $path.$imageName;
    

    //dim max consentita + accettiamo solo jpg jpeg png git
    $maxKB = 500;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");


    //se vale zero vuol dire che c'è errore, impostata 1 se non riscontra errori
    $result = 0;
    //collezione di eventuali messaggi di errori 
    $msg = "";


    //Controllo se immagine è veramente un'immagine, con getimagesize estraggo dim img (funziona solo se file file input è un immagine, se è false non è stata caricata un immagine)
    $imageSize = getimagesize($image["tmp_name"]);
    if($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }


    //Controllo dimensione dell'immagine < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }


    //Controllo estensione del file sia valida (png, jpg, jpeg...)
    $imageFileType = strtolower(pathinfo($fullPath,PATHINFO_EXTENSION));
    if(!in_array($imageFileType, $acceptedExtensions)){
        $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
    }

    //Controllo se esiste file con stesso nome ed eventualmente lo rinomino
    //se esiste già foto.jpg --> lo rinomino in foto_2.jpg (nel do while incrementa)
    if (file_exists($fullPath)) {
        $i = 1;
        do{
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME)."_$i.".$imageFileType;
        }
        while(file_exists($path.$imageName));
        $fullPath = $path.$imageName;
    }

    //Se non ci sono errori, sposto il file dalla posizione temporanea alla cartella di destinazione
    //controllo se msg è 0 come stringa, se è vuoto (= non c'è stato un errore) --> Sposta il file dalla cartella temporanea di PHP (tmp_name) alla destinazione finale ($fullPath, tipo upload/foto_2.jpg).
    //se move_uploaded_file fallisce messaggio di errore
    //altrimenti “successo = 1” e in $msg mette il nome del file salvato (non un messaggio testuale), così chi chiama la funzione può salvarlo nel DB o stamparlo.
return array($result, $msg);
    if(strlen($msg)==0){
        if(!move_uploaded_file($image["tmp_name"], $fullPath)){
            $msg.= "Errore nel caricamento dell'immagine.";
        }
        else{
            $result = 1;
            $msg = $imageName;
        }
    }
    return array($result, $msg);
}

?>