function snackbar(){
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 4500);
}
function openSnackbar(tekst){
    if(tekst == "ErrorPtsExist"){var content = "Ten zawodnik ma już punkty w tej rundzie!";}
    if(tekst == "PtsDone"){var content = "Punkty dodane pomyślnie!";}
    if(tekst == "ZawodnikExist"){var content = "Ten zawodnik już istnieje w bazie!";}
    if(tekst == "ZawodnikDone"){var content = "Zawodnik dodany pomyślnie!";}
    if(tekst == "TeamExist"){var content = "Drużyna już istnieje!";}
    if(tekst == "TeamDone"){var content = "Drużyna dodana pomyślnie!";}
    if(tekst == "NowaRunda"){var content = "Nowa runda dodana pomyślnie!";}
    $("#tekst").text(content);
    snackbar();
}
