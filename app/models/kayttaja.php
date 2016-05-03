<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Kayttaja extends BaseModel {

    public $id, $nimi, $kayttajatyyppi, $kayttajatunnus, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_kayttajatunnus', 'validate_salasana');
    }

    // listaa käyttäjät (ei tarvetta)
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();
        $rows = $query->fetchAll();
        $kayttajat = array();
        foreach ($rows as $row) {
            $kayttajat[] = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kayttajatyyppi' => $row['kayttajatyyppi'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana']
            ));
        }
        return $kayttajat;
    }

    // etsi käyttäjä
    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana']
            ));
            return $kayttaja;
        }
        return null;
    }

    // tarkistaa onko nimi oikeassa muodossa
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
    
    // tarkistaa onko käyttäjätunnus oikeassa muodossa
    public function validate_kayttajatunnus() {
        $errors = array();
        if ($this->kayttajatunnus == '' || $this->kayttajatunnus == null) {
            $errors[] = 'Käyttäjätunnus ei saa olla tyhjä!';
        }
        if (strlen($this->kayttajatunnus) < 3) {
            $errors[] = 'Käyttäjätunnuksen tulee olla vähintään kolme merkkiä pitkä!';
        }
        if (strlen($this->kayttajatunnus) > 50) {
            $errors[] = 'Käyttäjätunnus saa olla korkeintaan 50 merkkiä pitkä!';
        }
        return $errors;
    }
    
    // tarkistaa onko salasana oikeassa muodossa
    public function validate_salasana() {
        $errors = array();
        if ($this->salasana == '' || $this->salasana == null) {
            $errors[] = 'Salasana ei saa olla tyhjä!';
        }
        if (strlen($this->salasana) < 3) {
            $errors[] = 'Salasana tulee olla vähintään kolme merkkiä pitkä!';
        }
        if (strlen($this->salasana) > 50) {
            $errors[] = 'Salasana saa olla korkeintaan 50 merkkiä pitkä!';
        }
        return $errors;
    }

    // tunnista käyttäjä
    public static function authenticate($kayttajatunnus, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus and salasana = :salasana LIMIT 1');
        $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana']
            ));
            return $kayttaja;
        }
        return null;
    }
    
    // tallenna uusi käyttäjä
    public function uusiKayttaja($nimi, $kayttajatunnus, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus');
        $query->execute(array('kayttajatunnus' => $kayttajatunnus));
        $row = $query->fetch();
        $errors = array();
        if ($row) {
            $errors[] = "Käyttäjätunnus on jo käytössä!";
        }
        if (strlen($nimi) < 5 || strlen($salasana) > 50) {
            $errors[] = "Nimen on oltava 5-50 merkkiä pitkä!";
        }
        if (strlen($kayttajatunnus) < 5 || strlen($salasana) > 50) {
            $errors[] = "Käyttäjätunnuksen on oltava 5-50 merkkiä pitkä!";
        }
        if (strlen($salasana) < 5 || strlen($salasana) > 50) {
            $errors[] = "Salasanan on oltava 5-50 merkkiä pitkä!";
        }
        if ($errors) {
            return $errors;
        } else {
            $query = DB::connection()->prepare('INSERT INTO Kayttaja (nimi, kayttajatunnus, salasana) VALUES (:nimi, :kayttajatunnus, :salasana)');
            $query->execute(array('nimi' => $nimi, 'kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
        }
    }
}

