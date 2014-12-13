<?php

require_once 'libs/common.php';
require_once "libs/models/Projekti.php";
require_once "libs/tietokantayhteys.php";
require_once "libs/models/Tyosyote.php";


$projekti_id = (int) $_GET['id'];
$jarjestys = $_GET['sort'];
$ProjektinNimi = $_GET['nimi'];
$ProjektinKuvaus = $_GET['kuvaus'];
$filtteroiHenkilo_id = $_GET['filter'];

$muokattavaProjekti_id = $_GET['muokkausid'];

$projektiLkm = Projekti::etsiProjektienLkm();
$projektitJaLkm = Projekti::etsiKaikkiProjektitJaHloJaSyoteLkm();

//Kun projektin linkki valitaan, näytetään projektin tiedot
$filtteroityHlo;
if (!empty($projekti_id)) {
    if (empty($filtteroiHenkilo_id)) {
        $projektinSyotteet = Tyosyote::etsiProjektinTyosyotteet($projekti_id, $jarjestys);
    } else {
        $projektinSyotteet = Tyosyote::etsiProjektinTyosyotteetHenkilolle($projekti_id, $filtteroiHenkilo_id);
        $filtteroityHlo = $filtteroiHenkilo_id;
    }
    $projektinNimi = Projekti::etsiProjektinNimi($projekti_id);
    $projektinTunnit = Tyosyote::etsiProjektinTuntimaara($projekti_id);
    $projektinSyoteMaara = Tyosyote::etsiProjektinSyoteMaara($projekti_id);
    $projektinHloLkm = Projekti::etsiProjektinHenkilomaara($projekti_id);
    $projektinKuvaustenLkm = Tyosyote::etsiProjektinSyoteenKuvaustenLkm($projekti_id);
    $projektinHloYhteenveto = Projekti::etsiProjektinYhteenVetoHenkiloille($projekti_id);

    naytaNakyma("hallinnointi_projektit_view.php", array(
        'projektiLkm' => $projektiLkm,
        'projektitJaLkm' => $projektitJaLkm,
        'projektinSyotteet' => $projektinSyotteet,
        'projektinNimi' => $projektinNimi,
        'projektinTunnit' => $projektinTunnit,
        'projektinSyoteLkm' => $projektinSyoteMaara,
        'projektinHloLkm' => $projektinHloLkm,
        'projektinKuvaustenLkm' => $projektinKuvaustenLkm,
        'projektinHloYhteenveto' => $projektinHloYhteenveto,
        'projekti_id' => $projekti_id,
        'listausTaiMuokkaus' => 'hallinnointi_projektit_lisays_view.php',
        'filtteriHlo' => $filtteroityHlo
    ));
    exit();
}

//muokkausnäkymän ohjaus
else if (!empty($muokattavaProjekti_id)) {
    naytaNakyma("hallinnointi_projektit_view.php", array(
        'listausTaiMuokkaus' => 'hallinnointi_projektit_muokkaus_view.php',
        'projektiLkm' => $projektiLkm,
        'projektitJaLkm' => $projektitJaLkm,
        'muokattavanProjektinNimi' => $ProjektinNimi,
        'muokattavanProjektinKuvaus' => $ProjektinKuvaus,
        'muokattavaProjektiId' => $muokattavaProjekti_id
    ));
    exit();
}

//lisäysnäkymän ohjaus
else {
    naytaNakyma("hallinnointi_projektit_view.php", array(
        'listausTaiMuokkaus' => 'hallinnointi_projektit_lisays_view.php',
        'projektiLkm' => $projektiLkm,
        'projektitJaLkm' => $projektitJaLkm,
        'lisattavanProjektinNimi' => $ProjektinNimi,
        'lisattavanProjektinKuvaus' => $ProjektinKuvaus,
        'muokattavaProjektiId' => $muokattavaProjekti_id
    ));
}


