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
    }else if(content == "dodajSzkole"){
        var tryb = "wczytajDodajSzkole";
    }else if(content == "edytujpkt"){
        var tryb = "wczytajEdytujPkt";
    }else if(content == "edytujdruz"){
        var tryb = "wczytajEdytujDruz";
    }else if(content == "edytujSzkole"){
        var tryb = "wczytajEdytujSzkole";
    }else if(content == "dodajsez"){
        var tryb = "wczytajDodajSez";
    }else if(content == "edytujsez"){
        var tryb = "wczytajEdytujSez";
    }else if(content == "edytujrunde"){
        var tryb = "wczytajEdytujRunde";
    }

    response(tryb);
}
function wyslijDZ(){
    var imie = $('#Imie').val();
    var nazwisko = $('#Nazwisko').val();
    var Plec = $( "input:checked" ).val();
    var szkola = $('#szkola').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "DodajZaw";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&Imie="+imie+"&Nazwisko="+nazwisko+"&Plec="+Plec+"&szkola="+szkola, true);
    xmlhttp.send();
}
function wyslijDD(){
    var nazwa = $('#Nazwa').val();
    var konkurs = Number($('input[name=konkurs]:checked').val());
    var szkola = $('#szkola').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "DodajDruz";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&nazwa="+nazwa+"&konkurs="+konkurs+"&szkola="+szkola, true);
    xmlhttp.send();
}
function wyslijDP(){
    var ilosc10 = 0;
    var pkt = new Array(10);
    for(var i=0; i<10;i++){
        pkt[i] = $('#pkt'+i).val();
    }
    var suma = 0;
    for(var x=0;x<10;x++){
        suma += Number(pkt[x]);
        if(pkt[x] == 10){
            ilosc10++;
        }
    }
    //var ilosc10 = $('#Ilosc10').val();
    var nrRundy = $('#runda').val();
    var zawodnik = $('#zawodnik').val();
    var xmlhttp = new XMLHttpRequest();
    var tryb = "DodajPkt";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&Suma="+suma+"&pkt1="+pkt[0]+"&pkt2="+pkt[1]+"&pkt3="+pkt[2]+"&pkt4="+pkt[3]+"&pkt5="+pkt[4]+"&pkt6="+pkt[5]+"&pkt7="+pkt[6]+"&pkt8="+pkt[7]+"&pkt9="+pkt[8]+"&pkt10="+pkt[9]+"&ilosc10="+ilosc10+"&nrRundy="+nrRundy+"&zawodnik="+zawodnik, true);
    xmlhttp.send();
}
function updateDP(){
    var sumaPkt = 0;
    var ilosc10 = 0;
    var pkt = new Array(10);
    for(var i=0; i<10;i++){
        pkt[i] = $('#pkt'+i).val();
    }
    var suma = 0;
    for(var x=0;x<10;x++){
        suma += Number(pkt[x]);
        if(pkt[x] == 10){
            ilosc10++;
        }
    }
    $('#wynik').text("Suma: "+suma+' \n Ilość 10: '+ilosc10);
    var runda = $('#runda').val();
    var zawodnik = $('#zawodnik').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "CheckTeamPts";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&runda="+runda+"&zawodnik="+zawodnik, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            sumaPkt = Number(this.responseText);
            sumaPkt += suma;
            $('#wynikDruzyny').text("Suma pkt drużyny: "+sumaPkt);
        }
    }
}
function wyslijNR(){
    var nazwaSez = $('#sezon').val();
    var nazwaShl = $('#nazwaShl').val();
    var Data = $('#Data').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "NowaRunda";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&Data="+Data+"&NazwaSez="+nazwaSez+"&NazwaShl="+nazwaShl, true);
    xmlhttp.send();
}
function wyslijEZ(){
    var idZawodnika = $('#zawodnik').val();
    var ImieNazwisko = $('#ImieNazwisko').val();
    var druzyna = $('#druzyna').val();
    var Plec = $( "input:checked" ).val();
    var xmlhttp = new XMLHttpRequest();
    var tryb = "EdytujZawodnika";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&ImieNazwisko="+ImieNazwisko+"&Plec="+Plec+"&IDZaw="+idZawodnika+"&druzyna="+druzyna, true);
    xmlhttp.send();
}
function wyslijUZ(){
    var idZawodnika = $('#zawodnik').val();
    var xmlhttp = new XMLHttpRequest();
    var tryb = "UsunZawodnika";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&IDZaw="+idZawodnika, true);
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
function zakonczRunde(){
    var xmlhttp = new XMLHttpRequest();
    var tryb = "EndRound";
    $('#dialogWindow').show();
    $('#title').text("Zakończ rundę!");
    $('#content').text("Pomyślnie zakończono rundę!");
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb, true);
    xmlhttp.send();
}
function wyslijDS(){
    var szkola = $('#Szkola').val();
    var www = $('#WWW').val();
    var adres = $('#Adres').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "DodajShl";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&szkola="+szkola+"&www="+www+"&adres="+adres, true);
    xmlhttp.send();
}
function refreshEP(){
    var idZaw = $('#zawodnik').val();
    var nrRundy = $('#runda').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "refreshEP";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&IDZaw="+idZaw+"&NrRundy="+nrRundy, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('formularz').innerHTML = this.responseText;
        }
    }
}
function wyslijEP(){
    var ilosc10 = 0;
    var idZaw = $('#zawodnik').val();
    var nrRundy = $('#runda').val();

    var pkt = new Array(10);
    for(var i=0; i<10;i++){
        pkt[i] = $('#pkt'+i).val();
    }
    var suma = 0;
    for(var x=0;x<10;x++){
        suma += Number(pkt[x]);
        if(pkt[x] == 10){
            ilosc10++;
        }
    }

    var xmlhttp = new XMLHttpRequest();
    var tryb = "EdytujPkt";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&Suma="+suma+"&pkt1="+pkt[0]+"&pkt2="+pkt[1]+"&pkt3="+pkt[2]+"&pkt4="+pkt[3]+"&pkt5="+pkt[4]+"&pkt6="+pkt[5]+"&pkt7="+pkt[6]+"&pkt8="+pkt[7]+"&pkt9="+pkt[8]+"&pkt10="+pkt[9]+"&ilosc10="+ilosc10+"&nrRundy="+nrRundy+"&zawodnik="+idZaw, true);
    xmlhttp.send();
}
function wyslijUP(){
    var idZaw = $('#zawodnik').val();
    var nrRundy = $('#runda').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "UsunPkt";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&IDrundy="+nrRundy+"&IDzaw="+idZaw, true);
    xmlhttp.send();
}
function refreshED(){
    var druzyna = $('#druzyna').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "refreshED";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&druzyna="+druzyna, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('formularz').innerHTML = this.responseText;
        }
    }
}
function wyslijED(){
    var nazwa = $('#Nazwa').val();
    var konkurs = Number($('input[name=konkurs]:checked').val());
    var szkola = $('#szkola').val();
    var druzyna = $('#druzyna').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "EdytujDruz";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&druzyna="+druzyna+"&nazwa="+nazwa+"&konkurs="+konkurs+"&szkola="+szkola, true);
    xmlhttp.send();
}
function wyslijUD(){
    var druzyna = $('#druzyna').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "UsunDruz";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&druzyna="+druzyna, true);
    xmlhttp.send();

}
function refreshSZ(){
    var szkola = $('#szkola').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "refreshES";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&szkola="+szkola, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('formularz').innerHTML = this.responseText;
        }
    }
}
function wyslijUS(){
    var szkola = $('#szkola').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "UsunShl";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&szkola="+szkola, true);
    xmlhttp.send();

}
function wyslijES(){
    var szkola = $('#szkola').val();
    var nazwaSzkola = $('#nazwaSzkola').val();
    var www = $('#WWW').val();
    var adres = $('#Adres').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "EdytujShl";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&szkola="+szkola+"&nazwaSzkola="+nazwaSzkola+"&www="+www+"&adres="+adres, true);
    xmlhttp.send();
}
function wyslijDSEZ(){
    var nazwa = $('#nazwa').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "DodajSezon";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&nazwa="+nazwa, true);
    xmlhttp.send();
}
function refreshESEZ(){
    var sezon = $('#sezon').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "refreshESEZ";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&sezon="+sezon, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('formularz').innerHTML = this.responseText;
        }
    }
}
function wyslijESEZ(){
    var nazwa = $('#nazwa').val();
    var sezon = $('#sezon').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "EdytujSezon";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&nazwa="+nazwa+"&sezon="+sezon, true);
    xmlhttp.send();
}
function wyslijUSEZ(){
    var nazwa = $('#nazwa').val();
    var sezon = $('#sezon').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "UsunSezon";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&nazwa="+nazwa+"&sezon="+sezon, true);
    xmlhttp.send();
}
function refreshER(){
    var runda = $('#runda').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "refreshER";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&runda="+runda, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById('formularz').innerHTML = this.responseText;
        }
    }
}
function wyslijER(){
    var runda = $('#runda').val();
    var nazwaSez = $('#sezon').val();
    var nazwaShl = $('#nazwaShl').val();
    var Data = $('#Data').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "EdytujRunde";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&runda="+runda+"&Data="+Data+"&NazwaSez="+nazwaSez+"&NazwaShl="+nazwaShl, true);
    xmlhttp.send();
}
function wyslijUR(){
     var runda = $('#runda').val();

    var xmlhttp = new XMLHttpRequest();
    var tryb = "UsunRunde";
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&runda="+runda, true);
    xmlhttp.send();
}
