<?php

class Tyosyote {

    private $syote_id;
    private $kuvaus;
    private $lisatiedot;
    private $paiva;
    private $kesto;
    private $henkilo_id;
    private $projekti_id;
    private $virheet = array();

    public function __construct($syote_id, $kuvaus, $lisatiedot, $paiva, $kesto, $henkilo_id, $projekti_id) {
        $this->syote_id = $syote_id;
        $this->kuvaus = $kuvaus;
        $this->paiva = $paiva;
        $this->kesto = $kesto;
        $this->lisatiedot = $lisatiedot;
        $this->henkilo_id = $henkilo_id;
        $this->projekti_id = $projekti_id;
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

    public function setSyote_id($syote_id) {
        $this->syote_id = $syote_id;
    }

    public function setKuvaus($kuvaus) {
        $this->kuvaus = $kuvaus;
//        if (trim($this->nimi) == '') {
//            $this->virheet['nimi'] = "Nimi ei saa olla tyhjä.";
//        } else {
//            unset($this->virheet['nimi']);
//        }
    }

    public function setPaiva($paiva) {
        $this->paiva = $paiva;
    }

    public function setKesto($kesto) {
        $this->kesto = $kesto;
//        if (!is_numeric($kesto)) {
//            $this->virheet['kesto'] = "Keston tulee olla numeromuodossa.";
//        } else if ($uusiPituus <= 0) {
//            $this->virheet['pituus'] = "Keston täytyy olla positiivinen luku.";
//        } else {
//            unset($this->virheet['kesto']);
//        }
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

    public static function etsiHenkilonTyosyotteet($henkilo_id) {
        $sql = "SELECT syote_id, kuvaus, paiva, kesto, henkilo_id, projekti_id FROM tyosyote WHERE henkilo_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $syote = new Tyosyote();
            $syote->setSyote_id($tulos->syote_id);
            $syote->setKuvaus($tulos->kuvaus);
            $syote->setPaiva($tulos->paiva);
            $syote->setKesto($tulos->kesto);
            $syote->setHenkilo_id($tulos->henkilo_id);
            $syote->setProjekti_id($tulos->projekti_id);

            $tulokset[] = $syote;
        }
        return $tulokset;
    }

    public static function etsiProjektinTyosyotteet($projekti_id) {
        $sql = "SELECT syote_id, kuvaus, paiva, kesto, henkilo_id, projekti_id FROM tyosyote WHERE projekti_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $syote = new Tyosyote();
            $syote->setSyote_id($tulos->syote_id);
            $syote->setKuvaus($tulos->kuvaus);
            $syote->setPaiva($tulos->paiva);
            $syote->setKesto($tulos->kesto);
            $syote->setHenkilo_id($tulos->henkilo_id);
            $syote->setProjekti_id($tulos->projekti_id);

            $tulokset[] = $syote;
        }
        return $tulokset;
    }

    public static function etsiProjektinTyosyotteetHenkilolle($projekti_id, $henkilo_id) {
        $sql = "SELECT syote_id, kuvaus, paiva, kesto, lisatiedot,henkilo_id, projekti_id FROM tyosyote WHERE projekti_id = ? and henkilo_id =?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id, $henkilo_id));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $syote = new Tyosyote();
            $syote->setSyote_id($tulos->syote_id);
            $syote->setKuvaus($tulos->kuvaus);
            $syote->setPaiva($tulos->paiva);
            $syote->setKesto($tulos->kesto);
            $syote->setLisatiedot($tulos->lisatiedot);
            $syote->setHenkilo_id($tulos->henkilo_id);
            $syote->setProjekti_id($tulos->projekti_id);

            $tulokset[] = $syote;
        }
        return $tulokset;
    }

    public static function lisaaSyoteKantaan() {
        $sql = "INSERT INTO tyosyote(kuvaus, lisatiedot, paiva, kesto, henkilo_id, projekti_id) VALUES(?,?,?,?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);
        $ok = $kysely->execute(array($this->getKuvaus(), $this->getLisatiedot(), $this->getPaiva(), $this->getKesto(), $this->getHenkilo_id(), $this->getProjekti_id()));
        if ($ok) {
            $this->syote_id = $kysely->fetchColumn();
        }
        return $ok;
    }

    public static function onkoKelvollinen() {
        return empty($this->virheet);
    }

//        if (!is_date($tyoSyote->getPaiva())) {
//            $virheet['paiva'] = "Päivä pitää olla muodossa vuosi - kk - päivä";
//        }
//        if (trim($tyoSyote->getKuvaus()) == '') {
//            $this->virheet['kuvaus'] = "Kuvaus ei saa olla tyhjä.";
//        }
//        if (!is_numeric($kesto)) {
//            $this->virheet['kesto'] = "Syöteen pitää olla numero, max 1 desimaali";
//        } else if ($kesto <= 0) {
//            $this->virheet['kesto'] = "Keston pitää olla positiivinen luku.";
//        }
}
