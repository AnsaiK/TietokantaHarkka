<?php

require_once 'libs/common.php';
require_once 'libs/models/Tyosyote.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Projekti.php";

$projekti_id = $_POST['projektiId'];
$henkilo_id = $_SESSION['henkilo_id'];

$tehtava = $_POST['tehtava'];
$paiva = $_POST['paiva'];
$kesto = $_POST['kesto'];
$lisatieto = $_POST['lisatiedot'];

$lisaa_syote = $_POST['lisaa'];

if (!empty($lisaa_syote)) {
    $virheet = Tyosyote::lisaaSyoteKantaan($tehtava, $lisatieto, $paiva, $kesto, $henkilo_id, $projekti_id);

    if (empty($virheet)) {
        $henkilonUudetSyotteet = Tyosyote::etsiProjektinTyosyotteetHenkilolle($projekti_id, $henkilo_id);

        $_SESSION['kuittaus'] = 'Tiedot lisätty!';
        header('Location: projekti.php?id=' . $projekti_id);
        exit();
    } else {
        $_SESSION['huomautus'] = $virheet;
        header('Location: projekti.php?id=' . $projekti_id . '&tehtava=' . $tehtava . '&paiva=' . $paiva . '&kesto=' . $kesto . '&lisatiedot=' . $lisatieto);
    }
}

