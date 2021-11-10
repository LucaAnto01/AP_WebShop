<?php 

    include "function/login.php";
    include "function/logout.php";
    include "function/registrazione.php";

    /**Visualizzo l'azione richiesta dall'utente */
    $azioneRichiesta = $_REQUEST['azione'];

    /**Gestisco le richieste dell'utente */
    switch($azioneRichiesta)
    {   
        default: echo("error_0");
    }

?>