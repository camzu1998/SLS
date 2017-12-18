function reload(idSezonu){
    var idRundy = $('#runda').val();

    var xmlhttp = new XMLHttpRequest;
    xmlhttp.open("GET", "tabelaKIC.php?id="+idSezonu+"&runda="+idRundy, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('tabeleczka').innerHTML = this.responseText;
        }
    }
}
