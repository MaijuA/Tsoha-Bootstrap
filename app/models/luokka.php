<?php

class Luokka extends BaseModel {

    public $id, $kayttaja_id, $nimi, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_kuvaus');
    }

    // listaa käyttäjän luokat
    public static function all($kayttaja_id) {
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE kayttaja_id = :kayttaja_id');
        $query->execute(array('kayttaja_id' => $kayttaja_id));
        $rows = $query->fetchAll();
        $luokat = array();
        foreach ($rows as $row) {
            $luokat[] = new Luokka(array(
                'id' => $row['id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $luokat;
    }

    // etsi luokka
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $luokka = new Luokka(array(
                'id' => $row['id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));
            return $luokka;
        }
        return null;
    }

    // tallenna luokka
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Luokka (nimi, kayttaja_id, kuvaus) VALUES (:nimi, :kayttaja_id, :kuvaus) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kayttaja_id' => $this->kayttaja_id, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
    }

    // muokkaa luokkaa
    public function update($id, $attributes) {
        $query = DB::connection()->prepare('UPDATE Luokka SET (nimi = :nimi, kayttaja_id = :kayttaja_id, kuvaus = :kuvaus)');
        $query->execute(array('nimi' => $this->nimi, 'kayttaja_id' => $this->kayttaja_id, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
        Kint::dump($row);
    }

    // poista luokka
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Luokka WHERE id = :id');
        $query->execute(array('id' => $id));
    }

    // tarkista, että luokan nimi on oikeassa muodossa
    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
        }
        if (strlen($this->nimi) > 50) {
            $errors[] = 'Nimi saa olla korkeintaan 50 merkkiä pitkä!';
        }
        return $errors;
    }

    // tarkista, ettei luokan kuvaus ole liian pitkä
    public function validate_kuvaus() {
        $errors = array();
        if (strlen($this->kuvaus) > 400) {
            $errors[] = 'Kuvaus saa olla korkeintaan 400 merkkiä pitkä!';
        }
        return $errors;
    }

}
