<?php
require_once 'libs/common.php';
require_once 'libs/models/Tyosyote.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Projekti.php";



$projekti_id =(int)$_GET['id'];
$henkilo_id = $_SESSION['henkilo_id'];

$henkilonSyote = Tyosyote::etsiProjektinTyosyotteetHenkilolle($projekti_id, $henkilo_id);

naytaNakyma("views/projekti_view.php", array(
  'henkilonSyote' => $henkilonSyote));