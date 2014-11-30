<?php

require_once 'libs/tietokantayhteys.php';
require_once 'libs/common.php';
require_once "libs/models/Henkilo.php";


if (empty($_POST["username"]) && empty($_POST["password"]) && empty($_POST['name'])) {
    require 'views/rekisterointi_view.php';
    exit();
}

$kayttajatunnus = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$salasana = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
$nimi = filter_var($_POST["name"], FILTER_SANITIZE_STRING);

$virheet = Henkilo::uusiHenkilo($nimi, $kayttajatunnus, $salasana);

if (empty($virheet)) {
    naytaKirjautumisPohja("login_view.php", array(
        'kayttajatunnus' => $kayttajatunnus,
        'kuittaus' => "Rekisteröityminen onnistui ".$nimi. "! Voit kirjautua  tunnuksillasi sisään!"     
    ));
} else {
      naytaKirjautumisPohja("rekisterointi_view.php", array(
        'virhe' => $virheet     
    ));
}



    