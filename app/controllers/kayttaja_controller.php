<?php

class KayttajaController extends BaseController{
  public static function login(){
      View::make('tehtava/kirjaudu.html');
  }
  public static function handle_login(){
    $params = $_POST;

    $kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);

    if(!$kayttaja){
      View::make('tehtava/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
    }else{
      $_SESSION['kayttaja'] = $kayttaja->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
    }
  }
}
