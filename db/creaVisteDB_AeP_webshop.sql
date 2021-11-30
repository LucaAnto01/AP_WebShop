SELECT c.email AS email, c.nome AS nome, c.cognome AS cognome, c.username AS username, c.residenza AS residenza, p.id AS idprodotto, p.nome AS prodotto /*TODO: AGGIUGNI L'IMPORTO DELLA FATTURA*/
FROM clienti c, prodotti p, fatture f
WHERE c.username = f.fkIntestatario, p.id = f.fkIdProdotto;