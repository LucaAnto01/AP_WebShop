<?php 
    /*TODO: differenzia il login in base a se è un fornitore o un cliente
            o con la check box al login o facendo due query di prova separate e a seconda di quella che da responso
            positivo setta una variabile a o "cliente" o "fornitore" e mettila anche in sessione*/
    function login()
    {
        if (!isset($_SESSION['email'])) //Se non ci sono utenti loggati
            session_start();

        //Se l'utente non è loggato avvio la sessione
        session_start();

        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "AeP_webshop";
        
        $connect = new mysqli($host, $user, $password, $db); //Preparo la connessione al DB

        if ($connect->connect_error) 
            die("Errore connessione: " . $connect->connect_error);

        if($connect->select_db("AeP_webshop") == 0) 
        {
            echo("Il database AeP_webshop non esiste");
            exit;
        }

        //Valori inseriti dall'utente
        $usernameUtente = $_REQUEST["email"];
        $passwordUtente = $_REQUEST["password"];

        if ((isset($_SESSION['email'])) && ($_SESSION['email'] == $usernameUtente))
        {
            echo "Sei già loggato, verrai rendirizzato alla pagina del tuo profilo tra 5 secondi...";
            header("refresh:5; url=../index.html"); //Rendirizzamento alla home page in 5 secondi TODO: cambia l'indirizzo con quello della pagina del profilo
            exit;
        }
        
        //Query per cercare l'utente
        //$sql = "SELECT * FROM account where user = '".$usernameUtente."' AND password ='".$passwordUtente."' "; TODO: fai la query
	    $result = $connect->query($sql);

        if ($result->num_rows > 0) 
        {

            $_SESSION['username'] = $usernameUtente;
            //TODO: reindirizza l'utente alla pagina principale o decidi cosa fare
            /*echo "<table><th>Nome</th><th>Cognome</th><th>Username</th><th>Mail</th><th>Data</th>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>". $row["nome"]. "</td><td>". $row["cognome"]. "</td><td>" . $row["user"]. "</td><td>". $row["email"]. "</td><td>". $row["data_registrazione"]. "</td></tr>";
            }
            echo "</table>";*/

        } 

        else 
        {
            //REVIEW: facciamo altro o diamo un messaggio d'errore??? 
            header('Location: Registrazione.html');
        }        

    }
?>