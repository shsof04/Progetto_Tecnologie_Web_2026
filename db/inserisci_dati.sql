USE uniborankings;

-- Utenti
INSERT INTO utente (nome, email, password, ruolo, attivo) VALUES
('Admin', 'admin@uniborankings.it', 'admin', 'ADMIN', 1),
('Blasco Pulieri', 'blasco.pulieri@studio.unibo.it', 'pass2026', 'STUDENTE', 1);

-- Professori
INSERT INTO professore (nome, email) VALUES
('Gianluca Torre', 'gianluca.torre@unibo.it'),
('Ida Di Filippo', 'ida.difilippo@unibo.it'),
('Mariana D''Amico', 'mariana.damico@unibo.it');

-- Corsi
INSERT INTO corso (nome, cfu) VALUES
('Architetture degli Elaboratori', 12),
('Basi di Dati', 12),
('Programmazione', 12);

-- Insegnamenti (lezioni)
INSERT INTO insegnamento (professore_id, corso_id, ruolo, anno_accademico) VALUES
(1, 1, 'LEZIONI', '2025-2026'),
(2, 2, 'LEZIONI', '2025-2026'),
(3, 3, 'LEZIONI', '2025-2026');

-- Recensioni (utente_id = 2 è Blasco)
INSERT INTO recensione
(utente_id, professore_id, corso_id, anno_accademico, voto_recensione, voto_esame, data_appello, testo)
VALUES
(2, 1, 1, '2025-2026', 9, 28.5, '2026-01-09', 'Spiega bene, esame coerente con le lezioni.'),
(2, 2, 2, '2025-2026', 8, 26.7, '2026-01-15', 'Corso chiaro, ma serve allenarsi molto sugli esercizi.'),
(2, 3, 3, '2025-2026', 8, 24.0, '2026-01-22', 'Ritmo veloce, ma spiegazioni utili e disponibili a ricevimento.');
