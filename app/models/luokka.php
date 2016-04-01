<?php

class Luokka extends BaseModel {

    public $id, $käyttäjä_id, $nimi, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Luokka');

        $query->execute();

        $rows = $query->fetchAll();
        $luokat = array();


        foreach ($rows as $row) {

            $luokat[] = new Luokka(array(
                'id' => $row['id'],
                'käyttäjä_id' => $row['käyttäjä_id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
                
                
            ));
        }

        return $luokat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $luokka = new Luokka(array(
                'id' => $row['id'],
                'käyttäjä_id' => $row['käyttäjä_id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));

            return $luokat;
        }

        return null;
    }

}

