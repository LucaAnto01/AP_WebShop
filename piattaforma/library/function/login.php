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

        if($result->num_rows > 0)
        {
            $_SESSION['email'] = $emailIn;

            if($tabellaCheck == "clienti")
            {
                while($row = $result->fetch_assoc())
                    $_SESSION['username'] = $row['username']; //Dato utile per creare la fattura
            }

            if($tabellaCheck == "fornitori")
            {
                while($row = $result->fetch_assoc())
                    $_SESSION['pIva'] = $row['pIva']; //Dato utile per l'inserimento di un nuovo prodotto nel DB
            }
            return 1; //Corrispondenza trovata
        } 

        return -1; //Nessuna corrispondenza trovata
    }

    /**Funzione adibita all'esecuzione del login
     * @param string email, stgring password(con sha512)
     */
    function login($emailReq, $passwordReq)
    {     
        //Se l'utente è goà loggato lo rimando alla pagina del suo profilo
        if((isset($_SESSION['email'])) && ($_SESSION['email'] == $emailReq))
        {
            echo "Sei già loggato, verrai rendirizzato alla pagina del tuo profilo tra 5 secondi...";
            header("refresh:2.5; url=../pages/profilo.html");
            exit;
        }
        
        if(checkLogin($emailReq, $passwordReq, "clienti") > 0) //Controllo se l'utente che ha effettuato il login è un cliente
        {
            $_SESSION['tipoAccount'] = "clienti";
            header("refresh:0.1; url=../pages/home.html");
        }

        else if (checkLogin($emailReq, $passwordReq, "fornitori") > 0) //Controllo se l'utente che ha effettuato il login è un fornitore
        {
            $_SESSION['tipoAccount'] = "fornitori";
            header("refresh:0.1; url=../pages/home.html");
        }
        
        else
            header("refresh:0.1; url=../pages/home.html");
        
        $GLOBALS['connect']->close(); //Chiudo la connessione al DB
    }

?>