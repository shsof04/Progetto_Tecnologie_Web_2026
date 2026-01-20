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
                  WHERE attivo=1 AND utente_id = ? AND BINARY password = ?
                  LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $utente_id, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }  

    // Classifica docenti (media recensioni + media esami) per coppia docente-corso
    public function getProfessorRankings(){
    $query = "SELECT 
                    r.professore_id AS professore_id,
                    r.corso_id AS corso_id,
                    p.nome AS docente,
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

    /*public function getAllReviews() {
        $stmt = $this->db->prepare("SELECT *, 
        COALESCE(data_modifica, data_creazione) AS data_pubblicazione FROM recensione 
        ORDER BY data_pubblicazione DESC");
        
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
    }*/

    public function getAllReviewsWithProfessor() {
        $stmt = $this->db->prepare("SELECT r.*,
           
                p.nome AS nome_professore,
                COALESCE(r.data_modifica, r.data_creazione) AS data_pubblicazione
            FROM recensione r
            JOIN professore p ON r.professore_id = p.professore_id
            ORDER BY data_pubblicazione DESC
        ");

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getReviewsWithProfessorByUser($utente_id){
        $query = "SELECT r.*, p.nome AS nome_professore, COALESCE(data_modifica, data_creazione) AS data_pubblicazione
                FROM recensione r
                JOIN professore p ON r.professore_id = p.professore_id
                WHERE r.utente_id = ?
                ORDER BY data_pubblicazione DESC";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $utente_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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
        $stmt = $this->db->prepare("UPDATE utente SET password = ? WHERE utente_id = ?");

        $stmt->bind_param("ss", $newPassword, $utente_id);

        return $stmt->execute();
    }

    public function insertRecensione($utente_id, $professore_id, $corso_id, $anno_accademico, 
        $voto_recensione, $voto_esame, $data_appello, $testo) {

        if ($voto_esame === null) {
            // Caso "respinto" -> voto_esame = NULL
            $query = "INSERT INTO recensione 
                    (utente_id, professore_id, corso_id, anno_accademico, voto_recensione, voto_esame, data_appello, testo)
                    VALUES (?, ?, ?, ?, ?, NULL, ?, ?)";
            $stmt = $this->db->prepare($query);
            // Tipi: s = string, i = int
            $stmt->bind_param("ssssiss", 
                $utente_id, $professore_id, $corso_id, $anno_accademico, $voto_recensione, $data_appello, $testo
            );
        } else {
            // Caso con voto esame numerico
            $query = "INSERT INTO recensione 
                    (utente_id, professore_id, corso_id, anno_accademico, voto_recensione, voto_esame, data_appello, testo)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ssssiiss", 
                $utente_id, $professore_id, $corso_id, $anno_accademico, $voto_recensione, $voto_esame, $data_appello, $testo
            );
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




    // Corsi per anno accademico con docente teorico + docente laboratorio (se presenti)
    public function getCoursesByAcademicYear($anno_accademico){
        $query = "SELECT c.corso_id,
                         c.nome AS corso_nome,
                         iL.professore_id AS prof_lezioni_id,
                         pL.nome AS prof_lezioni_nome,
                         iB.professore_id AS prof_lab_id,
                         pB.nome AS prof_lab_nome
                  FROM corso c
                  LEFT JOIN insegnamento iL
                    ON iL.corso_id = c.corso_id
                   AND iL.anno_accademico = ?
                   AND iL.ruolo = 'LEZIONI'
                  LEFT JOIN professore pL
                    ON pL.professore_id = iL.professore_id
                  LEFT JOIN insegnamento iB
                    ON iB.corso_id = c.corso_id
                   AND iB.anno_accademico = ?
                   AND iB.ruolo = 'LABORATORIO'
                  LEFT JOIN professore pB
                    ON pB.professore_id = iB.professore_id
                  ORDER BY c.nome";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $anno_accademico, $anno_accademico);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    // anni accademici disponibili (presi dagli appelli)
public function getAcademicYears(){
    $query = "SELECT DISTINCT anno_accademico
              FROM appello
              ORDER BY anno_accademico DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

public function getExamsAllYears(){
    $query = "SELECT a.anno_accademico,
                     a.professore_id,
                     p.nome AS professore_nome,
                     a.corso_id,
                     c.nome AS corso_nome,
                     CASE
                       WHEN iL.professore_id IS NOT NULL THEN 'LEZIONI'
                       WHEN iB.professore_id IS NOT NULL THEN 'LABORATORIO'
                       ELSE ''
                     END AS ruolo,
                     a.data_appello,
                     ROUND(AVG(r.voto_esame),1) AS media_voto_esame,
                     ROUND(AVG(r.voto_recensione),1) AS media_voto_recensione,
                     COUNT(r.utente_id) AS num_recensioni
              FROM appello a
              JOIN professore p ON p.professore_id = a.professore_id
              JOIN corso c ON c.corso_id = a.corso_id
              LEFT JOIN insegnamento iL
                ON iL.professore_id = a.professore_id
               AND iL.corso_id = a.corso_id
               AND iL.anno_accademico = a.anno_accademico
               AND iL.ruolo = 'LEZIONI'
              LEFT JOIN insegnamento iB
                ON iB.professore_id = a.professore_id
               AND iB.corso_id = a.corso_id
               AND iB.anno_accademico = a.anno_accademico
               AND iB.ruolo = 'LABORATORIO'
              LEFT JOIN recensione r
                ON r.professore_id = a.professore_id
               AND r.corso_id = a.corso_id
               AND r.anno_accademico = a.anno_accademico
               AND r.data_appello = a.data_appello
              GROUP BY a.professore_id, a.corso_id, a.anno_accademico, a.data_appello
              ORDER BY a.anno_accademico DESC, a.data_appello DESC, c.nome ASC";

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

    // Appelli (esami) per anno accademico con media voti (dalle recensioni)
    public function getExamsByAcademicYear($anno_accademico){
        // appello non ha "ruolo", quindi lo inferiamo da insegnamento.
        // Se un docente ha sia LEZIONI che LABORATORIO sullo stesso corso/anno,
        // mostriamo una sola riga (priorità: LEZIONI).
        $query = "SELECT a.professore_id,
                         p.nome AS professore_nome,
                         a.corso_id,
                         c.nome AS corso_nome,
                         CASE
                           WHEN iL.professore_id IS NOT NULL THEN 'LEZIONI'
                           WHEN iB.professore_id IS NOT NULL THEN 'LABORATORIO'
                           ELSE ''
                         END AS ruolo,
                         a.data_appello,
                         ROUND(AVG(r.voto_esame),1) AS media_voto_esame,
                         ROUND(AVG(r.voto_recensione),1) AS media_voto_recensione,
                         COUNT(r.utente_id) AS num_recensioni
                  FROM appello a
                  JOIN professore p ON p.professore_id = a.professore_id
                  JOIN corso c ON c.corso_id = a.corso_id
                  LEFT JOIN insegnamento iL
                    ON iL.professore_id = a.professore_id
                   AND iL.corso_id = a.corso_id
                   AND iL.anno_accademico = a.anno_accademico
                   AND iL.ruolo = 'LEZIONI'
                  LEFT JOIN insegnamento iB
                    ON iB.professore_id = a.professore_id
                   AND iB.corso_id = a.corso_id
                   AND iB.anno_accademico = a.anno_accademico
                   AND iB.ruolo = 'LABORATORIO'
                  LEFT JOIN recensione r
                    ON r.professore_id = a.professore_id
                   AND r.corso_id = a.corso_id
                   AND r.anno_accademico = a.anno_accademico
                   AND r.data_appello = a.data_appello
                  WHERE a.anno_accademico = ?
                  GROUP BY a.professore_id, a.corso_id, a.anno_accademico, a.data_appello
                  ORDER BY a.data_appello DESC, c.nome ASC";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $anno_accademico);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Recupera una recensione tramite chiave composta
    public function getReviewByKeys($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello) {
        $query = "SELECT r.*, p.nome AS nome_professore, c.nome AS nome_corso
                FROM recensione r
                JOIN professore p ON r.professore_id = p.professore_id
                JOIN corso c ON r.corso_id = c.corso_id
                WHERE r.utente_id = ? AND r.professore_id = ? AND r.corso_id = ? AND r.anno_accademico = ? AND r.data_appello = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    // Modifica recensione
    public function updateReview($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello, $voto_recensione, $voto_esame, $testo) {
        // Se voto_esame è NULL, lo scriviamo direttamente nella query
        if ($voto_esame === null) {
            $query = "UPDATE recensione
                    SET voto_recensione = ?, voto_esame = NULL, testo = ?, data_modifica = CURRENT_TIMESTAMP
                    WHERE utente_id = ? AND professore_id = ? AND corso_id = ? AND anno_accademico = ? AND data_appello = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("issssss", $voto_recensione, $testo, $utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
        } else {
            $query = "UPDATE recensione
                    SET voto_recensione = ?, voto_esame = ?, testo = ?, data_modifica = CURRENT_TIMESTAMP
                    WHERE utente_id = ? AND professore_id = ? AND corso_id = ? AND anno_accademico = ? AND data_appello = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("iissssss", $voto_recensione, $voto_esame, $testo, $utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
        }

        return $stmt->execute();
    }

    // Cancella recensione
    public function deleteReview($utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello){
        $query = "DELETE FROM recensione 
                  WHERE utente_id = ? AND professore_id = ? AND corso_id = ? AND anno_accademico = ? AND data_appello = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $utente_id, $professore_id, $corso_id, $anno_accademico, $data_appello);
        return $stmt->execute();
    }
 
}

?>