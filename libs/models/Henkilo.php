<?php
class Henkilo {

    private $henkilo_id;
    private $nimi;
    private $kayttajatunnus;
    private $salasana;

    function __construct($henkilo_id, $nimi, $kayttajatunnus, $salasana) {
        $this->henkilo_id = $henkilo_id;
        $this->nimi = $nimi;
        $this->kayttajatunnus = $kayttajatunnus;
        $this->salasana = $salasana;
    }
    
        function getHenkilo_id() {
        return $this->henkilo_id;
    }

    function getNimi() {
        return $this->nimi;
    }

    function getTunnus() {
        return $this->kayttajatunnus;
    }

    function getSalasana() {
        return $this->salasana;
    }

    function setHenkilo_id($henkilo_id) {
        $this->henkilo_id = $henkilo_id;
    }

    function setNimi($nimi) {
        $this->nimi = $nimi;
    }

    function setTunnus($kayttajatunnus) {
        $this->kayttajatunnus = $kayttajatunnus;
    }

    function setSalasana($salasana) {
        $this->salasana = $salasana;
    }

    public static function etsiKaikkiHenkilot() {
        $sql = "SELECT henkilo_id, nimi, kayttajatunnus, salasana FROM henkilo";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();

        $tulokset = array();
        foreach ($kysely->fetchAll(PDO::FETCH_OBJ) as $tulos) {
            $henkilo = new Henkilo();
            $henkilo->setId($tulos->henkilo_id);
            $henkilo->setNimi($tulos->nimi);
            $henkilo->setTunnus($tulos->kayttajatunnus);
            $henkilo->setSalanana($tulos->salasana);

            $tulokset[] = $henkilo;
        }
        return $tulokset;
    }

}
