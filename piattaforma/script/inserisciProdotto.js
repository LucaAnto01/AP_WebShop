var xmlhttp = new XMLHttpRequest(); //Variabile gestione interrogazioni client-server
/**Funzioni relative all'inserimento di un prodotto all'interno del DB*/

 /**Funzione adibita all'inserimento di un prodotto nel DB */
 function inserisciProdotto()
 {
     xmlhttp.onreadystatechange =
     function() 
     {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
         {
 
            if(xmlhttp.responseText == "error_0")
                alert("Errore nella ricerca dell'azione"); 

            if(xmlhttp.responseText == "error_8") 
                alert("Impossibile inserire il prodotto"); 

            else if(xmlhttp.responseText == "all_ok")
            {
                alert("Inserimento di " + nome + " avvenuto con successo!");
                window.location.href = "../pages/home.html";
            }

         }
     }
     
     var nome = document.getElementById("nome").value;
     var descrizione = document.getElementById("descrizione").value;
     var costo = document.getElementById("costo").value;
     var quantita = document.getElementById("quantita").value;
     xmlhttp.open("POST", "../library/controller.php", true);
     xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     //Invocazione AJAX e passaggio di parametri
     xmlhttp.send("azione=inserisci&nome=" + nome + "&descrizione=" + descrizione + "&costo=" + costo + "&quantita=" + quantita);
     
 }