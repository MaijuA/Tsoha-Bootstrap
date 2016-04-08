<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TehtäväController extends BaseController {

    public static function index() {

        $tehtävät = Tehtävä::all();

        View::make('tehtava/index.html', array('tehtävät' => $tehtävät));
    }

    public static function store() {
        $params = $_POST;
        $tehtävä = new Tehtävä(array(
            'nimi' => $params['nimi'],
            'prioriteetti' => $params['prioriteetti'],
            'status' => $params['status'],
            'luokka' => $params['luokka'],
            'kuvaus' => $params['kuvaus']
        ));
        $tehtävä->save();
        Redirect::to('/tehtava/' . $tehtävä->id, array('message' => 'Tehtävä on lisätty listaasi!'));
    }

    

}
