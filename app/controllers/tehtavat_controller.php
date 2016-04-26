<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
class TehtavaController extends BaseController {

    // tehtävien listaussivu
    public static function index() {
        self::check_logged_in();
        $kayttaja_id = $_SESSION['kayttaja'];
        $tehtavat = Tehtava::all($kayttaja_id);
        $ylin_tehtavat = Tehtava::all_by_priority("Korkea", $kayttaja_id);
        $tehtavat[] = $ylin_tehtavat;
        $keski_tehtavat = Tehtava::all_by_priority("Keski", $kayttaja_id);
        $tehtavat[] = $keski_tehtavat;
        $alin_tehtavat = Tehtava::all_by_priority("Matala", $kayttaja_id);
        $tehtavat[] = $alin_tehtavat;
//        if(!tehtavat['Korkea'] && !$tehtavat['Keski'] && !$tehtavat['Matala']){
//            $empty = true;
//        }else{
//            $empty = false;
//        }
        
        View::make('tehtava/index.html', array('tehtavat' => $tehtavat));
    }
    
    // tehtävän lisäyssivu
    public static function create() {
        self::check_logged_in();
        $kayttaja_id = $_SESSION['kayttaja'];
        $luokat = Luokka::all($kayttaja_id);
        View::make('tehtava/new.html', array('luokat' => $luokat));
    }

    // lisää tehtävä
    public static function store() {
        $params = $_POST;
        Kint::dump($_SESSION['kayttaja']);
        $kayttaja_id = $_SESSION['kayttaja'];
        $luokat = $params['luokat'];        
        $attributes = array(
            'nimi' => $params['nimi'],
            'status' => $params['status'],
            'kayttaja_id' => $kayttaja_id,
            'luokat' => array(),
            'kuvaus' => $params['kuvaus'],
            'prioriteetti' => $params['prioriteetti']
        );        
//        if(isset($params['luokat'])) {
//        foreach ($luokat as $luokka) {
//     
//            $attributes['luokat'][] = $luokka;
//        }
////        
//        if(isset($params['luokka'])){
//            $selected_luokat = $params['luokka'];
//        }else{
//            $selected_luokat = null;
//        }
//        }        
        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();
        if (count($errors) == 0) {
            $tehtava->save();
            Redirect::to('/tehtava/' . $tehtava->id, array('message' => 'Tehtävä on lisätty kirjastoosi!'));
        } else {
            View::make('tehtava/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    // tehtävän muokkaussivu
    public static function edit($id) {
        self::check_logged_in();
        $tehtava = Tehtava::find($id);
        View::make('tehtava/edit.html', array('tehtava' => $tehtava));
    }
    
    // näytä tehtävä
    public static function show($id) {
        self::check_logged_in();
        $tehtava = Tehtava::find($id);
        $luokka = Luokka::find($tehtava->luokka_id);
        View::make('tehtava/tehtava.html', array('tehtava' => $tehtava, 'luokka' => $luokka));
    }

    // muokkaa tehtävää
    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'status' => $params['status'],
            'luokka_id' => $luokka_id,
            'kayttaja_id' => $kayttaja_id,
            'kuvaus' => $params['kuvaus'],
            'prioriteetti' => $params['prioriteetti']
        );
        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();
        if (count($errors) > 0) {
            View::make('tehtava/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tehtava->update();
            Redirect::to('/tehtava' . $tehtava->id, array('message' => 'Tehtävää on muokattu onnistuneesti!'));
        }
    }

    // poista tehtävä
    public static function destroy($id) {
        $tehtava = new Tehtava(array('id' => $id));
        $tehtava->destroy($id);
        Redirect::to('/index', array('message' => 'Tehtävä on poistettu onnistuneesti!'));
    }    
}
