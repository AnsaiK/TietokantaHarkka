<?php

require_once 'libs/common.php';
require_once "libs/models/Projekti.php";
require_once "libs/tietokantayhteys.php";

$liity_id = $_POST["liity"];
$poistu_id = $_POST["poistu"];

if (!empty($liity_id)) {
    Projekti::liitaHloProjektiin($_SESSION['henkilo_id'], $liity_id);
    $_SESSION['kuittaus'] = 'Olet liitetty projektiin';
    header('Location: etusivu.php');
    exit();
}

if (!empty($poistu_id)) {
    Projekti::poistaHloProjektista($_SESSION['henkilo_id'], $poistu_id);
    $_SESSION['kuittaus'] = 'Olet poistunut projektista';
    header('Location: etusivu.php');
    exit();
}

$projektiLkm = Projekti::etsiProjektienLkm();
$kaikkiprojektit = Projekti::etsiKaikkiProjektit();
$omatprojektit = Projekti::etsiHenkilonProjektit($_SESSION['henkilo_id']);
$projektit_ei_liitytty = Projekti::etsiProjektitJoihinHloEiKuulu($_SESSION['henkilo_id']);


naytaNakyma("etusivu_view.php", array(
    'kaikkiprojektit' => $kaikkiprojektit,
    'omatprojektit' => $omatprojektit,
    'projektiLkm' => $projektiLkm,
    'projektit_ei_liitytty' => $projektit_ei_liitytty));
