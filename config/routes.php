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

$routes->get('/luokankuvaus', function(){
  HelloWorldController::luokanKuvaus();
});

$routes->get('/muokkaaluokkaa', function(){
  HelloWorldController::muokkaaLuokkaa();
});

$routes->get('/luokat', function(){
  HelloWorldController::luokat();
});

$routes->post('/', function(){
  TehtäväController::store();
});

$routes->get('/index', function(){
  TehtäväController::index();
});

$routes->get('/new', function(){
  TehtäväController::store();
});




