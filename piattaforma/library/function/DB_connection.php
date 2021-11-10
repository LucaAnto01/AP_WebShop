<?php 
    /**File contenente tutte le specifiche per la connessione al DB (e utile per eventuali test sulla connessione al DB)*/

    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "AeP_webshop";

    //$connect = new mysqli($GLOBALS["host"], $GLOBALS["user"], $GLOBALS["password"], $GLOBALS["db"]); //Connessione al DB TODO: eventualmente cancella questa riga
    $connect = new mysqli($host, $user, $password, $db);

    /**Test connessione al DB */
    if ($connect->connect_error) 
        die("Errore connessione: " . $connect->connect_error);

    /**Controllo esistenza del DB */
    if($connect->select_db("AeP_webshop") == 0) 
    {
        echo("Il database AeP_webshop non esiste");
        exit;
    }

    $connect->close();
?>