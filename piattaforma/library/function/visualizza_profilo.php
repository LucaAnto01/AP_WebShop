<?php
    //TODO: fai tutto. Ma prima fai la parte relativa agli acquisti dei clienti. Questa lasciala come ultima parte da fare
    /**Parte dinamica della pagina relativa al profilo del cliente
     * - clienti: visualizzano gli acquisti fatti
     * - fornitori: visualizzano le vendite fatte
     */
    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    function getAcquisti()
    {

    }

    function getVendite()
    {
        
    }

    function visualizzaProfilo()
    {
        
        //Controllo che l'utente sia loggato
        if(isset($_SESSION['email']))
        {
            $tipoAccount = $_SESSION['tipoAccount'];
        }

        //Nel caso in cui l'utente non sia loggato, o la sessione è scaduta, lo faccio riloggare
        else
        {
            echo("<script type='text/javascript'>alert('Devi prima effettuare il login!');</script>");
            header("refresh:5; url=../pages/login.html");
        }
        
    }

?>