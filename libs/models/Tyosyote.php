<?php

class Tyosyote {

    private $syote_id;
    private $kuvaus;
    private $paiva;
    private $kesto;
    private $henkilo_id;
    private $projekti_id;

    public function __construct($syote_id, $kuvaus, $paiva, $kesto, $henkilo_id, $projekti_id) {
        $this->syote_id = $syote_id;
        $this->kuvaus = $kuvaus;
        $this->paiva = $paiva;
        $this->kesto = $kesto;
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

    public function getHenkilo_id() {
        return $this->henkilo_id;
    }

    public function getProjekti_id() {
        return $this->projekti_id;
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
        $sql = "SELECT syote_id, kuvaus, paiva, kesto, henkilo_id, projekti_id FROM tyosyote WHERE projekti_id = ? and henkilo_id =?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id, $henkilo_id));

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
}
