<?php

    //TODO: facciamo anche il carrello ???
    /**Parte dinamica della pagina iniziale del sito, due opzioni di aricamento a seoconda del tipo di account:
     * - clienti: visualizzazione di tutti i prodotti disponibili, possibilità di effettuare una ricerca ed ordinare i prodotti.
     * - fornitori: visualizzo tutti i prodotti posseduti con la possibilità di aggiungerne, rimuoverne e 
     *              modificare qualsiasi campo (eccetto l'ID). */

    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    /**Funzione adibita all'ottenimento dei dati contenuti nella vista:
     *  -vetrina_prodotti: se è loggato un utente o nel magazzino dei produttori
     * TODO: decidi se restituire oppure no il risultato ottenuto e fare nell'altra funzione o qui l'encode
    */
    function getVetrinaProdotti()
    {
        $queryVetrinaProdotti = "SELECT prodotto, descrizione, costo, quantita, fornitore 
                                 FROM vetrina_prodotti";
        
        $result = $GLOBALS['connect']->query($queryVetrinaProdotti);

        //Controllo di aver effettivamente avuto dei risultati
        if ($result->num_rows > 0) 
        {
            //Array che conterrà i risultati della query
            $vetrina = Array();

            //Faccio un ciclo in cui scorro tutte le righe ottenute come risultato e le inserisco in un array
            while($row = $result->fetch_assoc()) 
                array_push($vetrina, $row);

            //Converto in json l'array risultato ottenuto al fine di poterlo gestire in ajax
            echo json_encode($vetrina);

        }

        else
            echo("error_5");

    }

    function getProdotti()
    {
        $queryMagazzini = "SELECT m.* 
                           FROM magazzini m, fornitori f
                           WHERE m.PIva = f.pIva AND f.email = '".$_SESSION['email']."'";
        
        $result = $GLOBALS['connect']->query($queryMagazzini);

        //Controllo di aver effettivamente avuto dei risultati
        if ($result->num_rows > 0) 
        {
            //Array che conterrà i risultati della query
            $magazzino = Array();

            //Faccio un ciclo in cui scorro tutte le righe ottenute come risultato e le inserisco in un array
            while($row = $result->fetch_assoc()) 
                array_push($magazzino, $row);

            //Converto in json l'array risultato ottenuto al fine di poterlo gestire in ajax
            echo json_encode($magazzino);

        }

        else
            echo("error_6");

    }

    /**Funzione adibita all'ottenimento dinamico dei dati utili a comporre la home page */
    function loadHomePage()
    {
        //Controllo che l'utente sia loggato
        if(isset($_SESSION['email']))
        {
            $tipoAccount = $_SESSION['tipoAccount'];

            if($tipoAccount == "clienti")
            {
                //TODO: bottone per l'acquisto e alert con richiesta di conferma d'acquisto
                /*$vetrina = */getVetrinaProdotti();
            }
                
            
            if($tipoAccount == "fornitori")
            {
                getProdotti();
                //TODO: bottone per l'acquisto e alert con richiesta di conferma d'acquisto
            }  
        }
              
         //Nel caso in cui l'utente non sia loggato, o la sessione è scaduta, lo faccio riloggare
         else
         {
             echo("<script type='text/javascript'>alert('Devi prima effettuare il login!');</script>");
             header("refresh:0.1; url=../pages/login.html");
         }

    }
?>