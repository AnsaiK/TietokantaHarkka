<?php

require_once "libs/models/Henkilo.php";

class Tyosyote {

    private $syote_id;
    private $projekti_nimi;
    private $henkilo_nimi;
    private $kuvaus;
    private $lisatiedot;
    private $paiva;
    private $kesto;
    private $henkilo_id;
    private $projekti_id;

    public function __construct($syote_id, $kuvaus, $lisatiedot, $paiva, $kesto, $henkilo_id, $projekti_id, $projekti_nimi, $henkilo_nimi) {
        $this->syote_id = $syote_id;
        $this->kuvaus = $kuvaus;
        $this->lisatiedot = $lisatiedot;
        $this->paiva = $paiva;
        $this->kesto = $kesto;
        $this->henkilo_id = $henkilo_id;
        $this->projekti_id = $projekti_id;
        $this->projekti_nimi = $projekti_nimi;
        $this->henkilo_nimi = $henkilo_nimi;
    }

    public function getSyote_id() {
        return $this->syote_id;
    }

    public function getKuvaus() {
        return $this->kuvaus;
    }

    public function getPaiva() {
        return $this->paiva;
    }

    public function getKesto() {
        return $this->kesto;
    }

    public function getLisatiedot() {
        return $this->lisatiedot;
    }

    public function getHenkilo_id() {
        return $this->henkilo_id;
    }

    public function getProjekti_id() {
        return $this->projekti_id;
    }

    public function getVirheet() {
        return $this->virheet;
    }

    public function getProjekti_nimi() {
        return $this->projekti_nimi;
    }

    public function getHenkilo_nimi() {
        return $this->henkilo_nimi;
    }

    public function setHenkilo_nimi($henkilo_nimi) {
        $this->henkilo_nimi = $henkilo_nimi;
    }

    public function setProjekti_nimi($projekti_nimi) {
        $this->projekti_nimi = $projekti_nimi;
    }

    public function setSyote_id($syote_id) {
        $this->syote_id = $syote_id;
    }

    public function setKuvaus($kuvaus) {
        $this->kuvaus = $kuvaus;
    }

    public function setPaiva($paiva) {
        $this->paiva = $paiva;
    }

    public function setKesto($kesto) {
        $this->kesto = $kesto;
    }

    public function setLisatiedot($lisatiedot) {
        $this->lisatiedot = $lisatiedot;
    }

    public function setHenkilo_id($henkilo_id) {
        $this->henkilo_id = $henkilo_id;
    }

    public function setProjekti_id($projekti_id) {
        $this->projekti_id = $projekti_id;
    }

//    Yhden työsyotteen haku, muokkauksenlomakkeen tietoja varten 
    public static function etsiTyosyote($syote_id) {
        $sql = "SELECT syote_id, kuvaus, kesto, to_char(paiva, 'DD-MM-YYYY') as paiva, lisatiedot, henkilo_id, projekti_id FROM tyosyote WHERE syote_id = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($syote_id));
        $tulos = $kysely->fetchObject();

        if ($tulos == null) {
            return null;
        } else {
            return new Tyosyote($tulos->syote_id, $tulos->kuvaus, $tulos->lisatiedot, $tulos->paiva, $tulos->kesto, $tulos->henkilo_id, $tulos->projekti_id, '', '');
        }
    }

//    hallinnoinnissa näytettävät henkilön kaikki syötteet
    public static function etsiHenkilonTyosyotteet($henkilo_id, $jarjestys) {
        $jarjesta = "";

        if ($jarjestys == "lisatiedot") {
            $jarjesta = "lisatiedot ASC";
        } else if ($jarjestys == 'kuvaus') {
            $jarjesta = 'kuvaus';
        } else if ($jarjestys == 'paiva') {
            $jarjesta = 'date(paiva) DESC';
        } else if ($jarjestys == 'kesto') {
            $jarjesta = 'kesto DESC';
        } else {
            $jarjesta = 'nimi';
        }

        $sql = "SELECT projekti.nimi, t.syote_id, t.kuvaus, to_char(t.paiva, 'DD/MM/YYYY') as paiva, t.kesto, t.lisatiedot, t.henkilo_id, t.projekti_id FROM tyosyote AS t LEFT JOIN projekti ON projekti.projekti_id = t.projekti_id WHERE t.henkilo_id = ? ORDER BY $jarjesta";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $syote = new Tyosyote();
            $syote->setSyote_id($tulos->syote_id);
            $syote->setKuvaus($tulos->kuvaus);
            $syote->setLisatiedot($tulos->lisatiedot);
            $syote->setPaiva($tulos->paiva);
            $syote->setKesto($tulos->kesto);
            $syote->setHenkilo_id($tulos->henkilo_id);
            $syote->setProjekti_id($tulos->projekti_id);
            $syote->setProjekti_nimi($tulos->nimi);
            $syote->setHenkilo_nimi(Henkilo::etsiHenkilonNimi($tulos->henkilo_id));

            $tulokset[] = $syote;
        }
        return $tulokset;
    }

