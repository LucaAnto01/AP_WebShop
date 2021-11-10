<?php 

    /**Includo le librerie */
    include "function/login.php";
    include "function/logout.php";
    include "function/registrazione.php";

    /**Visualizzo l'azione richiesta dall'utente */
    $azioneRichiesta = $_REQUEST['azione'];

    /**Gestisco le richieste dell'utente */
    switch($azioneRichiesta)
    {
        case "login": login($_POST["email"], hash("sha512", $_POST["password"]);
        
        default: echo("error_0");
    }

?>