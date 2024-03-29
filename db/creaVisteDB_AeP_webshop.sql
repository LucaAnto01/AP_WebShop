/*Vista che forisce la lista dei prodotti disponibili associati ai rispettivi venditori*/
CREATE VIEW vetrina_prodotti AS (SELECT p.nome AS prodotto, p.descrizione AS descrizione, p.costo AS costo, p.quantita AS quantita, f.ragioneSociale AS fornitore, p.id AS id_prodotto, f.pIva AS pIva_fornitore
                                    FROM fornitori f, prodotti p
                                    WHERE f.pIva = p.fkPIvaFornitore AND p.quantita > 0
                                    ORDER BY p.nome);

/*Vista riservata ai fornitori, forisce la lista dei prodotti associati alla partita IVA del fornitore*/
CREATE VIEW magazzini AS (SELECT f.pIva AS PIva, p.id AS id_prodotto, p.nome AS prodotto, p.descrizione AS descrizione, p.costo AS costo, p.quantita AS quantita
                          FROM fornitori f, prodotti p
                          WHERE f.pIva = p.fkPIvaFornitore
                          ORDER BY f.pIva);