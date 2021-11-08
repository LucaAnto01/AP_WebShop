/*Creo il database assegnandoli il nome A&P*/
CREATE DATABASE  'A&P';

/*Seleziono il database precedentemente creato al fine di potervi operare*/
USE 'A&P';

CREATE TABLE fornitori(
    pIva varchar(11) primary key NOT NULL,
    email varchar(80) NOT NULL UNIQUE,
    pswd varchar(256) NOT NULL,
    ragioneSociale varchar(100) NOT NULL,
    sede varchar(100),
    sitoWeb varchar(100),
);

CREATE TABLE prodotti(
    codice integer(10) primary key NOT NULL AUTO_INCREMENT,
    fkPIva varchar(11) NOT NULL,
    nome varchar(100) NOT NULL,
    descrizione varchar(250),
    FOREIGN KEY (fkIdFornitore) REFERENCES AccountCategories(code)
);

CREATE TABLE utenti(
    username varchar(50) primary key NOT NULL,
    email varchar(80) NOT NULL UNIQUE,
    pswd varchar(256) NOT NULL,
    residenza varchar(100), NOT NULL
);

CREATE TABLE fattura(
    id integer(10) primary key NOT NULL AUTO_INCREMENT,
    fkIntestatario varchar(50) NOT NULL,
    fkCodiceProdotto integer(10) NOT NULL,
    emissione date NOT NULL,
    FOREIGN KEY (fkIntestatario) REFERENCES utenti(username),
    FOREIGN KEY (fkCodiceProdotto) REFERENCES prodotti(codice)
);