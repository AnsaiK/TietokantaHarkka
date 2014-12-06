<?php

require_once 'libs/common.php';
require_once "libs/models/Projekti.php";
require_once "libs/tietokantayhteys.php";
require_once "libs/models/Tyosyote.php";


$projekti_id = (int) $_GET['id'];
$jarjestys = $_GET['sort'];

$projektiLkm = Projekti::etsiProjektienLkm();
$projektitJaLkm = Projekti::etsiKaikkiProjektitJaHloLkm();

//Kun projektin linkki valitaan, näytetään projektin tiedot
if (!empty($projekti_id)) {
    $projektinSyotteet = Tyosyote::etsiProjektinTyosyotteet($projekti_id, $jarjestys);
    $projektinNimi = Projekti::etsiProjektinNimi($projekti_id);
    $projektinTunnit = Tyosyote::etsiProjektinTuntimaara($projekti_id);
    $projektinSyoteMaara = Tyosyote::etsiProjektinSyoteMaara($projekti_id);
    $projektinHloLkm = Projekti::etsiProjektinHenkilomaara($projekti_id);
    $projektinKuvaustenLkm = Tyosyote::etsiProjektinSyoteenKuvaustenLkm($projekti_id);
    $projektinHloYhteenveto = Projekti::etsiProjektinHloYhteenVeto($projekti_id);

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
        'projekti_id' => $projekti_id
    ));
    exit();
}

naytaNakyma("hallinnointi_projektit_view.php", array(
    'projektiLkm' => $projektiLkm,
    'projektitJaLkm' => $projektitJaLkm
));
