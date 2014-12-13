<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Henkilo.php";
require_once "libs/models/Projekti.php";
require_once "libs/models/Tyosyote.php";


$henkilot = Henkilo::etsiKaikkiHenkilot();


$poistaVastuuhenkilo = $_POST['poista'];
$lisaaVastuuhenkilo = $_POST['lisaa'];

if (!empty($poistaVastuuhenkilo)) {
    Henkilo::poistaVastuuhenkilo($poistaVastuuhenkilo);
    header('Location: hallinnointi_henkilot.php');
}

if (!empty($lisaaVastuuhenkilo)) {

    Henkilo::lisaaVastuuhenkilo($lisaaVastuuhenkilo);
    header('Location: hallinnointi_henkilot.php');
}

naytaNakyma('hallinnointi_henkilot_view.php', array(
    'henkilo' => $henkilot
));
