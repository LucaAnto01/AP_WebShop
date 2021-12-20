/**Funzioni relative alla modifica di un prodotto */

/**Funzione adibita alla preparazione di una modifica relativa ad un prodotto
 * @param idprotto
 */
 function preparaModifica(idProd)
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
     xmlhttp.send("azione=prepara_modifica&idprodotto=" + idProd);
 }