<?php

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

$routes->get('/luokankuvaus', function() {
    HelloWorldController::luokanKuvaus();
});
//
//$routes->get('/muokkaaluokkaa', function() {
//    HelloWorldController::muokkaaLuokkaa();
//});

$routes->get('/luokat', function() {
    LuokkaController::luokat();
});

$routes->post('/tehtava', function() {
    TehtavaController::store();
});

$routes->get('/tehtava/:id', function($id) {
    TehtavaController::show($id);
});

$routes->get('/index', function() {
    TehtavaController::index();
});

$routes->get('/new', function() {
    TehtavaController::create();
});

$routes->get('/tehtava/:id/edit', function($id) {
    TehtavaController::edit($id);
});

$routes->post('/tehtava/:id/edit', function($id) {
    TehtavaController::update($id);
});

$routes->post('/tehtava/:id/destroy', function($id) {
    TehtavaController::destroy($id);
});

$routes->post('/luokka', function() {
    LuokkaController::store();
});

$routes->get('/uusiluokka', function() {
    LuokkaController::create();
});

$routes->get('/luokka/:id', function($id) {
    LuokkaController::show($id);
});

$routes->get('/luokka/:id', function($id) {
    LuokkaController::show($id);
});

$routes->get('/luokka/:id/muokkaaluokkaa', function($id) {
    LuokkaController::edit($id);
});

$routes->post('/luokka/:id/muokkaaluokkaa', function($id) {
    LuokkaController::update($id);
});

$routes->post('/luokka/:id/destroy', function($id) {
    LuokkaController::destroy($id);
});

$routes->get('/kirjaudu', function() {
    KayttajaController::login();
});
$routes->post('/kirjaudu', function() {
    KayttajaController::handle_login();
});

$routes->post('/logout', function() {
    KayttajaController::logout();
});

$routes->get('/', function() {
    KayttajaController::login();
});

$routes->get('/rekisteroidy', function() {
    KayttajaController::rekisteroidy();
});

$routes->post('/rekisteroidy', function() {
    KayttajaController::uusiKayttaja();
});




