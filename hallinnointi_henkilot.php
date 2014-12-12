<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Henkilo.php";
require_once "libs/models/Projekti.php";


$henkilot = Henkilo::etsiKaikkiHenkilot();
$listaus = Henkilo::henkiloListaus();

naytaNakyma('hallinnointi_henkilot_view.php', array(
    'henkilo' => $henkilot,
    'listaus' => $listaus
));
