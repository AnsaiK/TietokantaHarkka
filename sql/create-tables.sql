CREATE TABLE henkilo(
	henkilo_id serial PRIMARY KEY,
	nimi varchar(40) NOT NULL,
        kayttajatunnus varchar(15) NOT NULL,
        salasana varchar (15) NOT NULL     
);

CREATE TABLE vastuuhenkilo(
        henkilo_id serial PRIMARY KEY REFERENCES henkilo ON DELETE CASCADE 
);

CREATE TABLE projekti(
	nimi varchar(40) NOT NULL,
	kuvaus varchar(80),
	projekti_id serial PRIMARY KEY
);

CREATE TABLE tyosyote(
	syote_id serial PRIMARY KEY,
	kuvaus varchar(80) NOT NULL,
        lisatiedot varchar (160), 
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