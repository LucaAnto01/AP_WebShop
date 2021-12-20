<?php 

    /**Includo le librerie */
    include "function/DB_connection.php";
    include "function/login.php";
    include "function/logout.php";
    include "function/registrazione.php";
    include "function/load_homepage.php";
    include "function/modifica.php";
    include "function/effettua_acquisto.php";

    if (!isset($_SESSION['email'])) //Se non ci sono utenti loggati
        session_start();

    /**Visualizzo l'azione richiesta dall'utente */
    $azioneRichiesta = $_REQUEST['azione'];

    /**Gestisco le richieste dell'utente 
     * per una questione di sicurezza alle password viene applicato un hash
    */
    switch($azioneRichiesta)
    {
        case "login": login($_POST["email"], hash("sha512", $_POST["password"]));
            break;
            
        case "logout": logout();
            break;
            
        case "registrazione": registrazione($_REQUEST['tipoRegistrazione'], strtolower($_POST['email']), hash("sha512", $_POST["password"]));
            break;
        
        case "tipo_account": getTipoUtente();
            break;
            
        case "home_page": loadHomePage();
            break;

        case "prepara_modifica": preparaModifica($_REQUEST['idprodotto']);
            break;

        case "modifica_prodotto": modificaProdotto($_REQUEST['modCampo'], $_REQUEST['modValore']);
            break;
        
        case "prepara_acquisto": preparaAcquisto($_REQUEST['idprodotto'], $_REQUEST['costo']);
            break;

        case "acquisto": effettuaAcquisto($_REQUEST['quantita']);
            break;
    
        default: echo("error_0");
    }

?>