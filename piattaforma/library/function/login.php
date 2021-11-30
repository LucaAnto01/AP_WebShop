<?php 

    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    /**Funzione che cerca la corrispondenza tra email e password all'interno del DB nelle tabelle clienti | fornitori
     * @param string email, string password(con sha512), string tabella da controllare
     * @return int [1 -> trovato | -1 -> non trovato]
     */
    function checkLogin($emailIn, $passwordIn, $tabellaCheck)
    {
        //Protezione da injection
        $query = $GLOBALS['connect']->prepare("
                SELECT *
                FROM ".$tabellaCheck."
                WHERE email = '".$emailIn."' AND pswd = ?
            ");

        $password = mysqli_real_escape_string($GLOBALS['connect'], $passwordIn);
        $query->bind_param('s', $password);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0)
        {
            $_SESSION['email'] = $emailIn;
            return 1; //Corrispondenza trovata
        } 

        return -1; //Nessuna corrispondenza trovata
    }

    /**Funzione adibita all'esecuzione del login
     * @param string email, stgring password(con sha512)
     */
    function login($emailReq, $passwordReq)
    {     
        if ((isset($_SESSION['email'])) && ($_SESSION['email'] == $emailReq))
        {
            echo "Sei già loggato, verrai rendirizzato alla pagina del tuo profilo tra 5 secondi...";
            header("refresh:5; url=../index.html"); //Rendirizzamento alla home page in 5 secondi TODO: cambia l'indirizzo con quello della pagina del profilo
            exit;
        }
        
        if(checkLogin($emailReq, $passwordReq, "clienti") > 0) //Controllo se l'utente che ha effettuato il login è un cliente
        {
            $_SESSION['tipoAccount'] = "clienti";
            echo "Trovato!"; //REVIEW: per test, poi rimuovilo
        }

        else if (checkLogin($emailReq, $passwordReq, "fornitori") > 0) //Controllo se l'utente che ha effettuato il login è un fornitore
        {
            $_SESSION['tipoAccount'] = "fornitori";
            echo "Trovato!"; //REVIEW: per test, poi rimuovilo
        }
        
        else //REVIEW: facciamo altro o diamo un messaggio d'errore??? 
            echo "Non trovato!"; //TODO: poi cambialo con un header verso la home page
        
        $GLOBALS['connect']->close(); //Chiudo la connessione al DB
    }

?>