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
        $tehtavat = Tehtava::allSortedByPriority($kayttaja_id);
        $tehtavatLuokkineen = array();
        foreach ($tehtavat as $tehtava) {
            $luokat = TehtavaLuokka::findByTehtavaId($tehtava->id);
            $tehtavatLuokkineen[] = array('tehtava' => $tehtava, 'luokat' => $luokat);
        }
        View::make('tehtava/index.html', array('tehtavatJaLuokat' => $tehtavatLuokkineen));
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
        $kayttaja_id = $_SESSION['kayttaja'];
        $attributes = array(
            'nimi' => $params['nimi'],
            'status' => $params['status'],
            'kayttaja_id' => $kayttaja_id,
            'luokat' => array(),
            'kuvaus' => $params['kuvaus'],
            'prioriteetti' => $params['prioriteetti']
        );
        if (isset($params['luokat'])) {
            $luokat = $params['luokat'];
            $kaikkiluokat = array();
            foreach ($luokat as $id) {
                $kaikkiluokat[] = new Luokka(array(
                    'id' => $id
                ));
            }

            $attributes['luokat'] = $kaikkiluokat;
        } else {
            $kaikkiluokat[] = null;
        }

        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();
        if (count($errors) == 0) {
            $tehtava->save();
            if (isset($params['luokat'])) {
                TehtavaLuokka::createConnections($tehtava->id, $luokat);
            }
            Redirect::to('/tehtava/' . $tehtava->id, array('message' => 'Tehtävä on lisätty listaasi!'));
        } else {
            $luokat = Luokka::all($kayttaja_id);
            View::make('tehtava/new.html', array('luokat' => $luokat, 'errors' => $errors, 'attributes' => $attributes));
        }
    }

    // näytä tehtävä
    public static function show($id) {
        self::check_logged_in();
        $tehtava = Tehtava::find($id);
        $luokka = Luokka::find($tehtava->luokka_id);
        $luokat = TehtavaLuokka::findByTehtavaId($tehtava->id);
        $tehtavatLuokkineen[] = array('tehtava' => $tehtava, 'luokat' => $luokat);
        View::make('tehtava/tehtava.html', array('tehtava' => $tehtava, 'luokka' => $luokka, 'tehtavatJaLuokat' => $tehtavatLuokkineen));
    }

    // tehtävän muokkaussivu
    public static function edit($id) {
        self::check_logged_in();
        $tehtava = Tehtava::find($id);
        $kayttaja_id = $_SESSION['kayttaja'];
        $luokat = Luokka::all($kayttaja_id);       
        $tehtavanluokat = TehtavaLuokka::findByTehtavaId($tehtava->id);       
        View::make('tehtava/edit.html', array('tehtava' => $tehtava, 'luokat' => $luokat, 'tehtavanluokat' => $tehtavanluokat));
    }

    // muokkaa tehtävää
    public static function update($id) {
        $params = $_POST;
        $kayttaja_id = $_SESSION['kayttaja'];
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'status' => $params['status'],
            'luokat' => array(),
            'kayttaja_id' => $kayttaja_id,
            'kuvaus' => $params['kuvaus'],
            'prioriteetti' => $params['prioriteetti']
        );
        if (isset($params['luokat'])) {
            $luokat = $params['luokat'];
            $tehtavanluokat = array();
            foreach ($luokat as $id) {
                $tehtavanluokat[] = new Luokka(array(
                    'id' => $id
                ));
            }
            $attributes['luokat'] = $tehtavanluokat;
        } else {
            $tehtavanluokat[] = null;
        }
        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();
        if (count($errors) > 0) {
            View::make('tehtava/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            
            $tehtava->update($id); 
            if (isset($params['luokat'])) {
                TehtavaLuokka::createConnections($tehtava->id, $luokat);
            }
            Redirect::to('/tehtava/' . $tehtava->id, array('message' => 'Tehtävää on muokattu onnistuneesti!'));
        }
    }

    // poista tehtävä
    public static function destroy($id) {
        $tehtava = new Tehtava(array('id' => $id));
        $tehtava->destroy($id);
        Redirect::to('/index', array('message' => 'Tehtävä on poistettu onnistuneesti!'));
    }

}
