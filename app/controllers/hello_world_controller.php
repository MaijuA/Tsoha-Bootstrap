<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    
    public static function muistilista(){
    View::make('suunnitelmat/muistilista.html');
  }

  public static function muokkaa(){
    View::make('suunnitelmat/muokkaa.html');
  }

  public static function kirjaudu(){
    View::make('suunnitelmat/kirjautuminen.html');
  }
  public static function kuvaus(){
    View::make('suunnitelmat/kuvaus.html');
  }
  
  }
