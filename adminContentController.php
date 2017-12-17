<?php
    session_start();
    require_once "connect.php";
    @$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    @$polaczenie->set_charset("utf8");
    @$polaczenie->query("SET CHARACTER_SET utf8_polish_ci");
    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
    } else {
        function logi($czynnosc){
            //ZMIENNE DO LOGOW
            $Data = date("Y.m.d H:i:s");
            $IP = $_SERVER['REMOTE_ADDR'];
            $ID = $_SESSION['ID'];
            //DODANIE DO TABELI
            mysqli_query($polaczenie, "INSERT INTO `logi` (`IP`, `ID_uzytkownika`, `Data`,  `Czynnosc`) VALUES('".$IP."', '".$ID."', '".$Data."', '".$czynnosc."');");
        }

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
            $czynnosc = "Dodawanie zawodnika";
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
            $czynnosc = "Dodawanie drużyny";
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
            $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika` = '".$idZawodnika."';");
            $wiersz = $rezultat->fetch_assoc();
                $idDruzyny = $wiersz['ID_druzyny'];
            $rezultat = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny` = '".$idDruzyny."';");
            $wiersz = $rezultat->fetch_assoc();
                $SumaDruz = $wiersz['SumaPkt'];
            $SumaDruz += $Suma;
            mysqli_query($polaczenie, "UPDATE `druzyny` SET `SumaPkt`='".$SumaDruz."' WHERE `ID_druzyny`='".$idDruzyny."';");
            $czynnosc = "Dodawanie punktów";
            echo "Done";
        }else if($tryb == "wczytajNowaRunda"){
            echo include"nowaRunda.php";
        }else if($tryb == "NowaRunda"){
            //POBIERANIE ZMIENNYCH
            $nazwaShl = mb_convert_case($_GET['NazwaShl'], MB_CASE_TITLE, "UTF-8");
            $idSez = $_GET['NazwaSez'];
            //DODAWANIE DO TABELI
            mysqli_query($polaczenie, "INSERT INTO `rundy` (`IdSezonu`, `NazwaShl`) VALUES('".$idSez."', '".$nazwaShl."');");
            $czynnosc = "Dodawanie rundy";
        }else if($tryb == "wczytajEdytujZawodnika"){
            echo include"edytujZawodnika1.php";
        }elseif($tryb == "refresh"){
            $Idzaw = $_GET['IDZaw'];
            echo include"editPlayer.php";
        }else if($tryb == "EdytujZawodnika"){
            $Idzaw = $_REQUEST['IDZaw'];
            //KONWERSJA LITER I ODCZYT IMIENIA I NAZWISKOA ZAWODNIKA
            $ImieNazwisko = mb_convert_case($_REQUEST['ImieNazwisko'], MB_CASE_TITLE, "UTF-8");
            //WYSZUKANIE ID DRUZYNY
            $nazwaDruzyny = $_REQUEST['Druzyna'];
            $rezultat = $polaczenie->query("SELECT * FROM `druzyny` WHERE `NazwaDruzyny`='".$nazwaDruzyny."';");
            $wiersz = $rezultat->fetch_assoc();
                $IDD = $wiersz['ID_druzyny'];
            //RESZTA DANYCH
            $Plec = $_REQUEST['Plec'];
            mysqli_query($polaczenie, "UPDATE `zawodnicy` SET `Imie Nazwisko`='".$ImieNazwisko."',`ID_druzyny`='".$IDD."',`Plec`='".$Plec."' WHERE `ID_zawodnika`='".$Idzaw."';");
            $czynnosc ="Edycja zawodnika";
        }else if($tryb == "wczytajKreatorDruzyn"){
            echo include"kreatorDruzyn.php";
        }else if($tryb == "refreshDruzyny"){
            $IdDruzyny = $_GET['druzyny'];
            echo include"kreatorDruzynForm.php";
        }else if($tryb == "KreatorDruzyn"){
            $idZaw1 = $_GET['zawodnik1'];
            $idZaw2 = $_GET['zawodnik2'];
            $idZaw3 = $_GET['zawodnik3'];
            $idZaw4 = $_GET['zawodnik4'];
            $idZaw5 = $_GET['zawodnik5'];
            $idZaw6 = $_GET['zawodnik6'];
            $IDD = $_GET['druzyny'];

            mysqli_query($polaczenie, "UPDATE `zawodnicy` SET `ID_druzyny`='".$IDD."' WHERE `ID_zawodnika` = '".$idZaw1."' OR `ID_zawodnika` = '".$idZaw2."' OR `ID_zawodnika` = '".$idZaw3."' OR `ID_zawodnika` = '".$idZaw4."' OR `ID_zawodnika` = '".$idZaw5."' OR `ID_zawodnika` = '".$idZaw6."';");
        }
    }
?>
