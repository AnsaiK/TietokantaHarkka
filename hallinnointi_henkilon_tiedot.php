<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Henkilo.php";
require_once "libs/models/Projekti.php";
require_once "libs/models/Tyosyote.php";

$henkilo_id = (int) $_GET['id'];
$jarjestys = $_GET['sort'];
$filtteroiProjekti_id = $_GET['filter'];


$henkilo = Henkilo::etsiHenkiloIDlla($henkilo_id);
$projektit = Projekti::etsiHenkilonProjektit($henkilo_id);

$projektiLkm = Projekti::etsiHenkilonProjektiLKm($henkilo_id);
$tunnitJaMerkinnat = Tyosyote::etsiHenkilonTunnitjaMerkintojenLkm($henkilo_id);
$projektienYhteenveto = Henkilo::etsiHenkilonProjektienYhteenVeto($henkilo_id);
    
$projektinNimi = 'Kaikki projektit';
$filtteroityProjekti;

if (empty($filtteroiProjekti_id)) {
    $tyosyotteet = Tyosyote::etsiHenkilonTyosyotteet($henkilo_id, $jarjestys);
} else {
    $projektinNimi = Projekti::etsiProjektinNimi($filtteroiProjekti_id);
    $tyosyotteet = Tyosyote::etsiProjektinTyosyotteetHenkilolle($filtteroiProjekti_id, $henkilo_id, $jarjestys);
    $filtteroityProjekti = $filtteroiProjekti_id;
}

naytaNakyma('hallinnointi_henkilonTiedot_view.php', array(
    'henkilo' => $henkilo,
    'henkilonProjektit' => $projektit,
    'henkilonTyosyotteet' => $tyosyotteet,
    'projektiLkm' => $projektiLkm,
    'tunnitJaMerkinnat' => $tunnitJaMerkinnat,
    'projektienYhteenveto' => $projektienYhteenveto,
    'filtteriProjekti' => $filtteroityProjekti,
    'projektinNimi' => $projektinNimi
));
