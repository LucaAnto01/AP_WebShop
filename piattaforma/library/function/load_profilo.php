<?php

    /**Funzioni adibite all'ottenimento delle informazioni di un cliente o fornitore */
    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    /**Funzione adibita all'ottenimento delle informazioni di un cliente */
    function getClienteInfo()
    {
        $queryInfoCliente = "SELECT c.username, c.email, c.nome, c.cognome, c.residenza
                             FROM clienti c
                             WHERE c.username = '".$_SESSION['username']."' AND c.email = '".$_SESSION['email']."'";
        $result = $GLOBALS['connect']->query($queryInfoCliente);

        //Controllo di aver effettivamente avuto dei risultati
        if($result->num_rows > 0) 
        {
            //Array che conterrà i risultati della query
            $infoCliente = Array();

            //Faccio un ciclo in cui scorro tutte le righe ottenute come risultato e le inserisco in un array
            while($row = $result->fetch_assoc()) 
                array_push($infoCliente, $row);

            //Converto in json l'array risultato ottenuto al fine di poterlo gestire in ajax
            echo json_encode($infoCliente);

        }

        else
            echo("error_9");
    }

    /**Funzione adibita all'ottenimento delle informazioni di un fornitore */
    function getFornitoreInfo()
    {
        $queryInfoFornitore = "SELECT f.ragioneSociale, f.email, f.sede, f.dirigente, f.sitoWeb, f.pIva
                               FROM fornitori f
                               WHERE f.pIva = '".$_SESSION['pIva']."' AND f.email = '".$_SESSION['email']."'";
        $result = $GLOBALS['connect']->query($queryInfoFornitore);

        //Controllo di aver effettivamente avuto dei risultati
        if($result->num_rows > 0) 
        {
            //Array che conterrà i risultati della query
            $infoFornitore = Array();

            //Faccio un ciclo in cui scorro tutte le righe ottenute come risultato e le inserisco in un array
            while($row = $result->fetch_assoc()) 
                array_push($infoFornitore, $row);

            //Converto in json l'array risultato ottenuto al fine di poterlo gestire in ajax
            echo json_encode($infoFornitore);

        }

        else
            echo("error_10");
    }

    /**Funzione adibita al'ottenimento delle informazioni relative al profilo di un cliente o fornitore */
    function loadProfilo()
    {
        //Controllo che l'utente sia loggato
        if(isset($_SESSION['email']))
        {
            $tipoAccount = $_SESSION['tipoAccount'];

            if($tipoAccount == "clienti")
                getClienteInfo();
                
            
            if($tipoAccount == "fornitori")
                getFornitoreInfo();
        }
                
        //Nel caso in cui l'utente non sia loggato, o la sessione è scaduta, lo faccio riloggare
        else
            echo("error_l");
    }

?>