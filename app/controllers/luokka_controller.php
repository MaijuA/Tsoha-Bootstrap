<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
class LuokkaController extends BaseController {

    // luokkien listaussivu
    public static function luokat() {
        self::check_logged_in();
        $kayttaja_id=$_SESSION['kayttaja'];
        $luokat = Luokka::all($kayttaja_id);
        View::make('tehtava/luokat.html', array('luokat' => $luokat));
    }
    
    // lisää luokka
    public static function store() {
        $params = $_POST;
        Kint::dump($_SESSION['kayttaja']);
        $kayttaja_id = $_SESSION['kayttaja'];
        $attributes = array(
            'nimi' => $params['nimi'],          
            'kayttaja_id' => $kayttaja_id,           
            'kuvaus' => $params['kuvaus']            
        );
        $luokka = new Luokka($attributes);
        $errors = $luokka->errors();
        if (count($errors) == 0) {
            $luokka->save();
            Redirect::to('/luokka/' . $luokka->id, array('message' => 'Luokka on lisätty kirjastoosi!'));
        } else {
            View::make('tehtava/uusiluokka.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }
    
    // luokan lisäyssivu
    public static function create() {
        self::check_logged_in();
        View::make('tehtava/uusiluokka.html');
    }
    
    // näytä luokka
    public static function show($id) {
        self::check_logged_in();
        $luokka = Luokka::find($id);
        View::make('tehtava/luokka.html', array('luokka' => $luokka));
    }
    
    // luokan muokkaussivu
     public static function edit($id) {
        self::check_logged_in();
        $luokka = Luokka::find($id);
        View::make('tehtava/muokkaaluokkaa.html', array('luokka' => $luokka));
    }

    // muokkaa luokkaa
    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],           
            'kuvaus' => $params['kuvaus']
        );
        $luokka = new Luokka($attributes);
        $errors = $luokka->errors();
       if (count($errors) > 0) {
            View::make('tehtava/muokkaaluokkaa.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $luokka->update();
            Redirect::to('/luokka' . $luokka->id, array('message' => 'Luokkaa on muokattu onnistuneesti!'));
        }
    }

    // poista luokka
    public static function destroy($id) {
        $luokka = new Luokka(array('id' => $id));  
        $luokka->destroy($id);
        Redirect::to('/luokat', array('message' => 'Luokka on poistettu onnistuneesti!'));
    }
}