//    projektin kaikki syötteet
    public static function etsiProjektinTyosyotteet($projekti_id, $jarjestys) {
        $jarjesta = "";

        if ($jarjestys == "lisatiedot") {
            $jarjesta = "lisatiedot ASC";
        } else if ($jarjestys == 'kuvaus') {
            $jarjesta = 'kuvaus';
        } else if ($jarjestys == 'paiva') {
            $jarjesta = 'date(paiva) DESC';
        } else if ($jarjestys == 'kesto') {
            $jarjesta = 'kesto DESC';
        } else {
            $jarjesta = 'nimi';
        }

        $sql = "SELECT nimi, syote_id, kuvaus, to_char(paiva, 'DD/MM/YYYY') as paiva, kesto, lisatiedot, henkilo.henkilo_id, projekti_id FROM henkilo JOIN tyosyote ON henkilo.henkilo_id = tyosyote.henkilo_id AND tyosyote.projekti_id = ? ORDER BY $jarjesta, date(paiva) DESC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
        $tulokset = array();

        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $syote = new Tyosyote();
            $syote->setSyote_id($tulos->syote_id);
            $syote->setKuvaus($tulos->kuvaus);
            $syote->setLisatiedot($tulos->lisatiedot);
            $syote->setPaiva($tulos->paiva);
            $syote->setKesto($tulos->kesto);
            $syote->setHenkilo_id($tulos->henkilo_id);
            $syote->setProjekti_id($tulos->projekti_id);
            $syote->setProjekti_nimi();
            $syote->setHenkilo_nimi($tulos->nimi);

            $tulokset[] = $syote;
        }
        return $tulokset;
    }

//    henkilön projektikohtainen työsyötelistaus
    public static function etsiProjektinTyosyotteetHenkilolle($projekti_id, $henkilo_id, $jarjestys) {
        $jarjesta = "";

        if ($jarjestys == "lisatiedot") {
            $jarjesta = "lisatiedot ASC";
        } else if ($jarjestys == 'kuvaus') {
            $jarjesta = 'kuvaus';
        } else if ($jarjestys == 'nimi') {
            $jarjesta = 'nimi';
        } else if ($jarjestys == 'kesto') {
            $jarjesta = 'kesto DESC';
        } else {
            $jarjesta = 'date(paiva) DESC';
        }

        $sql = "SELECT projekti.nimi, t.syote_id, t.kuvaus, to_char(t.paiva, 'DD/MM/YYYY') as paiva, t.kesto, t.lisatiedot, t.henkilo_id, t.projekti_id FROM tyosyote AS t LEFT JOIN projekti ON projekti.projekti_id = t.projekti_id WHERE t.projekti_id = ? and t.henkilo_id = ? ORDER BY $jarjesta, date(t.paiva) DESC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id, $henkilo_id));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $syote = new Tyosyote();
            $syote->setSyote_id($tulos->syote_id);
            $syote->setKuvaus($tulos->kuvaus);
            $syote->setLisatiedot($tulos->lisatiedot);

            $syote->setPaiva($tulos->paiva);
            $syote->setKesto($tulos->kesto);
            $syote->setHenkilo_id($tulos->henkilo_id);
            $syote->setProjekti_id($tulos->projekti_id);
            $syote->setProjekti_nimi($tulos->nimi);
            $syote->setHenkilo_nimi(Henkilo::etsiHenkilonNimi($tulos->henkilo_id));


            $tulokset[] = $syote;
        }
        return $tulokset;
    }

//    projektinSyoteMuokkausjaPoisto.php - syotteen poisto
    public static function poistaSyote($syote_id) {
        $sql = "DELETE FROM tyosyote WHERE syote_id =?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($syote_id));
    }

//    projektinSyoteMuokkausjaPoisto.php - työsyötteen tietojen muokkaus
    public static function muokkaaSyotetta($kuvaus, $lisatiedot, $paiva, $kesto, $syote_id) {
        $virheet = array();

        if (empty($kuvaus)) {
            $virheet[] = "Työtehtävä ei saa olla tyhjä.";
        } else if (strlen($kuvaus) > 80) {
            $virheet[] = "Työtehtävä saa olla enintään 80 merkkiä pitkä, annetun tekstin pituus oli " . strlen($kuvaus) . ".";
        }

        if (empty($kesto)) {
            $virheet[] = "Kesto ei saa olla tyhjä.";
        } else if (!is_numeric($kesto)) {
            $virheet[] = "kesto pitää antaa lukuna.";
        }
        if (empty($paiva)) {
            $virheet[] = "Päivä ei saa olla tyhjä.";
        }
        $tarkistuspaiva = str_replace("/", "-", $paiva);
        $tarkistuspaiva = str_replace(".", "-", $tarkistuspaiva);
        $p = explode("-", $tarkistuspaiva);

        if (!checkdate($p[1], $p[0], $p[2])) {
            $virheet[] = "Anna päivä muodossa pv-kk-v tai pv/kk/v.";
        }
//
        if (empty($virheet)) {
            $sql = "UPDATE tyosyote SET kuvaus=?, lisatiedot=?, paiva=?, kesto=? WHERE syote_id =?";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($kuvaus, $lisatiedot, $paiva, $kesto, $syote_id));
        } else {
            return $virheet;
        }
    }

