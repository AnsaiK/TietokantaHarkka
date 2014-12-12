<?php
session_start();

function naytaNakyma($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/pohja.php';
    exit();
}

function naytaKirjautumisPohja($sivu, $data = array()) {
    $data = (object) $data;
    require 'views/kirjautumisPohja.php';
    exit();
}

function onkoKirjautunut() {
    return isset($_SESSION['henkilo']);
}
