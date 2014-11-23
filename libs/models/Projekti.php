<?php

class Projekti {

    private $nimi;
    private $kuvaus;
    private $projekti_id;
    private $virheet = array();
    private $hlomaara;

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

    public function getVirheet() {
        return $this->virheet;
    }

    public function getHlomaara() {
        return $this->hlomaara;
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

    public function setHlomaara($hlomaara) {
        $this->hlomaara = $hlomaara;
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
        }
        return $projekti;
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

    public static function lisaaProjekti($nimi, $kuvaus) {
        $sql = "INSERT INTO projekti (nimi, kuvaus) VALUES (?, ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi, $kuvaus));
    }

    public static function onkoKelvollinen() {
        if (trim($this->nimi) == '') {
            $this->virheet['nimi'] = "Nimi ei saa olla tyhjä!";
        } else {
            unset($this->virheet['nimi']);
        }
        return empty($this->virheet);
    }

    public static function poistaProjekti($projekti_id) {
        $sql = "DELETE from projekti Where projekti_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
    }

    public static function muokkaaProjektia($nimi, $kuvaus, $projekti_id) {
        $sql = "UPDATE projekti SET nimi =?, kuvaus =? WHERE projekti_id =?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi, $kuvaus, $projekti_id));
    }

    public static function etsiProjektinHenkilomaara($projekti_id) {
        $sql = "SELECT count(henkilo_id) from osallistuja WHERE projekti_id =?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
        return $kysely->fetchColumn();
    }

    public static function etsiKaikkiProjektitJaHloLkm() {
        $sql = "SELECT projekti.nimi, projekti.kuvaus, projekti.projekti_id, COUNT(osallistuja.henkilo_id) as maara FROM projekti LEFT JOIN osallistuja ON projekti.projekti_id = osallistuja.projekti_id GROUP BY projekti.nimi, projekti.kuvaus, projekti.projekti_id;";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $projekti = new Projekti();
            $projekti->setNimi($tulos->nimi);
            $projekti->setKuvaus($tulos->kuvaus);
            $projekti->setProjekti_id($tulos->projekti_id);
            $projekti->setHlomaara($tulos->maara);

            $tulokset[] = $projekti;
        }
        return $tulokset;
    }

}
