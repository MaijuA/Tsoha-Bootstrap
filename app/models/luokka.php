<?php

class Luokka extends BaseModel {

    public $id, $käyttäjä_id, $nimi, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Luokka');

        $query->execute();

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
    
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Luokka (nimi, kayttaja_id, kuvaus) VALUES (:nimi, :kayttaja_id, :kuvaus) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kayttaja_id' => $this->kayttaja_id, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
    }

    public function update($id, $attributes) {
        $query = DB::connection()->prepare('UPDATE Luokka SET (nimi = :nimi, kayttaja_id = :kayttaja_id, kuvaus = :kuvaus)');
        $query->execute(array('nimi' => $this->nimi, 'kayttaja_id' => $this->kayttaja_id, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();

        Kint::dump($row);

    }

    public function destroy($id) {
        self::disconnect_categories($id);
        DB::query('DELETE FROM Luokka WHERE id = :id', array('id' => $id));
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

