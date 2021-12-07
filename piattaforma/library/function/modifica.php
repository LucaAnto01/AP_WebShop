<?php

    $connect = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $GLOBALS['db']);

    /**Funzione adibita a settare in sessione l'id del prodotto da modificare
     * @param stringa idProdotto
     */
    function preparaModifica($idProd)
    {
        $_SESSION['idProdotto'] = $idProd;
    }

    /**Funzione adibita a modificare un determinato campo con un nuovo valore
     * @param stringa campo, stringa nuovo valore
     */
    function modificaProdotto($campo, $valore)
    {
        //Controllo che l'utente sia loggato
        if(isset($_SESSION['email']))
        {
            $queryModifica = "UPDATE prodotti
                              SET '".$campo."' = '".$valore."' 
                              WHERE id = '".$_SESSION['idProdotto']."'";  

            if($GLOBALS['connect']->query($queryModifica))
                echo("Funziona"); 
        }

        //Nel caso in cui l'utente non sia loggato, o la sessione è scaduta, lo faccio riloggare
        else
        {
            echo("<script type='text/javascript'>alert('Devi prima effettuare il login!');</script>");
            header("refresh:0.1; url=../pages/login.html");
        }
    }
?>