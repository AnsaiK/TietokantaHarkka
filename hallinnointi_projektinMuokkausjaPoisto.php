<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Projekti.php";

$poistettava_id = $_POST['poista'];
$muokattava_id = $_POST['muokkaa'];
$muokattavaNimi = $_POST['muokattavanProjektinNimi'];
$muokattavaKuvaus = $_POST['muokattavanProjektinKuvaus'];
$vahvistettava_id = $_POST['vahvista'];

$vahvistamuokkaus_id = $_GET['muokkausid'];

$projektiLkm = Projekti::etsiProjektienLkm();
$projektitJaLkm = Projekti::etsiKaikkiProjektitJaHloLkm();

//ohjaa muokkausnäkymään kun painettu muokkausnappia
if (!empty($muokattava_id)) {
    $muokattavaProjekti = Projekti::etsiProjekti($muokattava_id);
    header('Location: hallinnointi_projektit.php?muokkausid=' . $muokattava_id . '&nimi=' . $muokattavaProjekti->getNimi() . '&kuvaus=' . $muokattavaProjekti->getKuvaus());
    exit();
}

//projektin poisto kun painettu poistonappia
if (!empty($poistettava_id)) {
    $_SESSION['kuittaus'] = 'Projekti poistettu';
    Projekti::poistaProjekti($poistettava_id);
    header('Location: hallinnointi_projektit.php');
    exit();
}



//vahvistaa muokkauksen
if (!empty($vahvistettava_id)) {
    $virheet = Projekti::muokkaaProjektia($muokattavaNimi, $muokattavaKuvaus, $vahvistettava_id);

    if (empty($virheet)) {
        $_SESSION['kuittaus'] = 'Muutokset tallennettu';
        header('Location: hallinnointi_projektit.php');
        exit();
    }
    //virhetilanteen kontrollointi
    else {
        $_SESSION['huomautus'] = $virheet;
        header('Location: hallinnointi_projektit.php?muokkausid=' . $vahvistettava_id . '&nimi=' . $muokattavaNimi . '&kuvaus=' . $muokattavaKuvaus);
        exit();
    }
}




    