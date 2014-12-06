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

$henkilonSyoteet = Tyosyote::etsiProjektinTyosyotteetHenkilolle($projekti_id, $henkilo_id);

if (empty($tehtava) && empty($paiva) && empty($kesto) && empty($lisatieto)) {
    naytaNakyma("views/projekti_view.php", array(
        'henkilonSyote' => $henkilonSyoteet,
        'uusiSyote' => new Tyosyote(),
        'projektiId' => $projekti_id,
        'projektinNimi' => Projekti::etsiProjektinNimi($projekti_id)
    ));
    exit();
}

