<?php

require_once 'libs/common.php';
require_once "libs/models/Projekti.php";
require_once "libs/tietokantayhteys.php";
require_once "libs/models/Tyosyote.php";

$uusiProjekti = new Projekti($_POST['nimi'], $_POST['kuvaus']);

$projekti_id = (int) $_GET['id'];
$projektiLkm = Projekti::etsiProjektienLkm();
$projektitJaLkm = Projekti::etsiKaikkiProjektitJaHloLkm();



if (!empty($projekti_id)) {
    $projektinSyotteet = Tyosyote::etsiProjektinTyosyotteet($projekti_id);
    $projektinNimi = Projekti::etsiProjektinNimi($projekti_id);
    $projektinTunnit = Tyosyote::etsiProjektinTuntimaara($projekti_id);
    $projektinSyoteMaara = Tyosyote::etsiProjektinSyoteMaara($projekti_id);
    $projektinHloLkm = Projekti::etsiProjektinHenkilomaara($projekti_id);
    $projektinKuvaustenLkm = Tyosyote::etsiProjektinSyoteenKuvaustenLkm($projekti_id);
    


    naytaNakyma("hallinnointi_projektit_view.php", array(
        'projektiLkm' => $projektiLkm,
        'uusiProjekti' => $uusiProjekti,
        'projektitJaLkm' => $projektitJaLkm,
        'projektinSyotteet' => $projektinSyotteet,
        'projektinNimi' => $projektinNimi,
        'projektinTunnit' => $projektinTunnit,
        'projektinSyoteLkm' => $projektinSyoteMaara,
        'projektinHloLkm' => $projektinHloLkm,
        'projektinKuvaustenLkm' => $projektinKuvaustenLkm
            
    ));
    exit();
}

naytaNakyma("hallinnointi_projektit_view.php", array(
    'projektiLkm' => $projektiLkm,
    'uusiProjekti' => $uusiProjekti,
    'projektitJaLkm' => $projektitJaLkm
));
