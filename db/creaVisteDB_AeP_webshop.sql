/*Vista riservata ai clienti, forisce la lista dei prodotti disponibili associati ai rispettivi venditori*/
CREATE VIEW vetrina_prodotti AS (SELECT p.nome AS prodotto, p.descrizione AS descrizione, p.costo AS costo, f.ragioneSociale AS fornitore
                                    FROM fornitori f, prodotti p
                                    WHERE f.pIva = p.fkPIvaFornitore AND p.quantita > 0
                                    ORDER BY p.nome);