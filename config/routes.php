<?php

$routes->get('/', function() {
HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
HelloWorldController::sandbox();
});
$routes->get('/game', function() {
HelloWorldController::etusivu();
});
$routes->get('/game/1', function() {
HelloWorldController::muokkaa();
});

$routes->get('/login', function() {
HelloWorldController::login();
});
