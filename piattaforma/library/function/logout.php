<?php 

    /**Funzione per effettuare il logout */
    function logout()
    {
        session_destroy();
        header('Location: index.html');     
    }
    
?>