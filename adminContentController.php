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
            //ZMIENNE DO LOGOW
            $Data = date("Y.m.d H:i:s");
            $IP = $_SERVER['REMOTE_ADDR'];
            $ID = $_SESSION['ID'];
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
            mysqli_query($polaczenie, "INSERT INTO `logi` (`IP`, `ID_uzytkownika`, `Data`,  `Czynnosc`) VALUES('".$IP."')")
            echo "Done";
        }else if($tryb == "wczytajDodajDruz"){
            echo include"dodajDruzyne.php";
        }else if($tryb == "DodajDruz"){
            //KONWERSJA LITER I ODCZYT IMIENIA I NAZWISKOA ZAWODNIKA
            $szkola = mb_convert_case($_REQUEST['szkola'], MB_CASE_TITLE, "UTF-8");
            $adres = mb_convert_case($_REQUEST['adres'], MB_CASE_TITLE, "UTF-8");
            $nazwa = $_REQUEST['nazwa'];
            $www = $_REQUEST['www'];
            mysqli_query($polaczenie, "INSERT INTO `druzyny` (`NazwaSzkoly`, `AdresSzkoly`, `WWW`, `NazwaDruzyny`) VALUES('".$szkola."', '".$adres."', '".$www."', '".$nazwa."');");
            echo "Done";
        }else if($tryb == "wczytajDodajPkt"){
            echo include"dodajPkt.php";
        }else if($tryb == "DodajPkt"){
            //POBIERANIE ZMIENNYCH
            $idZawodnika = $_GET['zawodnik'];
            $Suma = $_GET['Suma'];
            $Ilosc10 = $_GET['ilosc10'];
            $nrRundy = $_GET['nrRundy'];
            //DODANIE DO TABELI
            mysqli_query($polaczenie, "INSERT INTO `punkty` (`ID_zaw`, `Suma`, `Ilosc_10`, `ID_Rundy`) VALUES('".$idZawodnika."', '".$Suma."', '".$Ilosc10."', '".$nrRundy."');");
            echo "Done";
        }else if($tryb == "wczytajNowaRunda"){
            echo include"nowaRunda.php";
        }else if($tryb == "NowaRunda"){
            //POBIERANIE ZMIENNYCH
            $nazwaShl = $_GET['NazwaShl'];
            $idSez = $_GET['NazwaSez'];
            //DODAWANIE DO TABELI
            mysqli_query($polaczenie, "INSERT INTO `rundy` (`IdSezonu`, `NazwaShl`) VALUES('".$idSez."', '".$nazwaShl."');");
            echo "Done";
        }
    }
?>
