<?php

class KayttajaController extends BaseController {

    // kirjautumissivu
    public static function login() {
        View::make('tehtava/kirjaudu.html');
    }

    // kirjaudu ulos
    public static function logout() {
        $_SESSION['kayttaja'] = null;
        Redirect::to('/kirjaudu', array('message' => 'Olet kirjautunut ulos!'));
    }

    // kirjaudu sisään
    public static function handle_login() {
        $params = $_POST;
        $kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);
        if (!$kayttaja) {
            View::make('tehtava/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->id;
            Redirect::to('/index', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
        }
    }
}
