<?php

$routes->get('/', function() {
HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
HelloWorldController::sandbox();
});
$routes->get('/muistilista', function() {
HelloWorldController::muistilista();
});
$routes->get('/muokkaa', function() {
HelloWorldController::muokkaa();
});

$routes->get('/kirjautuminen', function() {
HelloWorldController::kirjaudu();
});
$routes->get('/kuvaus/', function() {
HelloWorldController::kuvaus();
});

$routes->get('/kuvaus/:id', function() {
HelloWorldController::kuvaus();
});

$routes->get('/rekisteroidy', function(){
  HelloWorldController::rekisteroidy();
});

$routes->get('/lisaatehtava', function(){
  HelloWorldController::lisaaTehtava();
});

$routes->get('/luokankuvaus', function(){
  HelloWorldController::luokanKuvaus();
});

$routes->get('/muokkaaluokkaa', function(){
  HelloWorldController::muokkaaLuokkaa();
});

$routes->get('/lisaaluokka', function(){
  HelloWorldController::lisaaLuokka();
});

$routes->get('/tehtävä', function(){
  TehtäväController::index();
});

$routes->post('/suunnitelmat', function(){
  TehtäväController::store();
});

$routes->get('/suunnitelmat/new', function(){
  TehtäväController::create();
});




