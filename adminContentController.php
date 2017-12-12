<?php
    session_start();
    require_once "connect.php";
    @$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    @$polaczenie->set_charset("utf8");
    @$polaczenie->query("SET CHARACTER_SET utf8_polish_ci");
    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
    } else {
        $tryb = $_REQUEST['Tryb'];
        if($tryb == "wczytajDodajZaw"){
            echo include"dodajZawodnika.php";
        }else if($tryb == "DodajZaw"){
            //KONWERSJA LITER I ODCZYT IMIENIA I NAZWISKOA ZAWODNIKA
            $imies = $_REQUEST['Imie'];
            $imie = mb_convert_case($imies, MB_CASE_TITLE, "UTF-8");
            $nazwiskoS = $_REQUEST['Nazwisko'];
            $nazwisko = mb_convert_case($nazwiskoS, MB_CASE_TITLE, "UTF-8");
            $ImieNazwisko = $imie." ".$nazwisko;
            //WYSZUKANIE ID DRUZYNY
            $nazwaDruzyny = $_REQUEST['Druzyna'];
            $rezultat = $polaczenie->query("SELECT * FROM `druzyny` WHERE `NazwaDruzyny`='".$nazwaDruzyny."';");
            $wiersz = $rezultat->fetch_assoc();
                $IDD = $wiersz['ID_druzyny'];
            //RESZTA DANYCH
            $Plec = $_REQUEST['Plec'];
            mysqli_query($polaczenie, "INSERT INTO `zawodnicy` (`Imie Nazwisko`, `ID_Druzyny`, `Plec`) VALUES('".$ImieNazwisko."', '".$IDD."', '".$Plec."');");
            echo "Done";
        }
    }
?>
