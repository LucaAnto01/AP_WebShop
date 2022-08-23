/**Funzione che mostra o nasconde il form in base al tipo di registrazione da effettuare */
function show()
{
    var e = document.getElementById("myDropdown");
    var codice = e.value;
    if(codice == 1)
    {
        document.getElementById("regFornitore").style.display="block";
        document.getElementById("regCliente").style.display="none";
    }
    if(codice == 2)
    {
        document.getElementById("regCliente").style.display="block";
        document.getElementById("regFornitore").style.display="none";
    }
}
