<?php 
    function accesso()
    {
        if (!isset($_SESSION['username'])) //Controllo che la sessione sia attiva e quindi che l'utente sia loggato
            session_start();
    }
?>