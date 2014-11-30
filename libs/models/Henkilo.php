<?php

class Henkilo {

    private $henkilo_id;
    private $nimi;
    private $kayttajatunnus;
    private $salasana;

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
        $sql = 'SELECT henkilo_id, nimi, kayttajatunnus, salasana FROM henkilo';
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $id = $tulos->henkilo_id;
            $nimi = $tulos->nimi;
            $tunnus = $tulos->kayttajatunnus;
            $salasana = $tulos->salasana;
            $henkilo = new Henkilo($id, $nimi, $tunnus, $salasana);
            $tulokset[] = $henkilo;
        }
        return $tulokset;
    }

//        public function etsiKaikkiHenkilotjaViimeinenMerkinta() {
//        $sql = 'SELECT henkilo.henkilo_id, henkilo.nimi, henkilo.kayttajatunnus, henkilo.salasana, LAST(tyosyote.paiva) FROM henkilo, tyosyote WHERE henkilo.henkilo_id = tyosyote.henkilo.id';
//        $kysely = getTietokantayhteys()->prepare($sql);
//        $kysely->execute();
//
//        $tulokset = array();
//        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
//            $id = $tulos->henkilo_id;
//            $nimi = $tulos->nimi;
//            $tunnus = $tulos->kayttajatunnus;
//            $salasana = $tulos->salasana;
//            $henkilo = new Henkilo($id, $nimi, $tunnus, $salasana);
//            $tulokset[] = $henkilo;
//        }
//        return $tulokset;
//    }

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

    public static function uusiHenkilo($nimi, $kayttajatunnus, $salasana) {
        $virheet = array();

        if (empty($nimi)) {
            $virheet[] = "Nimi ei saa olla tyhjä";
        } else if (strlen($nimi) > 40) {
            $virheet[] = "Nimi saa olla enintään 40 merkkiä pitkä, annetun pituus oli " . strlen($nimi) . ".";
        }
        if (empty($kayttajatunnus)) {
            $virheet[] = "Käyttäjätunnus ei saa olla tyhjä";
        } else if (Henkilo::onkoKayttajatunnusVapaa($kayttajatunnus)) {
            $virheet[] = "Käyttäjätunnus". $kayttajatunnus." ei ole käytettävissä";
        } else if (strlen($kayttajatunnus) > 15) {
            $virheet[] = "Käyttäjätunnus olla saa enintään 15 merkkiä pitkä, nyt pituus on " . strlen($kayttajatunnus);
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
            $tulos = $kysely->fetchObject();
        } else {
            return $virheet;
        }
    }

    public static function onkoKayttajatunnusVapaa($kayttajatunnus) {
        $sql = "SELECT kayttajatunnus FROM henkilo WHERE kayttajatunnus = ?";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute(array($kayttajatunnus));
        $tulos = $kysely->fetchObject();
        return $tulos;
    }

}
