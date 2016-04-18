<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TehtavaController extends BaseController {

    public static function index() {
        $kayttaja_id=$_SESSION['kayttaja'];
        $tehtavat = Tehtava::all($kayttaja_id);

        View::make('tehtava/index.html', array('tehtavat' => $tehtavat));
    }

    public static function create() {

        View::make('tehtava/new.html');
    }

    public static function show($id) {

        $tehtava = Tehtava::find($id);
        $luokka = Luokka::find($tehtava->luokka_id);
        View::make('tehtava/tehtava.html', array('tehtava' => $tehtava, 'luokka' => $luokka));
    }
    
    

    public static function store() {
        $params = $_POST;
        Kint::dump($_SESSION['kayttaja']);
        $kayttaja_id=$_SESSION['kayttaja'];
        $attributes = array(
            'nimi' => $params['nimi'],
            'status' => $params['status'],
            'kayttaja_id' => $kayttaja_id,
            'luokka_id' => $params['luokka_id'],
            'kuvaus' => $params['kuvaus'],
            'prioriteetti' => $params['prioriteetti']
        );

        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();

        if (count($errors) == 0) {

            $tehtava->save();

            Redirect::to('/tehtava/' . $tehtava->id, array('message' => 'Tehtävä on lisätty kirjastoosi!'));
        } else {

            View::make('tehtava/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

    public static function edit($id) {
        $tehtava = Tehtava::find($id);
        View::make('tehtava/edit.html', array('attributes' => $tehtava));
    }

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
//        Kint::dump($params);

        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();

       if (count($errors) > 0) {
            View::make('tehtava/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {

            $tehtava->update();
            Redirect::to('/tehtava' . $tehtava->id, array('message' => 'Tehtävää on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {    
        $tehtava = new Tehtava(array('id' => $id));  
        $tehtava->destroy();
        Redirect::to('/tehtava', array('message' => 'Tehtävä on poistettu onnistuneesti!'));
    }
    
    public static function muokkaa() {
        View::make('suunnitelmat/muokkaa.html');
    }

    public static function kirjaudu() {
        View::make('tehtava/kirjaudu.html');
    }
    
    

}
