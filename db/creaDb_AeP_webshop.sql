/**Creo il database assegnandoli il nome AeP_webshop*/
CREATE DATABASE AeP_webshop;

/**Seleziono il database precedentemente creato al fine di potervi operare*/
USE AeP_webshop;

CREATE TABLE fornitori(
    pIva varchar(11) primary key NOT NULL,
    email varchar(80) NOT NULL UNIQUE,
    pswd varchar(128) NOT NULL,
    ragioneSociale varchar(100) NOT NULL,
    dirigente varchar (100) NOT NULL,
    sede varchar(100),
    sitoWeb varchar(100)
);

CREATE TABLE prodotti(
    id integer(10) primary key NOT NULL AUTO_INCREMENT,
    fkPIvaFornitore varchar(11) NOT NULL,
    nome varchar(100) NOT NULL,
    descrizione varchar(250),
    costo float NOT NULL,
    quantita integer(10) DEFAULT 1,
    FOREIGN KEY (fkPIvaFornitore) REFERENCES fornitori(pIva)
);

CREATE TABLE clienti(
    username varchar(50) primary key NOT NULL,
    email varchar(80) NOT NULL UNIQUE,
    pswd varchar(128) NOT NULL,
    nome varChar(50) NOT NULL,
    cognome varChar(50) NOT NULL,
    residenza varchar(100) NOT NULL
);

CREATE TABLE fatture(
    id integer(10) primary key NOT NULL AUTO_INCREMENT,
    fkIntestatario varchar(50) NOT NULL,
    fkIdProdotto integer(10) NOT NULL,
    fkPIvaFornitore varchar(11) NOT NULL,
    emissione date NOT NULL,
    quantitaProdotto integer(5) DEFAULT 1,
    importo float NOT NULL CHECK(importo > 0),
    FOREIGN KEY (fkIntestatario) REFERENCES clienti(username),
    FOREIGN KEY (fkIdProdotto) REFERENCES prodotti(id),
    FOREIGN KEY (fkPIvaFornitore) REFERENCES fornitori(pIva)
);