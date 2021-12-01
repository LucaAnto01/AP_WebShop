<?php

    /**Gestione degli acquisti da parte di un cliente, sulla base del codice del prodotto e della quantità ordinata ne
     * verifico la disponibilità
     * - nel caso fosse possibile effettuo l'ordine, andando quindi ad aggiornare il
     *   valore della quantità del prodotto e generando una fattura per l'acquisto effettuato
     * - se non fosse possibile si genera un codice d'errore
     */
    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);
    /**Funzione adibita all'acquisto di un determinato prodotto sulla base del suo codice da parte di un cliente
     * @param inumero intero idProdotto, numero intero quantita
     */
    function effettuaAcquisto($idProdotto, $quantita)
    {
        //Controllo che l'utente sia loggato e per sicurezza e coerenza che sia un cliente
        if((isset($_SESSION['email'])) && ($_SESSION['tipoAccount'] == "clienti"))
        {
            //Verifico che sia possibile effettuare l'acquisto
            $queryAcquisto = "SELECT *
                                     FROM vetrina_prodotti v
                                     WHERE v.id_prodotto = '".$idProdotto."'  AND v.quantita >= '".$quantita."'";
        
            $result = $GLOBALS['connect']->query($queryAcquisto);

            if($result->num_rows > 0) 
            {
                //TODO: genera la fattura e diminuisci la quantità del prodotto acquistato
                echo("Funziona");
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