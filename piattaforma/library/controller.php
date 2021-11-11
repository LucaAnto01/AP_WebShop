<?php 

    /**Includo le librerie */
    include "function/DB_connection.php";
    include "function/login.php";
    include "function/logout.php";
    include "function/registrazione.php";

    if (!isset($_SESSION['email'])) //Se non ci sono utenti loggati
        session_start();

    /**Visualizzo l'azione richiesta dall'utente */
    $azioneRichiesta = $_REQUEST['azione'];

    /**Gestisco le richieste dell'utente */
    switch($azioneRichiesta)
    {
        case "login": login($_POST["email"], hash("sha512", $_POST["password"]));
            break;
        
        case "registrazione": registrazione($_REQUEST['tipoRegistrazione']);
            break;
        
        default: echo("error_0");
    }

?>