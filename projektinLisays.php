<?php

require_once 'libs/common.php';
require_once "libs/models/Projekti.php";
require_once "libs/tietokantayhteys.php";


$nimi = $_POST['projektinNimi'];
$kuvaus = $_POST['projektinKuvaus'];

if (empty($nimi)) {
    $_SESSION['huomautus'] = "Nimi ei saa olla tyhjä.";
    header('Location: hallinnointi_projektit.php');
    exit();
} else {
    Projekti::lisaaProjekti($nimi, $kuvaus);
    $_SESSION['kuittaus'] = "Projekti lisätty.";
    header('Location: hallinnointi_projektit.php');
}







    