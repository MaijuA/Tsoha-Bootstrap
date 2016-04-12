<?php

require 'app/models/tehtava.php';

class HelloWorldController extends BaseController {

    public static function index() {
// make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('suunnitelmat/kirjautuminen.html');
//echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
// Testaa koodiasi täällä
        $laskari = new Tehtava(array(
            'name' => 'd'           
        ));
        $errors = $laskari->errors();

        Kint::dump($errors);
    }

    public static function muistilista() {
        View::make('suunnitelmat/muistilista.html');
    }

    public static function muokkaa() {
        View::make('suunnitelmat/muokkaa.html');
    }

    public static function kirjaudu() {
        View::make('suunnitelmat/kirjautuminen.html');
    }

    public static function kuvaus() {
        View::make('suunnitelmat/kuvaus.html');
    }

    public static function rekisteroidy() {
        View::make('suunnitelmat/rekisteroidy.html');
    }

    public static function luokanKuvaus() {
        View::make('suunnitelmat/luokankuvaus.html');
    }

    public static function muokkaaLuokkaa() {
        View::make('suunnitelmat/muokkaaluokkaa.html');
    }

    public static function luokat() {
        View::make('suunnitelmat/luokat.html');
    }

}
