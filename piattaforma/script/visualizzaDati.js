var xmlhttp = new XMLHttpRequest(); //Variabile gestione interrogazioni client-server

/**Funzione adibita alla creazione dinamica della pagina
 * Se l'utente loggato è un cliente --> visualizzaVetrina()
 * Se l'utente loggato è un fornitore --> visualizzaMagazzino()
 */
function checkVisualizza()
{
    xmlhttp.onreadystatechange = 
    function() 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            if(xmlhttp.responseText == "error_0")
                alert("Errore nella ricerca dell'azione");

            else if(xmlhttp.responseText != null)
            {
                try
                {
                    var tipoAccount = xmlhttp.responseText;
 
                    if(tipoAccount == "clienti")
                        visualizzaVetrina();

                    if(tipoAccount == "fornitori")
                        visualizzaMagazzino();
                }
                
                catch
                {
                    alert("Errore nella ricezione della risposta --> checkVisualizza()");
                }
            }
        }

    }

    xmlhttp.open("GET", "../library/controller.php?azione=tipo_account", true);
    xmlhttp.send();
}

/**Funzione adibita alla visualizzazione della vetrina dei prodotti */
function visualizzaVetrina()
{
    xmlhttp.onreadystatechange = 
    function() 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            if(xmlhttp.responseText == "error_0")
                alert("Errore nella ricerca dell'azione");
            
            if(xmlhttp.responseText == "error_5")
                alert("Errore nella visualizzazione della vetrina");

            else if(xmlhttp.responseText != null)
            {
                try
                {
                    var resultRequest = JSON.parse(xmlhttp.responseText);

                    var stringHtml = "<h3>Prodotti A&P web shop</h3> \
                                      <table> \
                                        <tr><th>Prodotto</th><th>Descrizione</th><th>Costo</th><th>Quantita'</th></tr>";

                    resultRequest.forEach(element => 
                    {
                        stringHtml += "<tr><td>" + element.prodotto + "</td><td>" + element.descrizione + "</td><td>" + element.costo + "</td><td>" + element.quantita + "</td><td><button type='button' onclick='preparaAcquisto(\"" + element.id_prodotto + "\",\"" + element.costo + "\")'>Acquista</button>"+"</td></tr>";
                    });


                    stringHtml += "</table><br>";
                    stringHtml += "<div id=\"popupFrame\" style=\"display:none\"> \
                                        Quantita':<input type=\"number\" id=\"quantita\" name=\"quantita\"><br> \
                                        <button value=\"acquista\" onclick=\"effettuaAcquisto()\">acquista</button> \
                                    </div>";
                    document.getElementById('contenuto').innerHTML = stringHtml;
                    
                }
                
                catch
                {
                    alert("Errore nell'esecuzione del parse --> visualizzaVetrina()");
                }
            }
        }

    }

    xmlhttp.open("GET", "../library/controller.php?azione=home_page", true);
    xmlhttp.send();
}

/**Funzione adibita alla visualizzazione del magazzino di un determinato produttore */
function visualizzaMagazzino()
{
    xmlhttp.onreadystatechange = 
    function() 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            if(xmlhttp.responseText == "error_0")
                alert("Errore nella ricerca dell'azione");
            
            if(xmlhttp.responseText == "error_6")
                alert("Errore nella visualizzazione del magazzino");

            else if(xmlhttp.responseText != null)
            {
                try
                {
                    var resultRequest = JSON.parse(xmlhttp.responseText);

                    var stringHtml = "<h3>Magazzino</h3> \
                                      <table> \
                                        <tr><th>ID</th><th>Prodotto</th><th>Descrizione</th><th>Costo</th><th>Quantita'</th></tr>";

                    resultRequest.forEach(element => 
                    {
                        stringHtml += "<tr><td>" + element.id_prodotto + "</td><td>" + element.prodotto + "</td><td>" + element.descrizione + "</td><td>" + element.costo + "</td><td>" + element.quantita + "</td><td><button type='button' onclick='preparaModifica(\"" + element.id_prodotto + "\")'>Modifica</button>"+"</td></tr>";
                    });

                    stringHtml += "</table><br>";
                    //stringHtml += "<iframe id=\"popupFrame\" src=\"modifica.html\" style=\"display:none\"></iframe>";
                    stringHtml += "<div id=\"popupFrame\" style=\"display:none\"> \
                                    <form action=\"../library/controller.php\" method=\"post\"> \
                                        Campo da modificare:<input list=\"modCampo\" name=\"modCampo\" autocomplete=\"on\" /><datalist id=\"modCamp\"> \
                                            <option>Nome</option> \
                                            <option>Descrizione</option> \
                                            <option>Costo</option> \
                                            <option>Quantita</option> </datalist><br> \
                                        Nuovo valore:<input type=\"text\" id=\"modValore\" name=\"modValore\"><br> \
                                        <input type=\"submit\" name=\"azione\" value=\"modifica_prodotto\" onclick=\"aggiornaPagina()\"> \
                                    </form> \
                                </div>";
                    document.getElementById('contenuto').innerHTML = stringHtml;
                    
                }
                
                catch
                {
                    alert("Errore nell'esecuzione del parse --> visualizzaMagazzino()");
                }
            }
        }

    }

    xmlhttp.open("GET", "../library/controller.php?azione=home_page", true);
    xmlhttp.send();
}