<?php 
    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    /**Funzione adibita al controllo dell'email, se già presente nel DB annulla la registrazione
     * @param string email
     * @return int [1 -> email non presente | -1 -> email presente]
     */
    function checkEmail($emailIn)
    {
        $queryCheckEmail = "SELECT * FROM clienti, fornitori WHERE clienti.email = '".$emailIn."' OR fornitori.email = '".$emailIn."'";
        $result = $GLOBALS['connect']->query($queryCheckEmail);

        if ($result->num_rows > 0)
            return -1; //Email presente

        else
            return 1; //Email non presente
    }

    /**Funzione adibita alla registrazione di un cliente e quindi al rispettivo inserimento nel DB */
    function registrazioneCliente($emailIn, $passwordIn)
    {
        $nuovoFornitore = array('username' => strtolower($_POST['username']), //Rendo miuscolo tutto l'username
            'email' => $emailIn, //Rendo minuscola tutta l'email
            'password' => $passwordIn,
            'nome' => $_POST['nome'],
            'cognome' => $_POST['cognome'],
            'residenza' => $_POST['residenza']
        );

        $queryInserisciCliente = $GLOBALS['connect']->prepare("insert into clienti values('".$nuovoFornitore['username']."', '".$nuovoFornitore['email']."', ?, '".$nuovoFornitore['nome']."', '".$nuovoFornitore['cognome']."', '".$nuovoFornitore['residenza']."')");

        $password = mysqli_real_escape_string($GLOBALS['connect'], $nuovoFornitore['password']);
        $queryInserisciCliente->bind_param('s', $password);

        if($queryInserisciCliente->execute() == false)
        {
            echo("error_3");
            exit;
        }

        else
        {
            $nuovoUtenteJson = json_encode($nuovoFornitore); //TODO: se fai in ajax poi sistema la questione del formato json
        
            echo("Account ".$nuovoFornitore['username']." registrato con successo<br>");     
            echo("Nuovo cliente creato: ".json_encode($nuovoFornitore));        
        }
    }

    /**Funzione adibita alla registrazione di un fornitore e quindi al rispettivo inserimento nel DB */
    function registrazioneFornitore($emailIn, $passwordIn)
    {
        $nuovoFornitore = array('pIva' => $_POST['pIva'],
            'email' => $emailIn, //Rendo minuscola tutta l'email
            'password' => $passwordIn,
            'ragioneSociale' => $_POST['ragioneSociale'],
            'dirigente' => $_POST['dirigente'],
            'sede' => $_POST['sede'],
            'sitoWeb' => $_POST['sitoWeb']
        );

        $queryInserisciFornitore = $GLOBALS['connect']->prepare("insert into fornitori values('".$nuovoFornitore['pIva']."', '".$nuovoFornitore['email']."', ?, '".$nuovoFornitore['ragioneSociale']."', '".$nuovoFornitore['dirigente']."', '".$nuovoFornitore['sede']."', '".$nuovoFornitore['sitoWeb']."')");

        $password = mysqli_real_escape_string($GLOBALS['connect'], $nuovoFornitore['password']);
        $queryInserisciFornitore->bind_param('s', $password);

        if($queryInserisciFornitore->execute() == false)
        {
            echo("error_4");
            exit;
        }

        else
        {
            $nuovoUtenteJson = json_encode($nuovoFornitore); //TODO: se fai in ajax poi sistema la questione del formato json
        
            echo("Account ".$nuovoFornitore['ragioneSociale']." registrato con successo<br>");     
            echo("Nuovo fornitore creato: ".json_encode($nuovoFornitore));        
        }
    }

    /**Funzione adibita all'esecuzione della registrazione. A seconda del tipo vengono seguite procedure differenti
     * @param string tipo di registrazione
     */
    function registrazione($tipoRegistrazione, $emailPst, $passwordPst)
    {
        if(checkEmail($_POST['email']) < 0)
        {
            echo("error_1");
            exit;
        }

        if($tipoRegistrazione == "cliente")
            registrazioneCliente($emailPst, $passwordPst);

        else if($tipoRegistrazione == "fornitore")
            registrazioneFornitore($emailPst, $passwordPst);

        else
        {
            echo("error_2");
            exit;
        }
            
        header("refresh:5; url=../pages/login.html"); //Rendirizzamento alla pagina di login in 5 secondi
    }

?>