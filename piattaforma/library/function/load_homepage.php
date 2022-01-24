<?php

    /**Funzione di comodo lato client per la gestione del caricamento della home page dinamicamente
     * @return string tipoAccount
     */
    function getTipoUtente()
    {
        echo($_SESSION['tipoAccount']);
    }

    /**Parte dinamica della pagina iniziale del sito, due opzioni di aricamento a seoconda del tipo di account:
     * - clienti: visualizzazione di tutti i prodotti disponibili, possibilità di effettuare una ricerca ed ordinare i prodotti.
     * - fornitori: visualizzo tutti i prodotti posseduti con la possibilità di aggiungerne, rimuoverne e 
     *              modificare qualsiasi campo (eccetto l'ID). */

    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    /**Funzione adibita all'ottenimento dei dati contenuti nella vista:
     *  -vetrina_prodotti: se è loggato un utente o nel magazzino dei produttori
    */
    function getVetrinaProdotti()
    {
        $queryVetrinaProdotti = "SELECT prodotto, descrizione, costo, quantita, fornitore, id_prodotto 
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
        if($result->num_rows > 0) 
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
                getVetrinaProdotti();
                
            
            if($tipoAccount == "fornitori")
                getProdotti();
        }
              
         //Nel caso in cui l'utente non sia loggato, o la sessione è scaduta, lo faccio riloggare
        else
            echo("error_l");

    }
?>