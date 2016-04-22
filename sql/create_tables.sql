
CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY,
  kayttajatyyppi varchar(50) NOT NULL,
  nimi varchar(50) NOT NULL,
  kayttajatunnus varchar(50) NOT NULL,
  salasana varchar(50) NOT NULL
);

CREATE TABLE Luokka(
  id SERIAL PRIMARY KEY,
  kayttaja_id INTEGER REFERENCES Kayttaja(id), 
  nimi varchar(50) NOT NULL,
  kuvaus varchar(400)  
  );

CREATE TABLE Tehtava(
  id SERIAL PRIMARY KEY,
  kayttaja_id INTEGER REFERENCES Kayttaja(id),
  nimi varchar(50) NOT NULL,
  status varchar(50),
  luokka_id INTEGER REFERENCES Luokka(id),
  kuvaus varchar(400),
  prioriteetti varchar(50) 
  );

  CREATE TABLE Liitos(
  id SERIAL PRIMARY KEY,
  tehtava_id INTEGER REFERENCES Tehtava(id),
  luokka_id INTEGER REFERENCES Luokka(id)
  );

