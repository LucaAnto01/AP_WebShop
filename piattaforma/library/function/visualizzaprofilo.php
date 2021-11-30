<?php

    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    function visualizzaProfilo()
    {
        //Nel caso in cui l'utente non sia loggato, o la sessione è scaduta, lo faccio riloggare
        if(!isset($_SESSION['email']))
            header("refresh:5; url=../../pages/registrazione.html");

        //TODO: fai tutto
        
    }

?>