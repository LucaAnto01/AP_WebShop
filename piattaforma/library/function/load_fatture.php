<?php

    /**Gestione ottenimento delle fatture di clienti e fornitori */
    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    /**Funzione adibita ad ottenere i dati delle fatture di un determinato cliente o fornitore
     * @param stringa campo, stringa valoreSess -> campo da controllare
     */
    function getFatture($campo, $valSess)
    {
        $queryFatture = "SELECT f.fkIntestatario, f.fkPIvaFornitore, f.fkIdProdotto, f.emissione, f.quantitaProdotto, f.importo
                         FROM fatture f
                         WHERE f.".$campo." = '".$_SESSION[$valSess]."'";
        $result = $GLOBALS['connect']->query($queryFatture);

        //Controllo di aver effettivamente avuto dei risultati
        if($result->num_rows > 0) 
        {
            //Array che conterrà i risultati della query
            $fattura = Array();

            //Faccio un ciclo in cui scorro tutte le righe ottenute come risultato e le inserisco in un array
            while($row = $result->fetch_assoc()) 
                array_push($fattura, $row);

            //Converto in json l'array risultato ottenuto al fine di poterlo gestire in ajax
            echo json_encode($fattura);

        }

        else
            echo("error_11");
    }

    /**Controllo l'utente loggato per visualizzarne le rispettive fatture */
    function loadFatture()
    {
        //Controllo che l'utente sia loggato
        if(isset($_SESSION['email']))
        {
            $tipoAccount = $_SESSION['tipoAccount'];

            if($tipoAccount == "clienti")
                getFatture("fkIntestatario", "username");
                
            
            if($tipoAccount == "fornitori")
                getFatture("fkPIvaFornitore", "pIva");
        }
                
        //Nel caso in cui l'utente non sia loggato, o la sessione è scaduta, lo faccio riloggare
        else
            echo("error_l");
    }
?>