var xmlhttp = new XMLHttpRequest(); //Variabile gestione interrogazioni client-server

/**Funzione adibita alla modifica di un prodotto
 * @param Form form
 */
function modificaValore(form)
{
    xmlhttp.onreadystatechange =
    function() 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            if(xmlhttp.responseText == "error_0")
                alert("Errore nella ricerca dell'azione");
            
            else if(xmlhttp.responseText == "Error_query")
                alert("Errore nell'esecuzione della query di update");

            else if(xmlhttp.responseText == "Fatto")
                alert("Aggiornamento effettuato con successo!");
            
            else
                alert("Errore critico");
        }
    }

    xmlhttp.open("POST", "../library/controller.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    //Invocazione AJAX e passaggio di parametri
    var f = document.forms[form];
    var campoDaModificare = f.elements["modCampo"].value;
    var nuovoValore = f.elements["modValore"].value;
    xmlhttp.send("azione=modifica_prodotto&campoDaModificare=" + campoDaModificare + "&nuovoValore=" + nuovoValore);
}