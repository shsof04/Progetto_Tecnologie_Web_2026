USE uniborankings;

-- Utenti id = email
INSERT INTO utente (nome, utente_id, password, ruolo, immagineprofilo) VALUES 
('Admin', 'admin@uniborankings.it', 'admin', 'ADMIN', 'logo.PNG'),
('Moira Quartieri', 'moira.quartieri@studio.unibo.it', 'pass1', 'STUDENTE', 'MoiraQuartieri.jpeg'),
('Nico Tedeschi', 'nico.tedeschi@studio.unibo.it', 'pass2', 'STUDENTE', 'NicoTedeschi.png'),
('Matteo Nencioni', 'matteo.nencioni@studio.unibo.it', 'pass3', 'STUDENTE', 'MatteoNencioni.jpg');

-- Professori id = email
INSERT INTO professore (nome, professore_id, immagineprofilo) VALUES
('Gianluca Torre', 'gianluca.torre@unibo.it', 'GianlucaTorre.jpg'),
('Ida Di Filippo', 'ida.difilippo@unibo.it', 'IdaDiFilippo.png'),
('Mariana DAmico', 'mariana.damico@unibo.it', 'MarianaDAmico.jpg'),
('Nadia Mayer', 'nadia.mayer@unibo.com', 'NadiaMayer.jpeg'),
('Corrado Sassu', 'corrado.sassu@unibo.com', 'CorradoSassu.png'),
('Blasco Pulieri', 'blasco.pulieru@unibo.com', 'BlascoPulieri.jpg');

-- Corsi
INSERT INTO corso (corso_id, nome) VALUES
('ArchEla', 'Architetture degli Elaboratori'),
('BasiDati', 'Basi di Dati'),
('Progr', 'Programmazione'),
('Critt', 'Crittografia'),
('TechWeb', 'Tecnologie Web');

-- Insegnamenti (lezioni)
INSERT INTO insegnamento (professore_id, corso_id, ruolo, anno_accademico) VALUES
('gianluca.torre@unibo.it', 'ArchEla', 'LEZIONI', '2025-2026'),
('gianluca.torre@unibo.it', 'ArchEla', 'LABORATORIO', '2025-2026'),
('ida.difilippo@unibo.it', 'BasiDati', 'LEZIONI', '2025-2026'),
('ida.difilippo@unibo.it', 'BasiDati', 'LABORATORIO', '2025-2026'),
('mariana.damico@unibo.it', 'Progr', 'LEZIONI', '2025-2026'),
('corrado.sassu@unibo.com', 'Progr', 'LABORATORIO', '2025-2026'),
('nadia.mayer@unibo.com', 'Critt', 'LEZIONI', '2025-2026'),
('nadia.mayer@unibo.com', 'TechWeb', 'LEZIONI', '2025-2026'),
('blasco.pulieru@unibo.com', 'TechWeb', 'LABORATORIO', '2025-2026'),

('blasco.pulieru@unibo.com', 'ArchEla', 'LEZIONI', '2024-2025'),
('gianluca.torre@unibo.it', 'ArchEla', 'LABORATORIO', '2024-2025'),
('ida.difilippo@unibo.it', 'BasiDati', 'LEZIONI', '2024-2025'),
('ida.difilippo@unibo.it', 'BasiDati', 'LABORATORIO', '2024-2025'),
('nadia.mayer@unibo.com', 'Progr', 'LEZIONI', '2024-2025'),
('corrado.sassu@unibo.com', 'Progr', 'LABORATORIO', '2024-2025'),
('mariana.damico@unibo.it', 'Critt', 'LEZIONI', '2024-2025'),
('nadia.mayer@unibo.com', 'TechWeb', 'LEZIONI', '2024-2025'),
('corrado.sassu@unibo.com', 'TechWeb', 'LABORATORIO', '2024-2025'),

('gianluca.torre@unibo.it', 'ArchEla', 'LEZIONI', '2023-2024'),
('gianluca.torre@unibo.it', 'ArchEla', 'LABORATORIO', '2023-2024'),
('ida.difilippo@unibo.it', 'BasiDati', 'LEZIONI', '2023-2024'),
('ida.difilippo@unibo.it', 'BasiDati', 'LABORATORIO', '2023-2024'),
('mariana.damico@unibo.it', 'Progr', 'LEZIONI', '2023-2024'),
('mariana.damico@unibo.it', 'Progr', 'LABORATORIO', '2023-2024'),
('nadia.mayer@unibo.com', 'Critt', 'LEZIONI', '2023-2024'),
('nadia.mayer@unibo.com', 'TechWeb', 'LEZIONI', '2023-2024'),
('blasco.pulieru@unibo.com', 'TechWeb', 'LABORATORIO', '2023-2024');

-- Appelli
INSERT INTO appello (professore_id, corso_id, anno_accademico, data_appello) VALUES
('gianluca.torre@unibo.it', 'ArchEla',  '2025-2026', '2026-01-09'),
('ida.difilippo@unibo.it',  'BasiDati', '2025-2026', '2026-01-15'),
('mariana.damico@unibo.it', 'Progr',    '2025-2026', '2026-01-22'),

('blasco.pulieru@unibo.com','ArchEla',  '2024-2025', '2025-09-14'),
('nadia.mayer@unibo.com',   'TechWeb',  '2024-2025', '2025-08-29'),
('corrado.sassu@unibo.com', 'TechWeb',  '2024-2025', '2024-12-23'),

('gianluca.torre@unibo.it', 'ArchEla',  '2023-2024', '2024-01-13'),
('ida.difilippo@unibo.it',  'BasiDati', '2023-2024', '2024-01-22'),
('ida.difilippo@unibo.it',  'BasiDati', '2023-2024', '2024-02-18');



-- Recensioni 
INSERT INTO recensione
(utente_id, professore_id, corso_id, anno_accademico, voto_recensione, voto_esame, data_appello, testo)
VALUES
('nico.tedeschi@studio.unibo.it', 'gianluca.torre@unibo.it', 'ArchEla', '2025-2026', 9, 28, '2026-01-09', 'Spiega bene, esame coerente con le lezioni.'),
('moira.quartieri@studio.unibo.it', 'ida.difilippo@unibo.it', 'BasiDati', '2025-2026', 8, 26, '2026-01-15', 'Corso chiaro, ma serve allenarsi molto sugli esercizi.'),
('matteo.nencioni@studio.unibo.it', 'mariana.damico@unibo.it', 'Progr', '2025-2026', 8, 24, '2026-01-22', 'Ritmo veloce, ma spiegazioni utili e disponibili a ricevimento.');
