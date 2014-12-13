<?php

require_once "libs/models/Tyosyote.php";
require_once "libs/models/Projekti.php";


class Henkilo {

    private $henkilo_id;
    private $nimi;
    private $kayttajatunnus;
    private $salasana;
    private $vastuuhenkilo;
    private $admin;
    private $tunnit;
    private $merkinnat;
    private $projektiLkm;

    public function __construct($henkilo_id, $nimi, $kayttajatunnus, $salasana) {
        $this->henkilo_id = $henkilo_id;
        $this->nimi = $nimi;
        $this->kayttajatunnus = $kayttajatunnus;
        $this->salasana = $salasana;
    }

    public function getHenkilo_id() {
        return $this->henkilo_id;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function getTunnus() {
        return $this->kayttajatunnus;
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function getVastuuhenkilo() {
        return $this->vastuuhenkilo;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getTunnit() {
        return $this->tunnit;
    }

    public function getMerkinnat() {
        return $this->merkinnat;
    }
    
    public function getProjektiLkm() {
        return $this->projektiLkm;
    }

    public function setProjektiLkm($projektiLkm) {
        $this->projektiLkm = $projektiLkm;
    }

    
    public function setTunnit($tunnit) {
        $this->tunnit = $tunnit;
    }

    public function setMerkinnat($merkinnat) {
        $this->merkinnat = $merkinnat;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function setVastuuhenkilo($vastuuhenkilo) {
        $this->vastuuhenkilo = $vastuuhenkilo;
    }

    public function setHenkilo_id($henkilo_id) {
        $this->henkilo_id = $henkilo_id;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    public function setTunnus($kayttajatunnus) {
        $this->kayttajatunnus = $kayttajatunnus;
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
    }

    public function etsiKaikkiHenkilot() {
        $sql = 'SELECT henkilo_id, nimi, kayttajatunnus, salasana FROM henkilo order by nimi';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {

            $henkilo = new Henkilo();
            $henkilo->henkilo_id = $tulos->henkilo_id;
            $henkilo->nimi = $tulos->nimi;
            $henkilo->kayttajatunnus = $tulos->kayttajatunnus;
            $henkilo->salasana = $tulos->salasana;
            $henkilo->vastuuhenkilo = Henkilo::onkoVastuuhenkilo($tulos->henkilo_id);
            $henkilo->admin = Henkilo::onkoKayttajaAdmin($tulos->henkilo_id);
            $henkilo->tunnit = Tyosyote::etsiHenkilonTunnit($tulos->henkilo_id);
            $henkilo->merkinnat = Tyosyote::etsiHenkilonMerkintojenLkm($tulos->henkilo_id);
            $henkilo->projektiLkm = Projekti::etsiHenkilonProjektiLKm($tulos->henkilo_id);
            $tulokset[] = $henkilo;
        }
        return $tulokset;
    }

    public static function etsiHenkiloTunnuksilla($kayttajatunnus, $salasana) {
        $sql = "SELECT henkilo_id, nimi, kayttajatunnus, salasana FROM henkilo WHERE kayttajatunnus = ? AND salasana = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttajatunnus, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $henkilo = new Henkilo($tulos->henkilo_id, $tulos->nimi, $tulos->kayttajatunnus, $tulos->salasana);

            return $henkilo;
        }
    }

    public static function etsiHenkiloIDlla($henkilo_id) {
        $sql = "SELECT henkilo_id, nimi, kayttajatunnus, salasana FROM henkilo WHERE henkilo_id = ? LIMIT 1";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $henkilo = new Henkilo($tulos->henkilo_id, $tulos->nimi, $tulos->kayttajatunnus, $tulos->salasana);

            return $henkilo;
        }
    }

    public static function onkoVastuuhenkilo($henkilo_id) {
        $sql = "SELECT henkilo_id FROM vastuuhenkilo WHERE henkilo_id=?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            return $tulos;
        }
    }

    public static function onkoKayttajaAdmin($henkilo_id) {
        $sql = "SELECT henkilo_id FROM vastuuhenkilo WHERE henkilo_id = ? and paakayttaja = true";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));
        $tulos = $kysely->fetchObject();

        if ($tulos == null) {
            return null;
        } else {
            return $tulos;
        }
    }

    public static function uusiHenkilo($nimi, $kayttajatunnus, $salasana) {
        $virheet = array();

        if (empty($nimi)) {
            $virheet[] = "Nimi ei saa olla tyhjä";
        } else if (strlen($nimi) > 40) {
            $virheet[] = "Nimi saa olla enintään 40 merkkiä pitkä, annetun pituus oli " . strlen($nimi) . ".";
        }

        if (empty($kayttajatunnus)) {
            $virheet[] = "Käyttäjätunnus ei saa olla tyhjä";
        } else if (strlen($kayttajatunnus) > 15) {
            $virheet[] = "Käyttäjätunnus olla saa enintään 15 merkkiä pitkä, nyt pituus on " . strlen($kayttajatunnus);
        } else if (Henkilo::onkoKayttajatunnusVapaa($kayttajatunnus)) {
            $virheet[] = "Käyttäjätunnus " . $kayttajatunnus . " ei ole vapaa.";
        }


        if (empty($salasana)) {
            $virheet[] = "Salasana ei saa olla tyhjä";
        } else if (strlen($nimi) > 15) {
            $virheet[] = "Salasana saa olla enintään 15 merkkiä pitkä, nyt pituus on " . strlen($nimi);
        }

        if (empty($virheet)) {
            $sql = "INSERT INTO henkilo (nimi, kayttajatunnus, salasana) VALUES (?,?,?)";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($nimi, $kayttajatunnus, $salasana));
        } else {
            return $virheet;
        }
    }

    public static function onkoKayttajatunnusVapaa($kayttajatunnus) {
        if (empty($kayttajatunnus)) {
            return 'false';
        } else {
            $sql = "SELECT kayttajatunnus FROM henkilo WHERE kayttajatunnus = ?";
            $kysely = getTietokantayhteys()->prepare($sql);
            $kysely->execute(array($kayttajatunnus));
            $tulos = $kysely->fetchObject();
            if ($tulos == null) {
                return null;
            } else {
                return $tulos;
            }
        }
    }

    public static function lisaaVastuuhenkilo($henkilo_id) {
        $sql = "INSERT INTO vastuuhenkilo (henkilo_id) VALUES (?)";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));
    }

    public static function poistaVastuuhenkilo($henkilo_id) {
        $sql = "DELETE from vastuuhenkilo WHERE henkilo_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));
    }

    public static function etsiHenkilonProjektienYhteenVeto($henkilo_id) {
        $sql = "SELECT projekti.nimi, projekti.projekti_id, projekti.kuvaus, COALESCE(sum(tyosyote.kesto),0) as kesto, count(tyosyote.syote_id) as lkm FROM projekti RIGHT JOIN osallistuja on projekti.projekti_id = osallistuja.projekti_id LEFT JOIN tyosyote on osallistuja.projekti_id = tyosyote.projekti_id and osallistuja.henkilo_id = tyosyote.henkilo_id WHERE osallistuja.henkilo_id = ? GROUP BY projekti.nimi, projekti.kuvaus, projekti.projekti_id ORDER BY projekti.nimi";
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

    public static function etsiHenkilonNimi($henkilo_id) {
        $sql = "SELECT nimi from henkilo where henkilo_id = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($henkilo_id));
        return $kysely->fetchColumn();
    }

}
