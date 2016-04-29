-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana) VALUES ('Kalle', 'Kalle123', '***');
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana) VALUES ('Pekka', 'Pekka123', '****');
INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana) VALUES ('testi', 'testi', 'testi');
INSERT INTO Luokka(nimi) VALUES ('Kotityöt');
INSERT INTO Luokka(nimi) VALUES ('Työt');
INSERT INTO Luokka(nimi) VALUES ('Opiskelu');
INSERT INTO Luokka(nimi, kayttaja_id) VALUES ('opiskelu', '3');