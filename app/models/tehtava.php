<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tehtava extends BaseModel {

    public $id, $kayttaja_id, $nimi, $prioriteetti, $luokka_id, $status, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_kuvaus');
    }

    // listaa käyttäjän tehtävät
    public static function all($kayttaja_id) {
        $query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE kayttaja_id = :kayttaja_id');
        $query->execute(array('kayttaja_id' => $kayttaja_id));
        $rows = $query->fetchAll();
        $tehtavat = array();
        foreach ($rows as $row) {
            $tehtavat[] = new Tehtava(array(
                'id' => $row['id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'nimi' => $row['nimi'],
                'prioriteetti' => $row['prioriteetti'],
                'luokka_id' => $row['luokka_id'],
                'status' => $row['status'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $tehtavat;
    }

    // etsi tehtävä
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $tehtava = new Tehtava(array(
                'id' => $row['id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'nimi' => $row['nimi'],
                'prioriteetti' => $row['prioriteetti'],
                'luokka_id' => $row['luokka_id'],
                'status' => $row['status'],
                'kuvaus' => $row['kuvaus']
            ));
            return $tehtava;
        }
        return null;
    }

    // tallenna tehtävä
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tehtava (nimi, kayttaja_id, prioriteetti, status, luokka_id, kuvaus) VALUES (:nimi, :kayttaja_id, :prioriteetti, :status, :luokka_id, :kuvaus) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kayttaja_id' => $this->kayttaja_id, 'prioriteetti' => $this->prioriteetti, 'status' => $this->status, 'luokka_id' => $this->luokka_id, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    // muokkaa tehtävää
    public function update($id, $attributes) {
        $query = DB::connection()->prepare('UPDATE Tehtava SET (nimi = :nimi, kayttaja_id = :kayttaja_id, luokka_id = :luokka_id, status = :status, prioriteetti = :prioriteetti, kuvaus = :kuvaus)');
        $query->execute(array('nimi' => $this->nimi, 'prioriteetti' => $this->prioriteetti, 'status' => $this->status, 'luokka_id' => $this->luokka_id, 'kayttaja_id' => $this->kayttaja_id, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
        Kint::dump($row);
    }

    // poista tehtävä
    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Tehtava WHERE id = :id');
        $query->execute(array('id' => $id));
    }

    // tarkista, että tehtävän nimi on oikeassa muodossa
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

    // tarkista, että tehtävän kuvaus ei ole liian pitkä
    public function validate_kuvaus() {
        $errors = array();
        if (strlen($this->kuvaus) > 400) {
            $errors[] = 'Kuvaus saa olla korkeintaan 400 merkkiä pitkä!';
        }
        return $errors;
    }

    // tehtävien järjestäminen prioriteetin mukaan 
    public static function all_by_priority($prioriteetti, $kayttaja_id) {
        $query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE kayttaja_id = :kayttaja_id AND prioriteetti = :prioriteetti', array('prioriteetti' => $prioriteetti, 'kayttaja_id' => $kayttaja_id));
        $rows = $query->fetchAll();
        $tehtavat = array();
        foreach ($rows as $row) {
            $tehtavat[] = new Tehtava(array(
                'id' => $row['id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'prioriteetti' => $row['prioriteetti'],
                'luokka_id' => $row['luokka_id'],
                'status' => $row['status'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return $tehtavat;
    }

}
