var xmlhttp = new XMLHttpRequest(); //Variabile gestione interrogazioni client-server

/**Funzioni relative al caricamento del profilo di un cliente o fornitore
 * cliente: le rispettive informazioni e le fatture relative agli acquisti effettuati
 * fornitore: le rispettive informazioni e le fatture relative alle vendite fatte
 */

function nascondiFatture()
{
    document.getElementById("fatture").style.display = "none";
}

function visualizzaFatture()
{
    xmlhttp.onreadystatechange = 
    function() 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            if(xmlhttp.responseText == "error_0")
                alert("Errore nella ricerca dell'azione");

            if(xmlhttp.responseText == "error_l")
            {
                alert('Devi prima effettuare il login!');
                window.location.href = "../pages/login.html";
            }

            if(xmlhttp.responseText == "error_11")
                alert("Non sono disponibili fatture per questo fornitore!");
                
            else if(xmlhttp.responseText != null)
            {
                try
                {
                    document.getElementById("fatture").style.display = "inline";

                    var fatture = JSON.parse(xmlhttp.responseText);
                    
                    var stringHtml = "<h4>Fatture</h4><table>";
                    stringHtml += "<tr><th>Intestatario</th><th>P.Iva fornitore</th><th>ID prodotto</th><th>Data emissione</th><th>Quantita'</th><th>Importo</th></tr>";

                    fatture.forEach(element => 
                    {
                        stringHtml += "<tr><td>" + element.fkIntestatario + "</td><td>" + element.fkPIvaFornitore + "</td><td>" + element.fkIdProdotto + "</td><td>" + element.emissione + "</td><td>" + element.quantitaProdotto + "</td><td>" + element.importo + "</td></tr>";             
                    });

                    stringHtml += "</table><br>";
                    stringHtml += "<button onclick=\"nascondiFatture()\">Nascondi fatture</button>";

                    document.getElementById('fatture').innerHTML = stringHtml;           
                }
                
                catch
                {
                    alert("Errore nella ricezione della risposta --> visualizzaFatture()");
                }
            }
        }

    }

    xmlhttp.open("GET", "../library/controller.php?azione=fatture", true);
    xmlhttp.send();  
}

/**Funzione adibita alla visualizzazione delle informazioni di un cliente */
function visualizzaCliente()
{
    xmlhttp.onreadystatechange = 
    function() 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            if(xmlhttp.responseText == "error_0")
                alert("Errore nella ricerca dell'azione");

            if(xmlhttp.responseText == "error_l")
            {
                alert('Devi prima effettuare il login!');
                window.location.href = "../pages/login.html";
            }
                

            else if(xmlhttp.responseText != null)
            {
                try
                {
                    var accountInfo = JSON.parse(xmlhttp.responseText);
                    var stringHtml = "<h3>Profilo</h3><table>"; 
                    accountInfo.forEach(element => 
                    {
                        stringHtml += "<tr><td>Username</td><td>" + element.username + "</td></tr> \
                                       <tr><td>Email</td><td>" + element.email + "</td></tr> \
                                       <tr><td>Nome</td><td>" + element.nome + "</td></tr> \
                                       <tr><td>Cognome</td><td>" + element.cognome + "</td></tr> \
                                       <tr><td>Residenza</td><td>" + element.residenza + "</td></tr> ";             
                    });

                    stringHtml += "</table><br>";
                    stringHtml += "<button onclick=\"visualizzaFatture()\">Visualizza fatture</button>";

                    document.getElementById('contenuto').innerHTML = stringHtml;             
                }
                
                catch
                {
                    alert("Errore nella ricezione della risposta --> visualizzaCliente()");
                }
            }
        }

    }

    xmlhttp.open("GET", "../library/controller.php?azione=carica_profilo", true);
    xmlhttp.send();
}

/**Funzione adibita alla visualizzazione delle informazioni di un fornitore */
function visualizzaFornitore()
{
    xmlhttp.onreadystatechange = 
    function() 
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
        {
            if(xmlhttp.responseText == "error_0")
                alert("Errore nella ricerca dell'azione");

            if(xmlhttp.responseText == "error_l")
            {
                alert('Devi prima effettuare il login!');
                window.location.href = "../pages/login.html";
            }
                

            else if(xmlhttp.responseText != null)
            {
                try
                {
                    var accountInfo = JSON.parse(xmlhttp.responseText);
                    var stringHtml = "<h3>Profilo</h3><table>"; 
                    accountInfo.forEach(element => 
                    {
                        stringHtml += "<tr><td>Ragione sociale</td><td>" + element.ragioneSociale + "</td></tr> \
                                       <tr><td>Email</td><td>" + element.email + "</td></tr> \
                                       <tr><td>Sede</td><td>" + element.sede + "</td></tr> \
                                       <tr><td>Dirigente</td><td>" + element.dirigente + "</td></tr> \
                                       <tr><td>Sito web</td><td><a href=\"" + element.sitoWeb + "\">" + element.sitoWeb + "</a></td></tr> ";             
                    });

                    stringHtml += "</table><br>";
                    stringHtml += "<button onclick=\"visualizzaFatture()\">Visualizza fatture</button>";
                    
                    document.getElementById('contenuto').innerHTML = stringHtml;             
                }
                
                catch
                {
                    alert("Errore nella ricezione della risposta --> visualizzaFornitore()");
                }
            }
        }

    }

    xmlhttp.open("GET", "../library/controller.php?azione=carica_profilo", true);
    xmlhttp.send();
}

/**Funzione adibita alla creazione dinamica della pagina del profilo
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

            if(xmlhttp.responseText == "error_l")
            {
                alert('Devi prima effettuare il login!');
                window.location.href = "../pages/login.html";
            }

            else if(xmlhttp.responseText != null)
            {
                try
                {
                    var tipoAccount = xmlhttp.responseText;

                    if(tipoAccount == "clienti")
                        visualizzaCliente();

                    if(tipoAccount == "fornitori")
                        visualizzaFornitore();
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
