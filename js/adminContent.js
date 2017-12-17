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
    }else if(content == "nowarunda"){
        var tryb = "wczytajNowaRunda";
    }else if(content == "edytujzaw"){
        var tryb = "wczytajEdytujZawodnika";
    }else if(content == "kreatordruzyn"){
        var tryb = "wczytajKreatorDruzyn";
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
function updateDP(){
    var pkt = new Array(10);
    for(var i=0; i<10;i++){
        pkt[i] = $('#pkt'+i).val();
    }
    var suma = 0;
    for(var x=0;x<10;x++){
        suma += Number(pkt[x]);
    }
    $('#wynik').text("Suma: "+suma);
}
function wyslijNR(){
    var nazwaSez = $('#sezon').val();
    var nazwaShl = $('#nazwaShl').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "NowaRunda";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&NazwaSez="+nazwaSez+"&NazwaShl="+nazwaShl, true);
    xmlhttp.send();
}
function wyslijEZ(){
    var idZawodnika = $('#zawodnik').val();
    var ImieNazwisko = $('#ImieNazwisko').val();
    var plec = $('#Plec').val();
    var druzyna = $('#Druzyna').val();
    var xmlhttp = new XMLHttpRequest();
    var tryb = "EdytujZawodnika";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&ImieNazwisko="+ImieNazwisko+"&Plec="+plec+"&Druzyna="+druzyna+"&IDZaw="+idZawodnika, true);
    xmlhttp.send();
}
function refresh(){
    var idZaw = $('#zawodnik').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "refresh";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&IDZaw="+idZaw, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('formularz').innerHTML = this.responseText;
        }
    }
}
function refreshDruzyny(){
    var idDruzyny = $('#druzyny').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "refreshDruzyny";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&druzyny="+idDruzyny, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('formularz').innerHTML = this.responseText;
        }
    }
}
function wyslijKD(){
    var zawodnicy = new Array(7);
    for(var i=1; i<7;i++){
        zawodnicy[i] = $('#zawodnik'+i).val();
        console.log(zawodnicy[i]);
    }
    var idDruzyny = $('#druzyny').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "KreatorDruzyn";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&druzyny="+idDruzyny+"&zawodnik1="+zawodnicy[1]+"&zawodnik2="+zawodnicy[2]+"&zawodnik3="+zawodnicy[3]+"&zawodnik4="+zawodnicy[4]+"&zawodnik5="+zawodnicy[5]+"&zawodnik6="+zawodnicy[6], true);
    xmlhttp.send();
}
