 INSERT INTO henkilo(nimi, kayttajatunnus, salasana) 
    VALUES ('Teppo Testaaja', 'TeppoT', 'Teppo');
 INSERT INTO henkilo(nimi, kayttajatunnus, salasana) 
    VALUES ('Tiina Testaaja', 'TiinaT', 'Tiina');
INSERT INTO projekti(nimi, kuvaus)
    VALUES ('Tsoha 2014', 'Tietokannan harjoitustyö');
INSERT INTO projekti(nimi, kuvaus)
    VALUES ('Tira 2014', 'Tietorakenteiden harjoitustyö');
INSERT INTO tyosyote(kuvaus, paiva, kesto, lisatiedot, projekti_id, henkilo_id)
    VALUES ('testidatan syöttö', '2014-09-01' ::date, ,'datan syöttö käsin usersille'  1.5, 1, 1);
INSERT INTO vastuuhenkilo(henkilo_id) 
    VALUES (1);
INSERT INTO osallistuja(henkilo_id, projekti_id) 
    VALUES (2,2);
INSERT INTO osallistuja(henkilo_id, projekti_id) 
    VALUES (1,1);
INSERT INTO osallistuja(henkilo_id, projekti_id) 
    VALUES (1,2);


