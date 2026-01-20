USE uniborankings;

-- Utenti id = email
INSERT INTO utente (nome, utente_id, password, ruolo, immagineprofilo) VALUES 
('Admin', 'admin@uniborankings.it', 'admin', 'ADMIN', 'resources/logo.PNG'),
('Moira Quartieri', 'moira.quartieri@studio.unibo.it', 'pass1', 'STUDENTE', 'resources/MoiraQuartieri.jpeg'),
('Nico Tedeschi', 'nico.tedeschi@studio.unibo.it', 'pass2', 'STUDENTE', 'resources/NicoTedeschi.png'),
('Matteo Nencioni', 'matteo.nencioni@studio.unibo.it', 'pass3', 'STUDENTE', 'resources/MatteoNencioni.jpg');

-- Professori id = email
INSERT INTO professore (nome, professore_id, immagineprofilo) VALUES
('Gianluca Torre', 'gianluca.torre@unibo.it', 'resources/GianlucaTorre.jpg'),
('Ida Di Filippo', 'ida.difilippo@unibo.it', 'resources/IdaDiFilippo.png'),
('Mariana DAmico', 'mariana.damico@unibo.it', 'resources/MarianaDAmico.jpg'),
('Nadia Mayer', 'nadia.mayer@unibo.com', 'resources/NadiaMayer.jpeg'),
('Corrado Sassu', 'corrado.sassu@unibo.com', 'resources/CorradoSassu.png'),
('Blasco Pulieri', 'blasco.pulieri@unibo.com', 'resources/BlascoPulieri.jpg');

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
('blasco.pulieri@unibo.com', 'TechWeb', 'LABORATORIO', '2025-2026'),

('blasco.pulieri@unibo.com', 'ArchEla', 'LEZIONI', '2024-2025'),
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
('blasco.pulieri@unibo.com', 'TechWeb', 'LABORATORIO', '2023-2024');

-- Appelli
INSERT INTO appello (professore_id, corso_id, anno_accademico, data_appello) VALUES
('gianluca.torre@unibo.it', 'ArchEla', '2025-2026', '2026-01-09'),
('ida.difilippo@unibo.it', 'BasiDati', '2025-2026', '2026-01-15'),
('mariana.damico@unibo.it', 'Progr', '2025-2026', '2026-01-22'),
('gianluca.torre@unibo.it', 'ArchEla', '2025-2026', '2026-02-11'),
('ida.difilippo@unibo.it', 'BasiDati', '2025-2026', '2026-01-30'),
('mariana.damico@unibo.it', 'Progr', '2025-2026', '2026-02-10'),
('gianluca.torre@unibo.it', 'ArchEla', '2025-2026', '2025-12-22'),
('corrado.sassu@unibo.com', 'Progr', '2025-2026', '2026-01-16'),
('corrado.sassu@unibo.com', 'Progr', '2025-2026', '2026-01-23'),
('gianluca.torre@unibo.it', 'ArchEla', '2025-2026', '2026-02-11'),
('nadia.mayer@unibo.com', 'Critt', '2025-2026', '2026-01-10'),
('nadia.mayer@unibo.com', 'Critt', '2025-2026', '2026-02-12'),
('blasco.pulieri@unibo.com', 'TechWeb', '2025-2026', '2026-01-11'),
('blasco.pulieri@unibo.com', 'TechWeb', '2025-2026', '2026-02-13'),

('blasco.pulieri@unibo.com','ArchEla', '2024-2025', '2025-09-14'),
('nadia.mayer@unibo.com', 'TechWeb', '2024-2025', '2025-08-29'),
('corrado.sassu@unibo.com', 'Progr', '2024-2025', '2024-12-23'),
('blasco.pulieri@unibo.com','ArchEla', '2024-2025', '2025-09-5'),
('nadia.mayer@unibo.com', 'TechWeb', '2024-2025', '2025-09-7'),
('nadia.mayer@unibo.com', 'TechWeb', '2024-2025', '2024-12-20'),
('gianluca.torre@unibo.it','ArchEla', '2024-2025', '2025-09-15'),
('ida.difilippo@unibo.it', 'BasiDati', '2024-2025', '2025-08-30'),
('ida.difilippo@unibo.it', 'BasiDati', '2024-2025', '2024-12-23'),
('mariana.damico@unibo.it', 'Progr', '2024-2025', '2025-09-6'),
('nadia.mayer@unibo.com', 'Progr', '2024-2025', '2025-09-8'),
('corrado.sassu@unibo.com', 'TechWeb', '2024-2025', '2024-12-21'),

