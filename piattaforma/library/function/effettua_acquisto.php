<?php

    /**Gestione degli acquisti da parte di un cliente, sulla base del codice del prodotto e della quantità ordinata ne
     * verifico la disponibilità
     * - nel caso fosse possibile effettuo l'ordine, andando quindi ad aggiornare il
     *   valore della quantità del prodotto e generando una fattura per l'acquisto effettuato
     * - se non fosse possibile si genera un codice d'errore
     */
    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);


    /**Funzione adibita a settare in sessione l'id del prodotto da acquistare ed il relativo presso
     * @param stringa idProdotto, numero intero costo
     */
    function preparaAcquisto($idProdotto, $costo)
    {
        $_SESSION['idProdotto'] = $idProdotto;
        $_SESSION['costo'] = $costo;
    }

    /**Funzione adibita all'acquisto di un determinato prodotto sulla base del suo codice da parte di un cliente
     * @param numero intero quantita
     */
    function effettuaAcquisto($quantita)
    {
        //Controllo che l'utente sia loggato e per sicurezza e coerenza che sia un cliente
        if((isset($_SESSION['email'])) && ($_SESSION['tipoAccount'] == "clienti"))
        {
            //Verifico che sia possibile effettuare l'acquisto
            $queryAcquisto = "SELECT *
                              FROM vetrina_prodotti v
                              WHERE v.id_prodotto = '".$_SESSION['idProdotto']."'  AND v.quantita >= '".$quantita."'";
        
            $result = $GLOBALS['connect']->query($queryAcquisto);

            if($result->num_rows > 0) 
            {
                $pIvaFornitore;

                while($row = $result->fetch_assoc()) //C'è un solo elemento 
                    $pIvaFornitore = $row['piva_fornitore']; //Ricavo il numero della partita iva del fornitore al fine di creare la fattura

                $importo = $_SESSION['costo'] * $quantita;

                //Genero la fattura a seguito dell'acquisto avvenuto
                $queryFattura = "INSERT INTO fatture(fkIntestatario, fkIdProdotto, fkPIvaFornitore, emissione, quantitaProdotto, importo) 
                                        VALUES('".$_SESSION['username']."', '".$_SESSION['idProdotto']."', '".$pIvaFornitore."', '".date("Y/m/d")."', '".$quantita."', '".$importo."')";
                
                // if($GLOBALS['connect']->query($queryFattura))
                //     echo("Funziona");
                
                //Aggiorno la quantità di prodotto disponibile a seguito dell'acquisto
                $queryUpdateQuantita = "UPDATE prodotti
                                        SET quantita = quantita - ".$quantita." 
                                        WHERE id = '".$_SESSION['idProdotto']."'";

                if(($GLOBALS['connect']->query($queryUpdateQuantita)) && ($GLOBALS['connect']->query($queryFattura)))
                    echo("all_ok");
            }
            
            else
                echo("error_7");
        }

        //Nel caso in cui l'utente non sia loggato, o la sessione è scaduta, lo faccio riloggare
        else
        {
            echo("<script type='text/javascript'>alert('Devi prima effettuare il login!');</script>");
            header("refresh:0.1; url=../pages/login.html");
        }
    }
?>