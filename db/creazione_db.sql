CREATE DATABASE IF NOT EXISTS uniborankings
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE uniborankings;

-- Utenti (studenti + admin)
CREATE TABLE IF NOT EXISTS utente (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  ruolo ENUM('STUDENTE','ADMIN') NOT NULL DEFAULT 'STUDENTE',
  attivo TINYINT NOT NULL DEFAULT 1
) ENGINE=InnoDB;

-- Professori
CREATE TABLE IF NOT EXISTS professore (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(120) NOT NULL,
  email VARCHAR(255) NULL
) ENGINE=InnoDB;

-- Corsi
CREATE TABLE IF NOT EXISTS corso (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(140) NOT NULL,
  cfu TINYINT NULL
) ENGINE=InnoDB;

-- Insegnamenti (chi tiene cosa e con che ruolo: lezioni/lab)
CREATE TABLE IF NOT EXISTS insegnamento (
  id INT AUTO_INCREMENT PRIMARY KEY,
  professore_id INT NOT NULL,
  corso_id INT NOT NULL,
  ruolo ENUM('LEZIONI','LAB') NOT NULL DEFAULT 'LEZIONI',
  anno_accademico VARCHAR(9) NOT NULL, -- es: 2025-2026
  CONSTRAINT fk_ins_prof FOREIGN KEY (professore_id) REFERENCES professore(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_ins_corso FOREIGN KEY (corso_id) REFERENCES corso(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  UNIQUE (professore_id, corso_id, ruolo, anno_accademico)
) ENGINE=InnoDB;

-- Recensioni
CREATE TABLE IF NOT EXISTS recensione (
  id INT AUTO_INCREMENT PRIMARY KEY,
  utente_id INT NOT NULL,       -- chi scrive
  professore_id INT NOT NULL,   -- prof recensito
  corso_id INT NOT NULL,        -- corso
  anno_accademico VARCHAR(9) NOT NULL,
  voto_recensione TINYINT NOT NULL,      -- 1..10
  voto_esame DECIMAL(4,1) NULL,          -- es: 28.5
  data_appello DATE NULL,
  testo TEXT NOT NULL,
  data_creazione TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_modifica TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_rec_utente FOREIGN KEY (utente_id) REFERENCES utente(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_rec_prof FOREIGN KEY (professore_id) REFERENCES professore(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_rec_corso FOREIGN KEY (corso_id) REFERENCES corso(id)
    ON DELETE CASCADE ON UPDATE CASCADE,
    
    UNIQUE (utente_id, professore_id, corso_id, anno_accademico)
) ENGINE=InnoDB;
