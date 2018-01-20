function reload(idSezonu,rodzaj){
    var idRundy = $('#runda').val();

    var xmlhttp = new XMLHttpRequest;
    xmlhttp.open("GET", "tabela"+rodzaj+".php?id="+idSezonu+"&runda="+idRundy, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('tabeleczka').innerHTML = this.responseText;
        }
    }
}
