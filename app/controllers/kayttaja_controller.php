<?php

class KayttajaController extends BaseController{
  public static function login(){
      View::make('tehtava/kirjaudu.html');
  }
  
   public static function logout(){
    $_SESSION['kayttaja'] = null;
    Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }
  
  public static function handle_login(){
    $params = $_POST;
    
    $kayttaja = Kayttaja::authenticate($params['kayttajatunnus'], $params['salasana']);
    //Kint::dump($kayttaja);
    if(!$kayttaja){
      View::make('tehtava/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
    }else{
      $_SESSION['kayttaja'] = $kayttaja->id;
    //Kint::dump($kayttaja->id);
      Redirect::to('/index', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
    }
  }
}

