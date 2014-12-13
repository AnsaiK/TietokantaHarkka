<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Henkilo.php";
require_once "libs/models/Projekti.php";
require_once "libs/models/Tyosyote.php";

$henkilo_id = (int) $_GET['id'];
$jarjestys = $_GET['sort'];

$henkilo = Henkilo::etsiHenkiloIDlla($henkilo_id);
$projektit = Projekti::etsiHenkilonProjektit($henkilo_id);
$tyosyotteet = Tyosyote::etsiHenkilonTyosyotteet($henkilo_id, $jarjestys);

$projektiLkm = Projekti::etsiHenkilonProjektiLKm($henkilo_id);
$vikaMerkinta = Tyosyote::etsiHenkilonVikaSyotePvm($henkilo_id);
$tunnitJaMerkinnat = Tyosyote::etsiHenkilonTunnitjaMerkintojenLkm($henkilo_id);
$projektienYhteenveto = Henkilo::etsiHenkilonProjektienYhteenVeto($henkilo_id);

naytaNakyma('hallinnointi_henkilonTiedot_view.php', array(
    'henkilo' => $henkilo,
    'henkilonProjektit' => $projektit,
    'henkilonTyosyotteet' => $tyosyotteet,
    'vikaMerkinta' => $vikaMerkinta,
    'projektiLkm' => $projektiLkm,
    'tunnitJaMerkinnat' => $tunnitJaMerkinnat,
    'projektienYhteenveto' => $projektienYhteenveto
));
