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
  
    
    // UTENTE LOGIN (utente_id = email)
    public function checkLogin($utente_id, $password){
        $query = "SELECT nome, utente_id, ruolo, immagineprofilo
                  FROM utente
                  WHERE attivo=1 AND utente_id = ? AND password = ?
                  LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $utente_id, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }  
    
        public function getProfessorRankings(){
    $query = "SELECT p.nome AS docente,
                     c.nome AS corso,
                     AVG(r.voto_recensione) AS media_recensioni,
                     AVG(r.voto_esame) AS media_esami
              FROM recensione r
              JOIN professore p ON r.professore_id = p.professore_id
              JOIN corso c ON r.corso_id = c.corso_id
              GROUP BY r.professore_id, r.corso_id
              ORDER BY media_recensioni DESC, media_esami DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);

}

    public function getReviewsByUser($user_id){
        $stmt = $this->db->prepare("SELECT *, 
        COALESCE(data_modifica, data_creazione) AS data_pubblicazione FROM recensione 
        WHERE utente_id=? ORDER BY data_pubblicazione DESC");

        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfessorById($professore_id){
        $stmt = $this->db->prepare("SELECT nome, professore_id, immagineprofilo 
        FROM professore WHERE professore_id=?");
       
        $stmt->bind_param("s", $professore_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getCourseById($corso_id){ //forse non mi serve corso_id tra i select
        $stmt = $this->db->prepare("SELECT corso_id, nome FROM corso WHERE corso_id=?");
        
        $stmt->bind_param("s", $corso_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getReviewsByProfessor($professore_id, $corso_id){
        $query = "SELECT r.utente_id, r.professore_id, r.corso_id, c.nome AS nome_corso,
        r.anno_accademico, r.voto_recensione, r.voto_esame, r.data_appello,
        r.testo, COALESCE(r.data_modifica, r.data_creazione) AS data_pubblicazione
        FROM recensione r JOIN corso c ON r.corso_id = c.corso_id
        WHERE r.professore_id = ? AND r.corso_id = ? ORDER BY data_pubblicazione DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $professore_id, $corso_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAverageByProfessorAndCourse($professore_id, $corso_id){
        // arrotondamento ad 1 decimale
        $query = "SELECT ROUND(AVG(voto_recensione), 1) AS media_recensioni,
        ROUND(AVG(voto_esame), 1) AS media_voti FROM recensione WHERE professore_id = ?
        AND corso_id = ?";        

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $professore_id, $corso_id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }


    public function changePassword($utente_id, $oldPassword, $newPassword) {
        $stmt = $this->db->prepare( "SELECT password FROM utente WHERE utente_id = ?");
                   
        $stmt->bind_param("s", $utente_id);
        $stmt->execute();
        $result = $stmt->get_result();

        //controllo aggiuntivo
        if ($result->num_rows !== 1) {
            return false;
        }

        $row = $result->fetch_assoc();

        //confronto con la vecchia password
        if ($row["password"] !== $oldPassword) {
            return false;
        }

        // update nuova password
        $stmt = $this->db->prepare(
            "UPDATE utente SET password = ? WHERE utente_id = ?"
        );
        $stmt->bind_param("ss", $newPassword, $utente_id);

        return $stmt->execute();
    }

    public function insertRecensione($utente_id, $professore_id, $corso_id, $anno_accademico, 
        $voto_recensione, $voto_esame, $data_appello, $testo){
        if ($voto_esame === null){
            $stmt = $this->db->prepare("INSERT INTO recensione 
                (utente_id, professore_id, corso_id, anno_accademico, voto_recensione, voto_esame, data_appello, testo)
                VALUES (?, ?, ?, ?, ?, NULL, ?, ?)");
           
            $stmt->bind_param("sssiiss", $utente_id, $professore_id, $corso_id, $anno_accademico, $voto_recensione, $data_appello, $testo);
        } else {
            $stmt = $this->db->prepare("INSERT INTO recensione 
                (utente_id, professore_id, corso_id, anno_accademico, voto_recensione, voto_esame, data_appello, testo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
           
            $stmt->bind_param("ssssiiss", $utente_id, $professore_id, $corso_id, $anno_accademico, $voto_recensione, $voto_esame, $data_appello, $testo);
        }
        return $stmt->execute();

    }

    public function getAllProfessors(){
        $stmt = $this->db->prepare("SELECT * FROM professore");

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

     public function getProfessorsAndCoursesWithYears() {
        $query = "SELECT i.professore_id, p.nome AS nome_professore, i.corso_id, c.nome AS nome_corso, i.anno_accademico
                  FROM insegnamento i
                  JOIN professore p ON i.professore_id = p.professore_id
                  JOIN corso c ON i.corso_id = c.corso_id
                  ORDER BY p.nome, c.nome, i.anno_accademico";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
 
    public function getAppelli() {
        $query = "SELECT professore_id, corso_id, anno_accademico,
                        data_appello
                FROM appello
                ORDER BY data_appello ASC";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function checkReviewExists($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello) {
    $query = "SELECT COUNT(*) AS cnt
              FROM recensione
              WHERE utente_id = ?
                AND professore_id = ?
                AND corso_id = ?
                AND anno_accademico = ?
                AND data_appello = ?";

    $stmt = $this->db->prepare($query);
        if (!$stmt) {
            throw new Exception("Errore nella preparazione della query: " . $this->db->error);
        }

        $stmt->bind_param("sssss", $utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['cnt'] > 0; // true se esiste già, false altrimenti
    }


 
}


?>