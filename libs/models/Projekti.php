<?php

class Projekti {

    private $nimi;
    private $kuvaus;
    private $projekti_id;

    public function __construct($nimi, $kuvaus, $projekti_id) {
        $this->nimi = $nimi;
        $this->kuvaus = $kuvaus;
        $this->projekti_id = $projekti_id;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getKuvaus() {
        return $this->kuvaus;
    }

    public function getProjekti_id() {
        return $this->projekti_id;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function setKuvaus($kuvaus) {
        $this->kuvaus = $kuvaus;
    }

    public function setProjekti_id($projekti_id) {
        $this->projekti_id = $projekti_id;
    }

    public static function etsiKaikkiProjektit() {
        $sql = "SELECT nimi, kuvaus, projekti_id FROM projekti";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $projekti = new Projekti();
            $projekti->setNimi($tulos->nimi);
            $projekti->setKuvaus($tulos->kuvaus);
            $projekti->setProjekti_id($tulos->projekti_id);

            $tulokset[] = $projekti;
        }
        return $tulokset;
    }

    public static function etsiProjekti($projekti_id) {
        $sql = "SELECT nimi, kuvaus, projekti_id FROM projekti WHERE projekti_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));

        $tulos = $kysely->fetchObject();

        if ($tulos == null) {
            return null;
        } else {
            $projekti = new Projekti();
            $projekti->setNimi($tulos->nimi);
            $projekti->setKuvaus($tulos->kuvaus);
            $projekti->setProjekti_id($tulos->projekti_id);

            $tulokset[] = $projekti;
        }
        return $tulokset;
    }

    public static function etsiHenkilonProjektit($henkilo_id) {
        $sql = "SELECT p.projekti_id, p.nimi, p.kuvaus FROM projekti p WHERE p.projekti_id IN (SELECT projekti_id FROM osallistuja where henkilo_id = ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $projekti = new Projekti();
            $projekti->setNimi($tulos->nimi);
            $projekti->setKuvaus($tulos->kuvaus);
            $projekti->setProjekti_id($tulos->projekti_id);

            $tulokset[] = $projekti;
        }
        return $tulokset;
    }

    public static function etsiProjektienLkm() {
        $sql = "SELECT count(*) from projekti";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }

}