//    projektinLisays.php - syötteen lisäys kantaan
    public static function lisaaSyoteKantaan($kuvaus, $lisatiedot, $paiva, $kesto, $henkilo_id, $projekti_id) {
        $virheet = array();

        if (empty($kuvaus)) {
            $virheet[] = "Työtehtävä ei saa olla tyhjä.";
        } else if (strlen($kuvaus) > 80) {
            $virheet[] = "Työtehtävä saa olla enintään 80 merkkiä pitkä, annetun tekstin pituus oli " . strlen($kuvaus) . ".";
        }

        if (empty($kesto)) {
            $virheet[] = "Kesto ei saa olla tyhjä.";
        } else if (!is_numeric($kesto)) {
            $virheet[] = "kesto pitää antaa lukuna.";
        }
        if (empty($paiva)) {
            $virheet[] = "Päivä ei saa olla tyhjä.";
        }

        $tarkistuspaiva = str_replace("/", "-", $paiva);
        $tarkistuspaiva = str_replace(".", "-", $tarkistuspaiva);
        $p = explode("-", $tarkistuspaiva);

        if (!checkdate($p[1], $p[0], $p[2])) {
            $virheet[] = "Anna päivä muodossa pv-kk-v tai pv/kk/v.";
        }

        if (empty($virheet)) {
            $sql = "INSERT INTO tyosyote(kuvaus, lisatiedot, paiva, kesto, henkilo_id, projekti_id) VALUES(?,?,?,?,?,?)";
            $kysely = getTietokantayhteys()->prepare($sql);
            $ok = $kysely->execute(array($kuvaus, $lisatiedot, $paiva, $kesto, $henkilo_id, $projekti_id));
        } else {
            return $virheet;
        }
    }

//    projektin merkintöjen yhteenlaskettu tuntimäärä
    public static function etsiProjektinTuntimaara($projekti_id) {
        $sql = "SELECT sum(kesto) FROM tyosyote WHERE projekti_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
        return $kysely->fetchColumn();
    }

//    projektin tuntimerkintöjen lukumäärä
    public static function etsiProjektinSyoteMaara($projekti_id) {
        $sql = "SELECT count(syote_id) FROM tyosyote WHERE projekti_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
        return $kysely->fetchColumn();
    }

//    hallinnointi_henkilon_tiedot.php
    public static function etsiProjektinSyoteenKuvaustenLkm($projekti_id) {
        $sql = "SELECT count(DISTINCT kuvaus) FROM tyosyote WHERE projekti_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
        return $kysely->fetchColumn();
    }

//    hallinnointi_henkilon_tiedot.php
    public static function etsiHenkilonVikaSyotePvm($henkilo_id) {
        $sql = "SELECT to_char(paiva, 'DD.MM.YYYY') as paiva, projekti.nimi from tyosyote join projekti on tyosyote.projekti_id = projekti.projekti_id where henkilo_id = ? GROUP BY projekti.nimi, tyosyote.paiva  ORDER BY paiva DESC limit 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));
        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
        $tulokset = array();
        $tulokset[0] = $tulos[0]->paiva;
        $tulokset[1] = $tulos[0]->nimi;
        return $tulokset;
    }

//    hallinnointi_henkilon_tiedot.php
    public static function etsiHenkilonTunnitjaMerkintojenLkm($henkilo_id) {
        $sql = "SELECT COALESCE(sum(tyosyote.kesto),0) as kesto, count(tyosyote.syote_id) as lkm from tyosyote where henkilo_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));
        $tulos = $kysely->fetchAll(PDO::FETCH_OBJ);
        $tulokset = array();
        $tulokset[0] = $tulos[0]->kesto;
        $tulokset[1] = $tulos[0]->lkm;
        return $tulokset;
    }

    public static function etsiHenkilonTunnit($henkilo_id) {
        $sql = "SELECT COALESCE(sum(tyosyote.kesto),0) as tunnit from tyosyote where henkilo_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));
        return $kysely->fetchColumn();
    }

    public static function etsiHenkilonMerkintojenLkm($henkilo_id) {
        $sql = "SELECT count(tyosyote.syote_id) as merkinnat from tyosyote where henkilo_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));
        return $kysely->fetchColumn();
    }

}
