<?php

// make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
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

    // rekisteröitymissivu
    public static function create() {
        View::make('tehtava/rekisteroidy.html');
    }

    // lisää käyttäjä
    public static function rekisteroidy() {
        $params = $_POST;
//        $salasana = $params['salasana'];
//        $salasana2 = $params['salasana2'];
        $attributes = array(
            'nimi' => $params['nimi'],
            'kayttajatunnus' => $params['kayttajatunnus'],
            'salasana' => $params['salasana']
        );
        $kayttaja = new Kayttaja($attributes);
//        if ($password1 != $password2) {
//            View::make('tehtava/rekisteroidy.html', array('error' => 'Salasanat eivät täsmää keskenään!', 'kayttajatunnus' => $params['kayttajatunnus']));
//            self::render_view('tehtava/rekisteroidy.html', array('errors' => array('Salasanat eivät täsmää!'), 'kayttaja' => $kayttaja));
//        }
        $errors = $kayttaja->errors();
        if (count($errors) == 0) {
            $kayttaja->save();
            Redirect::to('/tehtava/kirjaudu' . $kayttaja->id, array('message' => 'Rekisteröityminen onnistui, voit nyt kirjautua sisään!'));
        } else {
            View::make('tehtava/rekisteroidy.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
