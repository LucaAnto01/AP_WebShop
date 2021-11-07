/*Creo il database assegnandoli il nome A&P*/
CREATE DATABASE  'A&P';

/*Seleziono il database precedentemente creato al fine di potervi operare*/
USE 'A&P';

CREATE TABLE fornitori(
    id varchar(10) primary key NOT NULL AUTO_INCREMENT,
    email varchar(80) NOT NULL UNIQUE,
    pswd varchar(256) NOT NULL,
    ragioneSociale varchar(100) NOT NULL,
    pIva varchar(11) NOT NULL,
    sede varchar(100),
    sitoWeb varchar(100),
);

CREATE TABLE prodotti(
    codice varchar(10) primary key NOT NULL AUTO_INCREMENT,
    fkIdFornitore varchar(10),
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