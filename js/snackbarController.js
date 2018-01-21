function snackbar(){
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 4500);
}
function openSnackbar(tekst){
    if(tekst == "ErrorPtsExist"){var content = "Ten zawodnik ma już punkty w tej rundzie!";}
    $("#tekst").text(content);
    snackbar();
}