('gianluca.torre@unibo.it', 'ArchEla', '2023-2024', '2024-01-13'),
('ida.difilippo@unibo.it', 'BasiDati', '2023-2024', '2024-01-22'),
('ida.difilippo@unibo.it', 'BasiDati', '2023-2024', '2024-02-18');
('gianluca.torre@unibo.it', 'ArchEla', '2023-2024', '2024-02-13'),
('ida.difilippo@unibo.it', 'BasiDati', '2023-2024', '2024-01-23'),
('ida.difilippo@unibo.it', 'BasiDati', '2023-2024', '2024-02-1');
('mariana.damico@unibo.it', 'Progr', '2023-2024', '2024-01-14'),
('mariana.damico@unibo.it', 'Progr', '2023-2024', '2024-02-5'),
('nadia.mayer@unibo.com', 'Critt', '2023-2024', '2024-01-18');
('nadia.mayer@unibo.com', 'TechWeb', '2023-2024', '2024-01-13'),
('nadia.mayer@unibo.com', 'TechWeb', '2023-2024', '2024-02-11'),
('blasco.pulieri@unibo.com', 'TechWeb', '2023-2024', '2024-02-19');



-- Recensioni 
INSERT INTO recensione
(utente_id, professore_id, corso_id, anno_accademico, voto_recensione, voto_esame, data_appello, testo)
VALUES
('nico.tedeschi@studio.unibo.it', 'gianluca.torre@unibo.it', 'ArchEla', '2025-2026', 9, 28, '2026-01-09', 'Spiega bene, esame coerente con le lezioni.'),
('matteo.nencioni@studio.unibo.it', 'gianluca.torre@unibo.it', 'ArchEla', '2025-2026', 10, 30, '2026-01-09', 'Metto 10 solo perché ho preso 30'),
('moira.quartieri@studio.unibo.it', 'gianluca.torre@unibo.it', 'ArchEla', '2025-2026', 8, 28, '2026-01-09', 'Il prof spiega bene'),

('nico.tedeschi@studio.unibo.it', 'ida.difilippo@unibo.it', 'BasiDati', '2025-2026', 8, 26, '2026-01-15', 'Corso chiaro, ma serve allenarsi molto sugli esercizi.'),
('matteo.nencioni@studio.unibo.it', 'ida.difilippo@unibo.it', 'BasiDati', '2025-2026', 7, 24, '2026-01-15', 'Mi sono molto divertito a fare il progetto'),
('moira.quartieri@studio.unibo.it', 'ida.difilippo@unibo.it', 'BasiDati', '2025-2026', 5, NULL, '2026-01-15', 'esame troppo difficile'),
('moira.quartieri@studio.unibo.it', 'ida.difilippo@unibo.it', 'BasiDati', '2025-2026', 8, 26, '2026-01-30', 'esame più facile, ora ragioniamo'),

('matteo.nencioni@studio.unibo.it', 'mariana.damico@unibo.it', 'Progr', '2025-2026', 8, 24, '2026-01-22', 'Ritmo veloce, ma spiegazioni utili e disponibili a ricevimento.'),
('nico.tedeschi@studio.unibo.it', 'corrado.sassu@unibo.com', 'Progr', '2025-2026', 7, 22, '2026-01-16', 'ok.'),
('moira.quartieri@studio.unibo.it', 'corrado.sassu@unibo.com', 'Progr', '2025-2026', 10, 28, '2026-01-16', 'Il mio corso preferito!'),

('matteo.nencioni@studio.unibo.it', 'nadia.mayer@unibo.com', 'Critt', '2025-2026', 7, 29, '2026-02-12', 'bel corso ma non lo rifarei.'),
('moira.quartieri@studio.unibo.it', 'nadia.mayer@unibo.com', 'Critt', '2025-2026', 8, 26, '2026-02-12', 'Ci sta'),
('nico.tedeschi@studio.unibo.it', 'nadia.mayer@unibo.com', 'Critt', '2025-2026', 9, 27, '2026-02-12', 'Frequentato solo per la prof e non mi sono pentita'),

('matteo.nencioni@studio.unibo.it', 'blasco.pulieri@unibo.com', 'TechWeb', '2025-2026', 8, 30, '2026-02-13', 'Prof molto bravo.'),
('moira.quartieri@studio.unibo.it', 'blasco.pulieri@unibo.com', 'TechWeb', '2025-2026', 8, 26, '2026-02-13', 'Mi è piaciuto'),
('nico.tedeschi@studio.unibo.it', 'blasco.pulieri@unibo.com', 'TechWeb', '2025-2026', 9, 25, '2026-02-13', 'Mi sono divertito a fare il progetto!');