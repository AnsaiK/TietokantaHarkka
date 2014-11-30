<?php
require_once 'libs/tietokantayhteys.php';
require_once 'libs/common.php';
require_once "libs/models/Henkilo.php";

if (empty($_POST["username"]) && empty($_POST["password"])) {
    require 'views/login_view.php';
    exit();
}

$kayttajatunnus = $_POST["username"];
$salasana = $_POST["password"];

$henkilo = Henkilo::etsiHenkiloTunnuksilla($kayttajatunnus, $salasana);

//tarkistetaan onko kirjautumistiedoilla oleva henkilö olemassa 
if (isset($henkilo)) {
    $_SESSION['vastuuhenkilo'] = Henkilo::onkoVastuuhenkilo($henkilo->getHenkilo_id());
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