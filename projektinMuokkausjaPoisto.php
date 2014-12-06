<?php

require_once 'libs/common.php';
require_once 'libs/tietokantayhteys.php';
require_once "libs/models/Projekti.php";

$poistettava = $_POST['poista'];
$muokattava = $_POST['muokkaa'];
$muokattavaNimi = $_POST['muokattavaNimi'];
$muokattavaKuvaus = $_POST['muokattavaKuvaus'];

$vahvistamuokkaus_id = $_POST['vahvista'];

$projektiLkm = Projekti::etsiProjektienLkm();
$projektitJaLkm = Projekti::etsiKaikkiProjektitJaHloLkm();

//projektin poisto 
if (!empty($poistettava)) {
    $_SESSION['kuittaus'] = 'Projekti poistettu';

    Projekti::poistaProjekti($poistettava);
    header('Location: hallinnointi_projektit.php');
    exit();
}

//ohjaa muokkausnäkymään
if (!empty($muokattava)) {
    $muokattavaProjekti = Projekti::etsiProjekti($muokattava);

    naytaNakyma("hallinnointi_projektit_muokkaus_view.php", array(
        'projektitJaLkm' => $projektitJaLkm,
        'projektiLkm' => $projektiLkm,
        'muokattavaProjektiNimi' => $muokattavaProjekti->getNimi(),
        'muokattavaProjektiKuvaus' => $muokattavaProjekti->getKuvaus(),
        'muokattavaProjektiId' => $muokattavaProjekti->getProjekti_id()
    ));
    exit();
}

//vahvistaa muokkauksen
if (!empty($vahvistamuokkaus_id)) {

    $virheet = Projekti::muokkaaProjektia($muokattavaNimi, $muokattavaKuvaus, $vahvistamuokkaus_id);

    if (empty($virheet)) {
        $_SESSION['kuittaus'] = 'Muutokset tallennettu';
        header('Location: hallinnointi_projektit.php');
        exit();

        //virhetilanteen kontrollointi
    } else {
        $_SESSION['huomautus'] = $virheet;

        naytaNakyma("hallinnointi_projektit_muokkaus_view.php", array(
            'projektitJaLkm' => $projektitJaLkm,
            'projektiLkm' => $projektiLkm,
            'muokattavaProjektiNimi' => $muokattavaNimi,
            'muokattavaProjektiKuvaus' => $muokattavaKuvaus,
            'muokattavaProjektiId' => $vahvistamuokkaus_id
        ));
        exit();
    }
}
    



  