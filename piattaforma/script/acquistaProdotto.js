var xmlhttp = new XMLHttpRequest(); //Variabile gestione interrogazioni client-server
/**Funzioni relative all'acquisto di un prodotto */

/**Funzione adibita alla preparazione dell'effetuazione di un acquisto
 * @param idprod, costo
 */
 function preparaAcquisto(idProd, costo)
 {
     document.getElementById("popupFrame").style.display = "inline";
 
     xmlhttp.onreadystatechange =
     function() 
     {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
         {
             if(xmlhttp.responseText == "error_0")
                 alert("Errore nella ricerca dell'azione");               
         }
     }
 
     xmlhttp.open("POST", "../library/controller.php", true);
     xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     //Invocazione AJAX e passaggio di parametri
     xmlhttp.send("azione=prepara_acquisto&idprodotto=" + idProd + "&costo=" + costo);
 }
 
 /**Funzione adibita all'effettuazione dell'acquisto di un prodotto in base alla quantità */
 function effettuaAcquisto()
 {
     xmlhttp.onreadystatechange =
     function() 
     {
         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
         {
 
             if(xmlhttp.responseText == "error_0")
                 alert("Errore nella ricerca dell'azione");  

             if(xmlhttp.responseText == "error_7")
                 alert("Quantita' inserita non valida"); //Nel caso in cui il cliente inserisca una quantità non valida 
                  
             else if(xmlhttp.responseText == "all_ok")
             {
                 alert("Acquisto effettuato con successo");
                 location.reload(); 
             }
                        
         }
     }
     
     var quantita = document.getElementById("quantita").value;
     xmlhttp.open("POST", "../library/controller.php", true);
     xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     //Invocazione AJAX e passaggio di parametri
     xmlhttp.send("azione=acquisto&quantita=" + quantita);
 }