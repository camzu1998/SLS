function response(tryb){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('content').innerHTML = this.responseText;
        }
    }
}
function wyswietlaj(tytul, content){
    $('#dialogWindow').show();
    $('#title').text(tytul);
    if(content == "dodajzaw"){
        var tryb = "wczytajDodajZaw";
    }else if(content == "dodajdruz"){
        var tryb = "wczytajDodajDruz";
    }else if(content == "dodajpkt"){
        var tryb = "wczytajDodajPkt";
    }

    response(tryb);
}
function wyslijDZ(){
    var imie = $('#Imie').val();
    var nazwisko = $('#Nazwisko').val();
    var plec = $('#Plec').val();
    var druzyna = $('#Druzyna').val();
    var xmlhttp = new XMLHttpRequest();
    var tryb = "DodajZaw";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&Imie="+imie+"&Nazwisko="+nazwisko+"&Plec="+plec+"&Druzyna="+druzyna, true);
    xmlhttp.send();
}
function wyslijDD(){
    var szkola = $('#Szkola').val();
    var www = $('#WWW').val();
    var adres = $('#Adres').val();
    var nazwa = $('#Nazwa').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "DodajDruz";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&szkola="+szkola+"&www="+www+"&adres="+adres+"&nazwa="+nazwa, true);
    xmlhttp.send();
}
function wyslijDP(){
    var pkt = new Array(10);
    for(var i=0; i<10;i++){
        pkt[i] = $('#pkt'+i).val();
    }
    var suma = 0;
    for(var x=0;x<10;x++){
        suma += Number(pkt[x]);
    }
    var ilosc10 = $('#Ilosc10').val();
    var nrRundy = $('#runda').val();
    var zawodnik = $('#zawodnik').val();
    var xmlhttp = new XMLHttpRequest();
    var tryb = "DodajPkt";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&Suma="+suma+"&ilosc10="+ilosc10+"&nrRundy="+nrRundy+"&zawodnik="+zawodnik, true);
    xmlhttp.send();
}
