<?php

class Projekti {

    private $nimi;
    private $kuvaus;
    private $projekti_id;
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

//    henkilön etusivulla näytettävä lista projekteista, joihin henkilö ei ole liittynyt
    public static function etsiProjektitJoihinHloEiKuulu($henkilo_id) {
        $sql = "SELECT p.projekti_id, p.nimi, p.kuvaus FROM projekti p WHERE p.projekti_id NOT IN (SELECT projekti_id FROM osallistuja where henkilo_id = ?)";
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

//    projektien lukumäärä, joihin henkilö on liittynyt 
    public static function etsiHenkilonProjektitLKm($henkilo_id) {
        $sql = "SELECT count(projekti_id) FROM osallistuja WHERE henkilo_id = ?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute($henkilo_id);
        return $kysely->fetchColumn();
    }

//    kaikkien projektien lukumäärä
    public static function etsiProjektienLkm() {
        $sql = "SELECT count(*) from projekti";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        return $kysely->fetchColumn();
    }

//    projektin lisäys
    public static function lisaaProjekti($nimi, $kuvaus) {
        $virheet = array();

        if (empty($nimi)) {
            $virheet[] = "Nimi ei saa olla tyhjä.";
        } else if (strlen($nimi) > 40) {
            $virheet[] = "Nimi ei saa olla yli 40 merkkiä, pituus oli nyt " . strlen($nimi) . " merkkiä.";
        }
        if (strlen($kuvaus) > 80) {
            $virheet[] = "Kuvaus ei saa olla yli 80 merkkiä, pituus oli nyt " . strlen($kuvaus) . " merkkiä.";
        }

        if (empty($virheet)) {
            $sql = "INSERT INTO projekti (nimi, kuvaus) VALUES (?, ?)";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($nimi, $kuvaus));
        } else {
            return $virheet;
        }
    }

//    projektin poisto
    public static function poistaProjekti($projekti_id) {
        $sql = "DELETE from projekti Where projekti_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
    }

//    projektin muokkaus, virheentarkistus kontrollerissa
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
        $sql = "SELECT projekti.nimi, projekti.kuvaus, projekti.projekti_id, COUNT(osallistuja.henkilo_id) as maara FROM projekti LEFT JOIN osallistuja ON projekti.projekti_id = osallistuja.projekti_id GROUP BY projekti.nimi, projekti.kuvaus, projekti.projekti_id ORDER BY projekti.nimi ASC;";
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

    public static function liitaHloProjektiin($henkilo_id, $projekti_id) {
        $sql = "INSERT INTO osallistuja (henkilo_id, projekti_id) VALUES (?, ?) ";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id, $projekti_id));
    }

    public static function poistaHloProjektista($henkilo_id, $projekti_id) {
        $sql = "DELETE FROM osallistuja WHERE henkilo_id =? AND projekti_id=?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id, $projekti_id));
    }

    public static function etsiProjektinNimi($projekti_id) {
        $sql = "SELECT nimi FROM projekti WHERE projekti_id =?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
        return $kysely->fetchColumn();
    }
    
    

}
