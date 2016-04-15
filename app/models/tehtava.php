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
        $this->validators = array('validate_nimi');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Tehtava');

        $query->execute();

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
    
    public static function allByKayttaja($kayttaja_id) {

        $query = DB::connection()->prepare('SELECT * FROM Tehtava WHERE kayttaja_id = :kayttaja_id');

        $query->execute( array('kayttaja_id' => $kayttaja_id));

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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tehtava (nimi, prioriteetti, status, luokka_id, kuvaus) VALUES (:nimi, :prioriteetti, :status, :luokka_id, :kuvaus) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'prioriteetti' => $this->prioriteetti, 'status' => $this->status, 'luokka_id' => $this->luokka_id, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
    }

    public function update($id, $attributes) {
        $query = DB::connection()->prepare('UPDATE Tehtava');
        $query->execute(array(nimi, luokka, status, prioriteetti, kuvaus));
        $row = $query->fetch();

        Kint::dump($row);
//        DB::query('UPDATE Tehtava SET (nimi, luokka, status, prioriteetti, kuvaus)
//            = (:nimi, :luokka, :status, :prioriteetti, :kuvaus)
//            WHERE id = :id', array('id' => $id, 'nimi' => $attributes['nimi'],
//            'luokka' => $attributes['luokka'], 'status' => $attributes['status'],
//            'prioriteetti' => $attributes['prioriteetti'], 'kuvaus' => $attributes['kuvaus']));
    }

    public function destroy($id) {
        self::disconnect_categories($id);
        DB::query('DELETE FROM Tehtava WHERE id = :id', array('id' => $id));
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->nimi) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
        }

        return $errors;
    }

}
