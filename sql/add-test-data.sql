 INSERT INTO henkilo(nimi, kayttajatunnus, salasana) 
    VALUES ('Teppo Testaaja', 'TeppoT', 'Teppo');
 INSERT INTO henkilo(nimi, kayttajatunnus, salasana) 
    VALUES ('Tiina Testaaja', 'TiinaT', 'Tiina');
INSERT INTO asiakas(nimi)
    VALUES ('Firma');
INSERT INTO projekti(nimi, kuvaus, asiakas_id)
    VALUES ('testi1', 'Tietokannan harjoitustyö', 1);
INSERT INTO tyosyote(kuvaus, paiva, kesto, projekti_id)
    VALUES ('koodaus', '2014-09-01' ::date, 1.5, 1);


