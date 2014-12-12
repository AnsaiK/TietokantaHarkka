<?php

require_once 'libs/common.php';
require_once "libs/models/Projekti.php";
require_once "libs/tietokantayhteys.php";

$nimi = $_POST['lisattavanProjektinNimi'];
$kuvaus = $_POST['lisattavanProjektinKuvaus'];
$virheet = Projekti::lisaaProjekti($nimi, $kuvaus);

if (empty($virheet)) {
    $_SESSION['kuittaus'] = "Projekti lisätty.";
    header('Location: hallinnointi_projektit.php');
    exit();
    
} else {
    $_SESSION['huomautus'] = $virheet;
    header('Location: hallinnointi_projektit.php?nimi='.$nimi.'&kuvaus='.$kuvaus);
}





    