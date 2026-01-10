CREATE DATABASE IF NOT EXISTS uniborankings
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE uniborankings;

-- Utenti (studenti + admin)
CREATE TABLE IF NOT EXISTS utente (
    nome VARCHAR(100) NOT NULL,
    utente_id VARCHAR(255) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    ruolo ENUM('STUDENTE','ADMIN') NOT NULL DEFAULT 'STUDENTE',
    attivo TINYINT NOT NULL DEFAULT 1,
    immagineprofilo VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Professori
CREATE TABLE IF NOT EXISTS professore (
    nome VARCHAR(120) NOT NULL,
    professore_id VARCHAR(255) NOT NULL PRIMARY KEY
) ENGINE=InnoDB;

-- Corsi
CREATE TABLE IF NOT EXISTS corso (
    corso_id VARCHAR(140) NOT NULL PRIMARY KEY
) ENGINE=InnoDB;

-- Insegnamenti (se il professore viene cancellato, vengono cancellati tutti i suoi esami)
CREATE TABLE IF NOT EXISTS insegnamento (
    professore_id INT NOT NULL,
    corso_id INT NOT NULL,
    ruolo ENUM('LEZIONI','LABORATORIO') NOT NULL DEFAULT 'LEZIONI',
    anno_accademico VARCHAR(9) NOT NULL,
    PRIMARY KEY (professore_id, corso_id, ruolo, anno_accademico),
    CONSTRAINT fk_ins_prof FOREIGN KEY (professore_id)
        REFERENCES professore(professore_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_ins_corso FOREIGN KEY (corso_id)
        REFERENCES corso(corso_id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;


-- Recensioni
CREATE TABLE IF NOT EXISTS recensione (
    utente_id INT NOT NULL,
    professore_id INT NOT NULL,
    corso_id INT NOT NULL,
    anno_accademico VARCHAR(9) NOT NULL,
    voto_recensione TINYINT NOT NULL,
    voto_esame DECIMAL(4,1) NULL,
    data_appello DATE NULL,
    testo TEXT NOT NULL,
    data_creazione TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data_modifica TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (professore_id, corso_id, anno_accademico, data_appello),
    CONSTRAINT fk_rec_utente FOREIGN KEY (utente_id) REFERENCES utente(utente_id)
      ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_rec_prof FOREIGN KEY (professore_id) REFERENCES professore(professore_id)
      ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_rec_corso FOREIGN KEY (corso_id) REFERENCES corso(corso_id)
      ON DELETE CASCADE ON UPDATE CASCADE,
      
      UNIQUE (utente_id, professore_id, corso_id, anno_accademico, data_appello)
) ENGINE=InnoDB;
