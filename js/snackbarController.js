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
    if(tekst == "PlayerDelete"){var content = "Zawodnik usunięty!";}
    if(tekst == "EdycjaPkt"){var content = "Punkty uaktualnione!";}
    if(tekst == "PtsDelete"){var content = "Punkty usunięte!";}
    if(tekst == "PlayerEdit"){var content = "Dane zawodnika uaktualnione!";}
    if(tekst == "SchoolExist"){var content = "Taka szkoła już istnieje!";}
    if(tekst == "SchoolDone"){var content = "Szkoła dodana!";}
    if(tekst == "TeamCreator"){var content = "Skład drużyny zapisany!";}
    if(tekst == "TeamUpdate"){var content = "Zaktualizowano informacje o drużynie!";}
    if(tekst == "TeamDelete"){var content = "Usunięto drużyne!";}
    if(tekst == "DeleteShl"){var content = "Usunięto szkołe!";}
    if(tekst == "UpdateShl"){var content = "Zaktualizowano informacje o szkole!";}
    if(tekst == "DodajSezon"){var content = "Dodano nowy sezon!";}
    if(tekst == "UpdateSezon"){var content = "Sezon zaktualizowany!";}
    if(tekst == "SezonExist"){var content = "Sezon już istnieje!";}
    if(tekst == "DeleteSeason"){var content = "Sezon usunięty!";}
    if(tekst == "UpdateRound"){var content = "Runda zaktualizowana!";}
    if(tekst == "DeleteRound"){var content = "Runda usunięta!";}
    $("#tekst").text(content);
    snackbar();
}
