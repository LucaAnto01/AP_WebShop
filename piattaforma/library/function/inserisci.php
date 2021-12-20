<?php

    /**Gestione dell'inserimento di un nuovo prodotto all'interno del DB da parte di un fornitore */
    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);  
    
    /**Funzione adibita all'inserimento di un prodotto all'interno del DB
     * @param stringa nome, stringa descrizione, numero costo, numero intero quantita
     */
    function inserisciProdotto($nome, $descrizione, $costo, $quantita)
    {
        //Controllo che l'utente sia loggato e per sicurezza anche che sia un fornitore
        if((isset($_SESSION['email'])) && ($_SESSION['tipoAccount'] == "fornitori"))
        {
            $queryInserimento = "INSERT INTO prodotti(fkPIvaFornitore, nome, descrizione, costo, quantita) VALUES('".$_SESSION['pIva']."', '".$nome."', '".$descrizione."', '".$costo."', '".$quantita."')";

            if($GLOBALS['connect']->query($queryInserimento))
                    echo("all_ok");
            
            else
                echo("error_8");
        }

        //Nel caso in cui l'utente non sia loggato, o la sessione è scaduta, lo faccio riloggare
        else
        {
            echo("<script type='text/javascript'>alert('Devi prima effettuare il login!');</script>");
            header("refresh:0.1; url=../pages/login.html");
        }
    }
?>