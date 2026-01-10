USE uniborankings;

-- Utenti id = email
INSERT INTO utente (nome, utente_id, password, ruolo, immagineprofilo) VALUES 
('Admin', 'admin@uniborankings.it', 'admin', 'ADMIN', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Seal_of_the_University_of_Bologna.svg/1280px-Seal_of_the_University_of_Bologna.svg.png'),
('Moira Quartieri', 'moira.quartieri@studio.unibo.it', 'pass2026', 'STUDENTE', 'https://cinemaserietv.it/wp-content/uploads/2025/05/moira-quartieri.jpg'),
('Nico Tedeschi', 'nico.tedeschi@studio.unibo.it', 'pass2026', 'STUDENTE', 'https://www.dueesseimmobiliare.com/wp-content/uploads/nico-tedeschi-immagine.png'),
('Matteo Nencioni', 'matteo.nencioni@studio.unibo.it', 'pass2026', 'STUDENTE', 'https://blog.immobiliarenencioni.it/wp-content/uploads/2022/11/bc14d32c-fefc-4288-9442-57e662f62393.jpg');

-- Professori id = email
INSERT INTO professore (nome, professore_id, immagineprofilo) VALUES
('Gianluca Torre', 'gianluca.torre@unibo.it', 'https://wips.plug.it/cips/libero.it/magazine/cms/2024/07/gianluca-torre.jpg?w=785&h=494&a=c'),
('Ida Di Filippo', 'ida.difilippo@unibo.it', 'https://www.realizenetworks.com/wp-content/uploads/2023/07/ida-di-filippo.png'),
('Mariana D''Amico', 'mariana.damico@unibo.it', 'https://wips.plug.it/cips/libero.it/magazine/cms/2024/11/mariana_damico.jpg'),
('Nadia Mayer', 'nadia.mayer@unibo.com', 'https://media-assets.vanityfair.it/photos/68383323161cc8c418c7300d/4:3/w_1064,h_798,c_limit/Nadia%2019.jpeg'),
('Corrado Sassu', 'corrado.sassu@unibo.com', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTr5hpmM4yLKOXBzjddzmNveH8-jjynGJibVw&s'),
('Blasco Pulieri', 'blasco.pulieru@unibo.com', 'https://www.ritagiorgi.it/wp-content/uploads/2019/12/Blasco-Pulieri-400x500_c.jpg');

-- Corsi
INSERT INTO corso (corso_id) VALUES
('Architetture degli Elaboratori'),
('Basi di Dati'),
('Programmazione'),
('Crittografia')
('Tecnologie Web');

-- Insegnamenti (lezioni)
INSERT INTO insegnamento (professore_id, corso_id, ruolo, anno_accademico) VALUES
('gianluca.torre@unibo.it', 'Architetture degli Elaboratori', 'LEZIONI', '2025-2026'),
('gianluca.torre@unibo.it', 'Architetture degli Elaboratori', 'LABORATORIO', '2025-2026'),
('ida.difilippo@unibo.it', 'Basi di Dati', 'LEZIONI', '2025-2026'),
('ida.difilippo@unibo.it', 'Basi di Dati', 'LABORATORIO', '2025-2026'),
('mariana.damico@unibo.it', 'Programmazione', 'LEZIONI', '2025-2026'),
('corrado.sassu@unibo.com', 'Programmazione', 'LABORATORIO', '2025-2026'),
('nadia.mayer@unibo.com', 'Crittografia', 'LEZIONI', '2025-2026'),
('nadia.mayer@unibo.com', 'Tecnologie Web', 'LEZIONI', '2025-2026'),
('blasco.pulieru@unibo.com', 'Tecnologie Web', 'LABORATORIO', '2025-2026'),

('blasco.pulieru@unibo.com', 'Architetture degli Elaboratori', 'LEZIONI', '2024-2025'),
('gianluca.torre@unibo.it', 'Architetture degli Elaboratori', 'LABORATORIO', '2024-2025'),
('ida.difilippo@unibo.it', 'Basi di Dati', 'LEZIONI', '2024-2025'),
('ida.difilippo@unibo.it', 'Basi di Dati', 'LABORATORIO', '2024-2025'),
('nadia.mayer@unibo.com', 'Programmazione', 'LEZIONI', '2024-2025'),
('corrado.sassu@unibo.com', 'Programmazione', 'LABORATORIO', '2024-2025'),
('mariana.damico@unibo.it', 'Crittografia', 'LEZIONI', '2024-2025'),
('nadia.mayer@unibo.com', 'Tecnologie Web', 'LEZIONI', '2024-2025'),
('corrado.sassu@unibo.com', 'Tecnologie Web', 'LABORATORIO', '2024-2025'),

('gianluca.torre@unibo.it', 'Architetture degli Elaboratori', 'LEZIONI', '2023-2024'),
('gianluca.torre@unibo.it', 'Architetture degli Elaboratori', 'LABORATORIO', '2023-2024'),
('ida.difilippo@unibo.it', 'Basi di Dati', 'LEZIONI', '2023-2024'),
('ida.difilippo@unibo.it', 'Basi di Dati', 'LABORATORIO', '2023-2024'),
('mariana.damico@unibo.it', 'Programmazione', 'LEZIONI', '2023-2024'),
('mariana.damico@unibo.it', 'Programmazione', 'LABORATORIO', '2023-2024'),
('nadia.mayer@unibo.com', 'Crittografia', 'LEZIONI', '2023-2024'),
('nadia.mayer@unibo.com', 'Tecnologie Web', 'LEZIONI', '2023-2024'),
('blasco.pulieru@unibo.com', 'Tecnologie Web', 'LABORATORIO', '2023-2024');

-- Recensioni (utente_id = 2 è Blasco)
INSERT INTO recensione
(utente_id, professore_id, corso_id, anno_accademico, voto_recensione, voto_esame, data_appello, testo)
VALUES
('nico.tedeschi@studio.unibo.it', 'gianluca.torre@unibo.it', 'Architetture degli Elaboratori', '2025-2026', 9, 28.5, '2026-01-09', 'Spiega bene, esame coerente con le lezioni.'),
('moira.quartieri@studio.unibo.it', 'ida.difilippo@unibo.it', 'Basi di Dati', '2025-2026', 8, 26.7, '2026-01-15', 'Corso chiaro, ma serve allenarsi molto sugli esercizi.'),
('matteo.nencioni@studio.unibo.it', 'mariana.damico@unibo.it', 'Programmazione', '2025-2026', 8, 24.0, '2026-01-22', 'Ritmo veloce, ma spiegazioni utili e disponibili a ricevimento.');
