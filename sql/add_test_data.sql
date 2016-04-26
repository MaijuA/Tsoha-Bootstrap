-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (nimi, kayttajatyyppi, kayttajatunnus, salasana) VALUES ('Kalle', 'Kayttaja', 'Kalle123', '***');
INSERT INTO Kayttaja (nimi, kayttajatyyppi, kayttajatunnus, salasana) VALUES ('Pekka', 'Yllapitaja', 'Pekka123', '****');
INSERT INTO Kayttaja (nimi, kayttajatyyppi, kayttajatunnus, salasana) VALUES ('testi', 'Kayttaja', 'testi', 'testi');
INSERT INTO Luokka(nimi) VALUES ('Kotityöt');
INSERT INTO Luokka(nimi) VALUES ('Työt');
INSERT INTO Luokka(nimi) VALUES ('Opiskelu');
INSERT INTO Luokka(nimi, kayttaja_id) VALUES ('opiskelu', '3');