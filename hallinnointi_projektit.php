<?php

require_once 'libs/common.php';
require_once "libs/models/Projekti.php";
require_once "libs/tietokantayhteys.php";

$uusiProjekti = new Projekti($_POST['nimi'], $_POST['kuvaus']);

$projektiLkm = Projekti::etsiProjektienLkm();
$kaikkiprojektit = Projekti::etsiKaikkiProjektit();
$projektitJaLkm = Projekti::etsiKaikkiProjektitJaHloLkm();


naytaNakyma("hallinnointi_projektit_view.php", array(
    'kaikkiprojektit' => $kaikkiprojektit,
    'projektiLkm' => $projektiLkm,
    'uusiProjekti' => $uusiProjekti,
    'projektitJaLkm' => $projektitJaLkm
));
