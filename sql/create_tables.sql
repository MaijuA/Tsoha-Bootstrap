
CREATE TABLE Käyttäjä(
  id SERIAL PRIMARY KEY,
  käyttäjätyyppi varchar(50) NOT NULL,
  nimi varchar(50) NOT NULL,
  käyttäjätunnus varchar(50) NOT NULL,
  salasana varchar(50) NOT NULL
);

CREATE TABLE Tehtävä(
  id SERIAL PRIMARY KEY,
  käyttäjä_id INTEGER REFERENCES Käyttäjä(id),
  nimi varchar(50) NOT NULL,
  status boolean DEFAULT FALSE,
  kuvaus varchar(400),
  prioriteetti varchar(5)
  
  );
  

CREATE TABLE Luokka(
  id SERIAL PRIMARY KEY,
  käyttäjä_id INTEGER REFERENCES Käyttäjä(id), 
  nimi varchar(50) NOT NULL
  
  
  );