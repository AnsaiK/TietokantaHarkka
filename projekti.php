<?php

require_once 'libs/common.php';
require_once 'libs/models/Tyosyote.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Projekti.php";

$projekti_id = (int) $_GET['id'];
$henkilo_id = $_SESSION['henkilo_id'];

$tehtava = $_POST['tehtava'];
$paiva = $_POST['paiva'];
$kesto = $_POST['kesto'];
$lisatieto = $_POST['lisatiedot'];

$getTehtava = $_GET['tehtava'];
$getLisatiedot = $_GET['lisatiedot'];
$getPaiva = $_GET['paiva'];
$getKesto = $_GET['kesto'];

$getSyote_id = $_GET['syote_id'];

$henkilonSyoteet = Tyosyote::etsiProjektinTyosyotteetHenkilolle($projekti_id, $henkilo_id);


//ohjaus muokkausnäkymään
if (!empty($getSyote_id) && !isset($_SESSION['virheet'])) {
    $muokattavaSyote = Tyosyote::etsiTyosyote($getSyote_id);
    unset($_SESSION['virheet']);

    naytaNakyma("views/projekti_view.php", array(
        'muokkausTaiLisays' => 'projekti_muokkaus_view.php',
        'henkilonSyote' => $henkilonSyoteet,
        'uusiSyote' => $muokattavaSyote,
        'projektiId' => $projekti_id,
        'projektinNimi' => Projekti::etsiProjektinNimi($projekti_id)
    ));
    exit();
}
//    tietojen muokkauksen virhesyötteen tapauksessa uudelleenohjaus muokkausnäkymään
else if (!empty($getSyote_id) && isset($_SESSION['virheet'])) {
    unset($_SESSION['virheet']);

    $muokattavaSyote = Tyosyote::etsiTyosyote($getSyote_id);

    naytaNakyma("views/projekti_view.php", array(
        'muokkausTaiLisays' => 'projekti_muokkaus_view.php',
        'henkilonSyote' => $henkilonSyoteet,
        'uusiSyote' => new Tyosyote($syote_id, $getTehtava, $getLisatiedot, $getPaiva, $getKesto),
        'projektiId' => $projekti_id,
        'projektinNimi' => Projekti::etsiProjektinNimi($projekti_id)
    ));
    exit();
} else {
    naytaNakyma("views/projekti_view.php", array(
        'muokkausTaiLisays' => 'projekti_lisays_view.php',
        'henkilonSyote' => $henkilonSyoteet,
        'uusiSyote' => new Tyosyote($projekti_id, $getTehtava, $getLisatiedot, $getPaiva, $getKesto),
        'projektiId' => $projekti_id,
        'projektinNimi' => Projekti::etsiProjektinNimi($projekti_id)
    ));
    exit();
}    