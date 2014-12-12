<?php

require_once 'libs/common.php';
require_once 'libs/models/Tyosyote.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Projekti.php";

$syote_id = (int) $_GET['syote_id'];
$henkilo_id = $_SESSION['henkilo_id'];
$poistettava_id = $_POST['poista'];
$muokattava_id = $_POST['muokkaa'];
$vahvistettava_id = $_POST['vahvista'];
$projekti_id = $_POST['projektiId'];


// Projektin muokkausnäkymään ohjaus
if (!empty($muokattava_id)) {
    header('Location: projekti.php?id=' . $projekti_id . '&syote_id=' . $muokattava_id);
    exit();
}
// Projektin poisto
if (!empty($poistettava_id)) {
    Tyosyote::poistaSyote($poistettava_id);
    $_SESSION['kuittaus'] = 'Tiedot poistettu';
    header('Location: projekti.php?id=' . $projekti_id);
    exit();
}

// Tyosyotteen muokkaus
// Lomakkeen tiedot muokkauksessa
$muokattavaTehtava = $_POST['tehtava'];
$muokattavaPaiva = $_POST['paiva'];
$muokattavaKesto = $_POST['kesto'];
$muokattavaLisatieto = $_POST['lisatiedot'];

// Muokkauslomakkeen käsittely
if (!empty($vahvistettava_id)) {
    $virheet = Tyosyote::muokkaaSyotetta($muokattavaTehtava, $muokattavaLisatieto, $muokattavaPaiva, $muokattavaKesto, $vahvistettava_id);

    if (empty($virheet)) {
        $_SESSION['kuittaus'] = 'Muutokset tallennettu';
        header('Location: projekti.php?id=' . $projekti_id);
        exit();
    } else {
        $_SESSION['huomautus'] = $virheet;
        $_SESSION['virheet'] = 'virhe';
        header('Location: projekti.php?id=' . $projekti_id . '&syote_id=' . $vahvistettava_id . '&tehtava=' . $muokattavaTehtava . '&paiva=' . $muokattavaPaiva . '&kesto=' . $muokattavaKesto . '&lisatiedot=' . $muokattavaLisatieto);


        exit();
    }
}