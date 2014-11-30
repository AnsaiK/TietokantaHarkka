<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Projekti.php";

$poistettava = $_POST['poista'];
$muokattava = $_POST['muokkaa'];
$muokattavaNimi = $_POST['muokattavaNimi'];
$muokattavaKuvaus = $_POST['muokattavaKuvaus'];

$vahvistamuokkaus_id = $_POST['vahvista'];

//projektin poisto
if (!empty($poistettava)) {
    Projekti::poistaProjekti($poistettava);
    header('Location: hallinnointi_projektit.php');
    exit();
}

//ohjaa muokkausnäkymään
if (!empty($muokattava)) {

    $projektiLkm = Projekti::etsiProjektienLkm();
$projektitJaLkm = Projekti::etsiKaikkiProjektitJaHloLkm();
    $muokattavaProjekti = Projekti::etsiProjekti($muokattava);

    naytaNakyma("hallinnointi_projektit_muokkaus_view.php", array(
        'projektitJaLkm' => $projektitJaLkm,
        'projektiLkm' => $projektiLkm,
        'muokattavaProjekti' => $muokattavaProjekti
    ));
    exit();
}

//vahvistaa muokkauksen
if (!empty($vahvistamuokkaus_id)) {
    Projekti::muokkaaProjektia($muokattavaNimi, $muokattavaKuvaus, $vahvistamuokkaus_id);
    $_SESSION['kuittaus'] = 'Muutokset tallennettu';
    header('Location: hallinnointi_projektit.php');
}


