<?php

require_once 'libs/common.php';
require_once "libs/models/Projekti.php";
require_once "libs/tietokantayhteys.php";


$nimi = $_POST['projektinNimi'];
$kuvaus = $_POST['projektinKuvaus'];

$virheet = Projekti::lisaaProjekti($nimi, $kuvaus);

if (empty($virheet)) {
    $_SESSION['kuittaus'] = "Projekti lisätty.";
    header('Location: hallinnointi_projektit.php');
} else {
    $_SESSION['huomautus'] = $virheet;
    header('Location: hallinnointi_projektit.php');
}







    