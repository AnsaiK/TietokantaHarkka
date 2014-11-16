<?php

require_once 'libs/common.php';
require_once "libs/models/Projekti.php";
require_once "libs/tietokantayhteys.php";

$projektiLkm = Projekti::etsiProjektienLkm();
$kaikkiprojektit = Projekti::etsiKaikkiProjektit();
$omatprojektit = Projekti::etsiHenkilonProjektit($_SESSION['henkilo_id']);

naytaNakyma("etusivu_view.php", array(
    'kaikkiprojektit' => $kaikkiprojektit,
    'omatprojektit' => $omatprojektit,
    'projektiLkm' => $projektiLkm));
