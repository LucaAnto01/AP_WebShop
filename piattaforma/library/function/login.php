<?php 
    /*TODO:setta una variabile a o "cliente" o "fornitore" e mettila anche in sessione in base al login*/

    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);
    
    /**Funzione che cerca la corrispondenza tra email e password all'interno del DB dedicato ai clienti
     * @return int [1 -> trovato | -1 -> non trovato]
     */
    function loginClienti($email, $passwordIn)
    {
        //Protezione da injection
        $query = $GLOBALS['connect']->prepare("
                SELECT *
                FROM clienti
                WHERE email = '".$email."' AND pswd = ?
            ");

        $password = mysqli_real_escape_string($GLOBALS['connect'], $passwordIn);
        $query->bind_param('s', $password);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) 
            return 1; //Corrispondenza trovata

        return -1; //Nessuna corrispondenza trovata
    }

    /**Funzione che cerca la corrispondenza tra email e password all'interno del DB dedicato ai fornitori
     * @return int [1 -> trovato | -1 -> non trovato]
     */
    function loginFornitori($email, $passwordIn)
    {
        //Protezione da injection
        $query = $GLOBALS['connect']->prepare("
                SELECT *
                FROM fornitori
                WHERE email = '".$email."' AND pswd = ?
            ");

        $password = mysqli_real_escape_string($GLOBALS['connect'], $passwordIn);
        $query->bind_param('s', $password);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) 
            return 1; //Corrispondenza trovata

        return -1; //Nessuna corrispondenza trovata
    }

    function login()
    {

        //Valori inseriti dall'utente
        $emailReq = $_REQUEST["email"];
        $passwordReq = $_REQUEST["password"];

        if ((isset($_SESSION['email'])) && ($_SESSION['email'] == $emailReq))
        {
            echo "Sei già loggato, verrai rendirizzato alla pagina del tuo profilo tra 5 secondi...";
            header("refresh:5; url=../index.html"); //Rendirizzamento alla home page in 5 secondi TODO: cambia l'indirizzo con quello della pagina del profilo
            exit;
        }
        
        /**TODO: testa se funziona e guarda all'inizio cosa fare */
        if((loginClienti($emailReq, $passwordReq) > 0) || (loginFornitori($emailReq, $passwordReq) > 0))
        {
            $_SESSION['email'] = $emailReq;
            echo "Trovato!";
        }
        
        else
            echo "Non trovato!";

        /*else 
        {
            //REVIEW: facciamo altro o diamo un messaggio d'errore??? 
            header('Location: Registrazione.html');
        }*/        

    }
?>