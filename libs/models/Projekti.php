<?php

class Projekti {

    private $nimi;
    private $kuvaus;
    private $projekti_id;
    private $hlomaara;
    private $syotteidenMaara;

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

    public function getSyotteidenMaara() {
        return $this->syotteidenMaara;
    }

    public function setSyotteidenMaara($syotteidenMaara) {
        $this->syotteidenMaara = $syotteidenMaara;
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

//    hallinnointi_henkilon_tiedot.php - henkilön projektien ja siihen liittyvien tuntimerkintöjen yhteenveto tunneista ja merkintöjen lkm:stä
    public static function etsiHenkilonProjektit($henkilo_id, $jarjestys) {
        $jarjesta = "";

        if ($jarjestys == "kuvaus") {
            $jarjesta = "kuvaus";
        } else if ($jarjestys == 'kesto') {
            $jarjesta = 'kesto DESC';
        } else if ($jarjestys == 'lkm') {
            $jarjesta = 'lkm DESC';
        } else {
            $jarjesta = 'nimi';
        }

        $sql = "SELECT projekti.nimi, osallistuja.projekti_id, projekti.kuvaus, COALESCE(sum(tyosyote.kesto),0) as kesto, count(tyosyote.syote_id) as lkm FROM projekti RIGHT JOIN osallistuja on projekti.projekti_id = osallistuja.projekti_id LEFT JOIN tyosyote on osallistuja.henkilo_id = tyosyote.henkilo_id and osallistuja.projekti_id = tyosyote.projekti_id WHERE osallistuja.henkilo_id = ? group by projekti.nimi, projekti.kuvaus, osallistuja.projekti_id ORDER BY $jarjesta";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tiedot = array();
            $tiedot[0] = $tulos->projekti_id;
            $tiedot[1] = $tulos->nimi;
            $tiedot[2] = $tulos->kuvaus;
            $tiedot[3] = $tulos->kesto;
            $tiedot[4] = $tulos->lkm;

            $tulokset[] = $tiedot;
        }
        return $tulokset;
    }

//    henkilön etusivulla näytettävä lista projekteista, joihin henkilö ei ole liittynyt
    public static function etsiProjektitJoihinHloEiKuulu($henkilo_id) {
        $sql = "SELECT p.projekti_id, p.nimi, p.kuvaus FROM projekti p WHERE p.projekti_id NOT IN (SELECT projekti_id FROM osallistuja where henkilo_id = ?) ORDER BY nimi";
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
    public static function etsiHenkilonProjektiLKm($henkilo_id) {
        $sql = "SELECT count(projekti_id) FROM osallistuja WHERE henkilo_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));
        $tulos = $kysely->fetchColumn();

        return $tulos;
    }

//    kaikkien projektien lukumäärä
    public static function etsiProjektienLkm() {
        $sql = "SELECT count(*) from projekti";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        $tulos = $kysely->fetchColumn();

        if ($tulos == null) {
            return null;
        } else {
            return $tulos;
        }
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
        if (Projekti::onkoProjektinNimiOlemassa($nimi)) {
            $virheet[] = "Samalla nimellä on jo olemassa projekti.";
        }

        if (empty($virheet)) {
            $sql = "INSERT INTO projekti (nimi, kuvaus) VALUES (?, ?)";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($nimi, $kuvaus));
        } else {
            return $virheet;
        }
    }

    public static function onkoProjektinNimiOlemassa($nimi) {
        $sql = "SELECT nimi from projekti Where nimi = ? LIMIT 1;";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($nimi));

        $tulos = $kysely->fetchObject();

        if ($tulos == null) {
            return null;
        } else {
            return $tulos;
        }
    }

//    projektin poisto
    public static function poistaProjekti($projekti_id) {
        $sql = "DELETE from projekti Where projekti_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
    }

//    projektin muokkaus
    public static function muokkaaProjektia($nimi, $kuvaus, $projekti_id) {
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
            $sql = "UPDATE projekti SET nimi =?, kuvaus =? WHERE projekti_id =?";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($nimi, $kuvaus, $projekti_id));
        } else {
            return $virheet;
        }
    }

    public static function etsiProjektinHenkilomaara($projekti_id) {
        $sql = "SELECT count(henkilo_id) from osallistuja WHERE projekti_id =?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
        $tulos = $kysely->fetchColumn();

        if ($tulos == null) {
            return null;
        } else {
            return $tulos;
        }
    }

//    listaus projekteista ja yhteenveto hlöiden ja merkintöjen määrästä - hallinnointi_projektit_listaus_view.php / hallinnointi_projektit.php sivulle
    public static function etsiKaikkiProjektitJaHloJaSyoteLkm() {
        $sql = "SELECT projekti.nimi, projekti.kuvaus, projekti.projekti_id, COUNT(osallistuja.henkilo_id) as maara FROM projekti LEFT JOIN osallistuja ON projekti.projekti_id = osallistuja.projekti_id GROUP BY projekti.nimi, projekti.kuvaus, projekti.projekti_id ORDER BY projekti.nimi ASC";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $projekti = new Projekti();
            $projekti->setNimi($tulos->nimi);
            $projekti->setKuvaus($tulos->kuvaus);
            $projekti->setProjekti_id($tulos->projekti_id);
            $projekti->setHlomaara($tulos->maara);
            $projekti->setSyotteidenMaara(Projekti::etsiProjektinSyotteidenLkm($tulos->projekti_id));

            $tulokset[] = $projekti;
        }
        return $tulokset;
    }

    public static function etsiProjektinSyotteidenLkm($projekti_id) {
        $sql = "SELECT count(syote_id) from tyosyote where projekti_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
        $tulos = $kysely->fetchColumn();

        return $tulos;
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
        $tulos = $kysely->fetchColumn();

        if ($tulos == null) {
            return null;
        } else {
            return $tulos;
        }
    }

//    hallinnointi_projektit.php - projektikohtainen yhtenveto henkilöistä, tunneista ja merkintöjen määristä
//    tallennettu array:hin, koska haussa projektin, työsyötteen ja henkilön tietoja, ei sovi luontevasti olio-atribuutteihin.
    public static function etsiProjektinYhteenVetoHenkiloille($projekti_id) {
        $sql = "SELECT henkilo.henkilo_id, henkilo.nimi, COALESCE(sum(tyosyote.kesto),0) as kesto, count(tyosyote.syote_id) as lkm FROM henkilo RIGHT JOIN osallistuja on henkilo.henkilo_id = osallistuja.henkilo_id LEFT JOIN tyosyote on osallistuja.henkilo_id = tyosyote.henkilo_id and osallistuja.projekti_id = tyosyote.projekti_id WHERE osallistuja.projekti_id = ? GROUP BY henkilo.nimi, henkilo.henkilo_id ORDER BY kesto";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($projekti_id));
        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $tiedot = array();
            $tiedot[0] = $tulos->henkilo_id;
            $tiedot[1] = $tulos->nimi;
            $tiedot[2] = $tulos->kesto;
            $tiedot[3] = $tulos->lkm;
            $tulokset[] = $tiedot;
        }

        return $tulokset;
    }

}
