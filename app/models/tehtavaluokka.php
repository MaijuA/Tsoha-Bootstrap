<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TehtavaLuokka extends BaseModel {

    public $id, $luokka_id, $tehtava_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function findByTehtavaId($id) {
        $query = DB::connection()->prepare('SELECT * FROM Luokka JOIN TehtavaLuokka '
                . 'ON luokka.id = tehtavaluokka.luokka_id '
                . 'WHERE tehtava_id = :id');
        $query->execute(array('id' => $id));
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

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO TehtavaLuokka (tehtava_id, luokka_id)'
                . ' VALUES (:tehtava_id, :luokka_id)');
        $query->execute(array('tehtava_id' => $this->tehtava_id, 'luokka_id' => $this->luokka_id));
        $row = $query->fetch();
    }

    public static function createConnections($tehtava_id, $luokat) {
        if ($luokat == null)
            return;
        foreach ($luokat as $luokka) {
            $tehtavaluokka = new TehtavaLuokka(array(
                'luokka_id' => $luokka,
                'tehtava_id' => $tehtava_id
            ));
            $tehtavaluokka->save();
        }
    }
}
