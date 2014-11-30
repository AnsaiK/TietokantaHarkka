<?php

require_once 'libs/common.php';
require_once 'libs/models/Tyosyote.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Projekti.php";

$syote_id = (int) $_GET['id'];
$henkilo_id = $_SESSION['henkilo_id'];
$poistettava_id = $_POST['poista'];
$muokattava_id = $_POST['muokkaa'];
$vahvistettava_id = $_POST['vahvista'];
$projekti_id = $_POST['projektiId'];
//$lisaa_syote = $_POST['lisaa'];

$henkilonSyotteet = Tyosyote::etsiProjektinTyosyotteetHenkilolle($projekti_id, $henkilo_id);


// Projektin muokkausnäkymään ohjaus
if (!empty($muokattava_id)) {
    $muokattavaSyote = Tyosyote::etsiTyosyote($muokattava_id);

    naytaNakyma("views/projekti_muokkaus_view.php", array(
        'henkilonSyote' => $henkilonSyotteet,
        'uusiSyote' => $muokattavaSyote,
        'projektiId' => $projekti_id
    ));
    exit();
}

// Projektin poisto
if (!empty($poistettava_id)) {
    Tyosyote::poistaSyote($poistettava_id);
    $henkilonMuokatutSyotteet = Tyosyote::etsiProjektinTyosyotteetHenkilolle($projekti_id, $henkilo_id);

    $_SESSION['kuittaus'] = 'Tiedot poistettu';
    header('Location: projekti.php?id=' . $projekti_id);
    exit();
}

// Lomakkeen tiedot
$muokattavaTehtava = $_POST['tehtava'];
$muokattavaPaiva = $_POST['paiva'];
$muokattavaKesto = $_POST['kesto'];
$muokattavaLisatieto = $_POST['lisatiedot'];

// Tyosyotteen muokkaus
// Muokkauslomakkeen käsittely
if (!empty($vahvistettava_id)) {
    Tyosyote::muokkaaSyotetta($muokattavaTehtava, $muokattavaLisatieto, $muokattavaPaiva, $muokattavaKesto, $vahvistettava_id);
    $_SESSION['kuittaus'] = 'Muutokset tallennettu';
    header('Location: projekti.php?id=' . $projekti_id);
    exit();
}


