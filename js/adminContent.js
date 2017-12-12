function wyswietlaj(tytul, content){
    $('#dialogWindow').show();
    $('#title').text(tytul);
    if(content == "dodajzaw"){
        $('#content').text("Dodaj Zawodnika");
        var xmlhttp = new XMLHttpRequest();
        var tryb = "wczytajDodajZaw";
        console.log("Stage 1");
        xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb, true);
        xmlhttp.send();
        console.log("Otworzono");
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById('content').innerHTML = this.responseText;
                console.log(this.responseText);
            }
        }
        console.log("Stage 3");
    }
}
function wyslij(){
    var imie = $('#Imie').val();
    var nazwisko = $('#Nazwisko').val();
    var plec = $('#Plec').val();
    var druzyna = $('#Druzyna').val();
    var xmlhttp = new XMLHttpRequest();
    var tryb = "DodajZaw";
    console.log("Stage 4");
    xmlhttp.open("GET", "adminContentController.php?Tryb="+tryb+"&Imie="+imie+"&Nazwisko="+nazwisko+"&Plec="+plec+"&Druzyna="+druzyna, true);
    xmlhttp.send();
    console.log("Otworzono");
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
        }
    }
    console.log("Stage 6");
}
/**
function zapis(nazwa) {
    var xmlhttp = new XMLHttpRequest();
    var tryb = "zapis";
    xmlhttp.open("GET", "dodajCBG.php?Nazwa=" + nazwa, true);
    xmlhttp.send();
    console.log(xmlhttp.responseText);
    xmlhttp.open("GET", "cojestGrane.php?Teraz=" + nazwa + "&Tryb="+tryb, true);
    xmlhttp.send();
    console.log("Wysłano");
}
**/
