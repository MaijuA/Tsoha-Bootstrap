-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Käyttäjä(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  nimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  käyttäjätunnus varchar(50) NOT NULL,
  salasana varchar(50) NOT NULL
);

CREATE TABLE Tehtävä(
  id SERIAL PRIMARY KEY,
  käyttäjä_id INTEGER REFERENCES Käyttäjä(id), -- Viiteavain Player-tauluun
  nimi varchar(50) NOT NULL,
  tehty boolean DEFAULT FALSE,
  kuvaus varchar(400),
  milloin DATE,
  deadline DATE,
  lisätty DATE,
  
  