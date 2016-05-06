<?php

// make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
class KayttajaController extends BaseController {

    // kirjautumissivu
    public static function login() {
        View::make('kayttaja/kirjaudu.html');
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
            Redirect::to('/kirjaudu', array('message' => 'Väärä käyttäjätunnus tai salasana!'));
            View::make('tehtava/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->id;
            Redirect::to('/index', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
        }
    }

    // rekisteröitymissivu
    public static function rekisteroidy() {
        View::make('kayttaja/rekisteroidy.html');
    }

    // lisää käyttäjä
    public static function uusiKayttaja() {
        $params = $_POST;
        $errors = Kayttaja::uusiKayttaja($params['nimi'], $params['kayttajatunnus'], $params['salasana']);
        if ($errors) {
            View::make('kayttaja/rekisteroidy.html', array('errors' => $errors));
        } else {
            Redirect::to('/kirjaudu', array('message' => 'Rekisteröityminen onnistui, voit nyt kirjautua sisään!'));
        }
    }

}
