<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Kayttaja extends BaseModel {

    public $id, $nimi, $kayttajatyyppi, $kayttajatunnus, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);$this->validators = array('validate_kayttajatyyppi', 'validate_nimi', 'validate_kayttajatunnus', 'validate_salasana');
        
    }

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

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kayttajatyyppi' => $row['kayttajatyyppi'],
                'kayttajatunnus' => $row['kayttajatunnus'],
                'salasana' => $row['salasana']
            ));

            return $kayttajat;
        }

        return null;
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
