<?php
/*
1. DATABASE.php __ creare metodo per fare la query
2. INDEX.php __ passare metodo con templateparams
3. BASE.php/dove voglio aggiungere nella pagin __ visualizzarlo nella pagina con un ciclo


creo classe databasehelper con i metodi per recuperare i dati
*/


/* definisco una classe (inizia con maiuscola) */ 
class DatabaseHelper{
    /* unica proprietà che contiene i dati della connessione */
    private $db;

    /* definisco costruttore + parametri per instaurare connessione al database */
    public function __construct($servername, $username, $password, $dbname, $port){ 
        //"localhost", "root", "" stringa vuota, "blogtw", 3306 --> numero che vedi in xampp in mysql

        //per accedere ad una proprietà $this->nomeproprietà
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);

        if($this->db->connect_error){
            die("Connessione fallita al db: " . $this->db->connect_error);
        }
        
        // UTF8MB4 per caratteri speciali/emoji
        $this->db->set_charset("utf8mb4");
    }
  
    
    // UTENTE LOGIN 
        public function checkLogin($email, $password){
        $query = "SELECT nome, utente_id, ruolo, immagineprofilo FROM utente WHERE attivo=1 AND utente_id = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss",$email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }   

}

?>