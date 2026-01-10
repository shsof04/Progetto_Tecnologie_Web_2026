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
INSERT INTO insegnamento (professore_id, corso_id, ruolo, anno_accademico) VALUES -- come si specifica quale è l'id?
(1, 1, 'LEZIONI', '2025-2026'),                                                     -- nelle tabelle di creazione!
(2, 2, 'LEZIONI', '2025-2026'),
(3, 3, 'LEZIONI', '2025-2026'); -- mettere tutti i corsi e anche quelli degli anni precedenti?

-- Recensioni (utente_id = 2 è Blasco)
INSERT INTO recensione
(utente_id, professore_id, corso_id, anno_accademico, voto_recensione, voto_esame, data_appello, testo)
VALUES
(2, 1, 1, '2025-2026', 9, 28.5, '2026-01-09', 'Spiega bene, esame coerente con le lezioni.'),
(2, 2, 2, '2025-2026', 8, 26.7, '2026-01-15', 'Corso chiaro, ma serve allenarsi molto sugli esercizi.'),
(2, 3, 3, '2025-2026', 8, 24.0, '2026-01-22', 'Ritmo veloce, ma spiegazioni utili e disponibili a ricevimento.');
