<?php 
    //TODO: quando farai la registrazione controlla che la mail non sia già presente NE nei fornitori NE nei clienti
    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    /**Funzione adibita all'esecuzione della registrazione. A seconda del tipo vengono seguite procedure differenti
     * @param string tipo di registrazione
     */
    function registrazione($tipoRegistrazione)
    {
    }

?>