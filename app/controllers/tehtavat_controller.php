<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TehtavaController extends BaseController {

    public static function index() {

        $tehtavat = Tehtava::all();

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
         Kint::dump($params);
        $tehtava = new Tehtava(array(
            'nimi' => $params['nimi'],
            'prioriteetti' => $params['prioriteetti'],
            'status' => $params['status'],
            'luokka_id' => $params['luokka_id'],
            'kuvaus' => $params['kuvaus']
        ));
        $tehtava->save();
        Redirect::to('/tehtava/' . $tehtava->id, array('message' => 'Tehtävä on lisätty listaasi!'));
    }

    

}
