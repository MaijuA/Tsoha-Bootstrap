<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tehtävä extends BaseModel {

    public $id, $käyttäjä_id, $nimi, $prioriteetti, $luokka, $status, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    
    
    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Tehtävä');

        $query->execute();

        $rows = $query->fetchAll();
        $tehtävät = array();


        foreach ($rows as $row) {

            $tehtävät[] = new Tehtävä(array(
                'id' => $row['id'],
                'käyttäjä_id' => $row['käyttäjä_id'],
                'nimi' => $row['nimi'],
                'prioriteetti' => $row['prioriteetti'],
                'luokka' => $row['luokka'], 
                'status' => $row['status'],
                'kuvaus' => $row['kuvaus']
            ));
        }

        return $tehtävät;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tehtävä WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $tehtävä = new Tehtävä(array(
                'id' => $row['id'],
                'käyttäjä_id' => $row['käyttäjä_id'],                
                'nimi' => $row['nimi'],
                'prioriteetti' => $row['prioriteetti'],
                'luokka' => $row['luokka'],
                'status' => $row['status'],
                'kuvaus' => $row['kuvaus']
            ));

            return $tehtävä;
        }

        return null;
    }
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tehtävä (nimi, prioriteetti, status, luokka, kuvaus) VALUES (:nimi, :prioriteetti, :status, :luokka, :kuvaus) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'prioriteetti' => $this->prioriteetti, 'status' => $this ->status, 'luokka' => $this->luokka, 'kuvaus' => $this->kuvaus));        
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
         $this->id = $row['id'];
    }

}
