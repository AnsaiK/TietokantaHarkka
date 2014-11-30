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
//
//$lisaa_syote = $_POST['lisaa'];

$henkilonSyoteet = Tyosyote::etsiProjektinTyosyotteetHenkilolle($projekti_id, $henkilo_id);

if (empty($tehtava) && empty($paiva) && empty($kesto) && empty($lisatieto)) {
    naytaNakyma("views/projekti_view.php", array(
        'henkilonSyote' => $henkilonSyoteet,
        'uusiSyote' => new Tyosyote(),
        'projektiId' => $projekti_id
    ));
    exit();
}





//$uusiSyote = new Tyosyote();
//$uusiSyote->setKuvaus;
//$kuvaus = $_POST['tehtava'];
//$lisatiedot = $_POST['lisatiedot'];
//$paiva = trim($_POST['paiva']);
//$paiva = strtotime($paiva);
//if (checkdate($paiva)) {
//      $_SESSION['huomautus'] = date("d-m-y", $paiva);
//$_SESSION['huomautus'] = $paiva;
//naytaNakyma("views/projekti_view.php");
//$uusiSyote->setPaiva(date('Y-m-d', strtotime($_POST['paiva'])));
//$uusiSyote->setKesto($_POST['kesto']);
//$uusiSyote->setLisatiedot($_POST['lisatiedot']);
//$uusiSyote->setHenkilo_id($henkilo_id);
//$uusiSyote->setProjekti_id($projekti_id);
//if ($uusiSyote->onkoKelvollinen()) {
//    $uusiSyote->lisaaSyoteKantaan();
//
//      $_SESSION['ilmoitus'] = "Tiedot lisätty onnistuneesti.";
//} else {
//    $virheet = $uusiSyote->getVirheet();
//    naytaNakyma("views/projekti_view.php", array(
//        'henkilonSyote' => $henkilonSyoteet,
//        'uusiSyote' => new Tyosyote()
//        'virheet' => $virheet
//    ));
//}
//$tarkasta_kuvaus = filter_var($_POST['kuvaus'], FILTER_SANITIZE_STRING);
//$tarkasta_kesto = filter_var($_POST['kesto'], FILTER_VALIDATE_FLOAT);
//
//$virheet = Tyosyote::onkoKelvollinen($tarkasta_kuvaus, $tarkasta_kesto);
//
//if (!empty($virheet)) {
//naytaNakyma("views/projekti_view.php", array(
//'henkilonSyote' => $henkilonSyote,
// "virhe" => $virheet
//));
//}
//naytaNakyma("views/projekti_view.php", array(
//    'henkilonSyote' => $henkilonSyote,
//    'uusiSyote' => $uusiSyote
//));


    