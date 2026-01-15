<?php

class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    }  
    
    public function getReviewsByUser($user_id){
        $stmt = $this->db->prepare("SELECT utente_id, professore_id, corso_id, anno_accademico, 
        voto_recensione, voto_esame, data_appello, testo, data_creazione, data_modifica 
        COALESCE(data_modifica, data_creazione) AS data_pubblicazione FROM recensione 
        WHERE utente_id=? ORDER BY data_pubblicazione DESC");

        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProfessorById($professore_id){ //guarda come si gestisce l'immagine
        $stmt = $this->db->prepare("SELECT nome, professore_id, immagineprofilo 
        FROM professore WHERE professore_id=?");
       
        $stmt->bind_param("s", $professore_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCourseById($corso_id){ //forse non mi serve corso_id tra i select
        $stmt = $this->db->prepare("SELECT corso_id, nome FROM corso WHERE corso_id=?");
        
        $stmt->bind_param("s", $corso_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReviewsByProfessor($professore_id, $corso_id){
        $query = "SELECT r.utente_id, r.professore_id, r.corso_id, c.nome AS nome_corso,
        r.anno_accademico, r.voto_recensione, r.voto_esame, r.data_appello,
        r.testo, COALESCE(r.data_modifica, r.data_creazione) AS data_pubblicazione
        FROM recensione r JOIN corso c ON r.corso_id = c.corso_id
        WHERE r.professore_id = ? AND r.corso_id = ? ORDER BY data_pubblicazione DESC";
        
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $corso_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    
}

?>