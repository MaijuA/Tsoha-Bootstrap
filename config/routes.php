<?php

$routes->get('/', function() {
KayttajaController::login();
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

$routes->get('/luokankuvaus', function(){
  HelloWorldController::luokanKuvaus();
});

$routes->get('/muokkaaluokkaa', function(){
  HelloWorldController::muokkaaLuokkaa();
});

$routes->get('/luokat', function(){
  HelloWorldController::luokat();
});

$routes->post('/tehtava', function(){
  TehtavaController::store();
});

$routes->get('/index', function(){
  TehtavaController::index();
});

$routes->get('/new', function(){
  TehtavaController::create();
});

$routes->get('/uusiluokka', function(){
  LuokkaController::lisaaLuokka();
});

$routes->get('/tehtava/:id', function($id){
  TehtavaController::show($id);
});

$routes->get('/tehtava/:id/edit', function($id){
  TehtavaController::edit($id);
});

$routes->post('/tehtava/:id/edit', function($id){
  TehtavaController::update($id);
});

$routes->post('/tehtava/:id/destroy', function($id){
  TehtavaController::destroy($id);
});

$routes->get('/kirjaudu', function(){
  KayttajaController::login();
});
$routes->post('/kirjaudu', function(){
  KayttajaController::handle_login();
});




