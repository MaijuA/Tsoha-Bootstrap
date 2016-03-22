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

$routes->get('/tehtävä', function() {
HelloWorldController::tehtävä();
});
