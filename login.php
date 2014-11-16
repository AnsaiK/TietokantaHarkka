<?php
require_once 'libs/tietokantayhteys.php';
require_once 'libs/common.php';
require_once "libs/models/henkilo.php";

if (empty($_POST["username"]) || empty($_POST["password"])) {
    require 'views/login_view.php';
    exit();
}

$kayttajatunnus = $_POST["username"];
$salasana = $_POST["password"];

$henkilo = Henkilo::etsiHenkiloTunnuksilla($kayttajatunnus, $salasana);

if (isset($henkilo)) {
    $_SESSION['henkilo'] = $henkilo;
    $_SESSION['nimi'] = $henkilo->getNimi();
    $_SESSION['henkilo_id'] = $henkilo->getHenkilo_id();

    header('Location: etusivu.php');
    
} else {
    naytaKirjautumisPohja("login_view.php", array(
        'kayttajatunnus' => $kayttajatunnus,
        'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä!"
    ));
}