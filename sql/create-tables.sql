CREATE TABLE henkilo(
	henkilo_id serial PRIMARY KEY,
	nimi varchar(40) NOT NULL,
        kayttajatunnus varchar(15) NOT NULL,
        salasana varchar (15) NOT NULL
);

CREATE TABLE asiakas(
	asiakas_id serial PRIMARY KEY,
	nimi varchar (40) NOT NULL
);

CREATE TABLE projekti(
	nimi varchar(40) NOT NULL,
	kuvaus varchar(80),
	projekti_id serial PRIMARY KEY,
	asiakas_id serial REFERENCES asiakas(asiakas_id)
);

CREATE TABLE tyosyote(
	syote_id serial PRIMARY KEY,
	kuvaus varchar(80) NOT NULL,
	paiva date NOT NULL,
	kesto decimal(2,1) NOT NULL,
        henkilo_id serial REFERENCES henkilo, 
	projekti_id serial REFERENCES projekti(projekti_id) ON DELETE CASCADE 
);

CREATE TABLE osallistuja(
	henkilo_id serial REFERENCES henkilo ON DELETE CASCADE,
	projekti_id serial REFERENCES projekti ON DELETE CASCADE,
	PRIMARY KEY (henkilo_id, projekti_id)
);