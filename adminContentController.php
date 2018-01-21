<?php
    session_start();
    require_once "connect.php";
    @$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
    @$polaczenie->set_charset("utf8");
    @$polaczenie->query("SET CHARACTER_SET utf8_polish_ci");
    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
    } else {
        function logi($czynnosc, $polaczenie){
            //ZMIENNE DO LOGOW
            $Data = date("Y.m.d H:i:s");
            $IP = $_SERVER['REMOTE_ADDR'];
            $ID = $_SESSION['ID'];
            //DODANIE DO TABELI
            mysqli_query($polaczenie, "INSERT INTO `logi` (`IP`, `ID_uzytkownika`, `Data`,  `Czynnosc`) VALUES('".$IP."', '".$ID."', '".$Data."', '".$czynnosc."');");
        }

        $tryb = $_GET['Tryb'];
        if($tryb == "wczytajDodajZaw"){
            echo include"dodajZawodnika.php";
        }else if($tryb == "DodajZaw"){
            //KONWERSJA LITER I ODCZYT IMIENIA I NAZWISKOA ZAWODNIKA
            $imies = $_GET['Imie'];
            $imie = mb_convert_case($imies, MB_CASE_TITLE, "UTF-8");
            $nazwiskoS = $_GET['Nazwisko'];
            $nazwisko = mb_convert_case($nazwiskoS, MB_CASE_TITLE, "UTF-8");
            $ImieNazwisko = $imie." ".$nazwisko;
            $Plec = $_GET['Plec'];
            $szkola = $_GET['szkola'];
            //SPRAWDZANIE CZY JEST JUŻ W BAZIE
            $check = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Imie Nazwisko`='".$ImieNazwisko."' AND `ID_szkoly`='".$szkola."';");
            if($check->num_rows != 0){
                $_SESSION['ZawodnikExist'] = 1;
            }else{
                $_SESSION['ZawodnikDone'] = 1;
                mysqli_query($polaczenie, "INSERT INTO `zawodnicy` (`Imie Nazwisko`, `Plec`, `ID_szkoly`) VALUES('".$ImieNazwisko."', '".$Plec."', '".$szkola."');");
                $czynnosc = "Dodawanie zawodnika";
            }
            echo "Done";
        }else if($tryb == "wczytajDodajDruz"){
            echo include"dodajDruzyne.php";
        }else if($tryb == "DodajDruz"){
            $nazwa = $_REQUEST['nazwa'];
            $konkurs = $_GET['konkurs'];
            $szkola = $_GET['szkola'];
            //SPRAWDZANIE CZY JEST JUŻ W BAZIE
            $check = $polaczenie->query("SELECT * FROM `druzyny` WHERE `NazwaDruzyny`='".$nazwa."' AND `ID_szkoly`='".$szkola."';");
            if($check->num_rows != 0){
                $_SESSION['TeamExist'] =1;
            }else{
                $_SESSION['TeamDone'] =1;
                mysqli_query($polaczenie, "INSERT INTO `druzyny` (`NazwaDruzyny`, `ID_szkoly`, `konkurs`) VALUES('".$nazwa."', '".$szkola."', '".$konkurs."');");
                $czynnosc = "Dodawanie drużyny";
            }
        }else if($tryb == "wczytajDodajPkt"){
            echo include"dodajPkt.php";
        }else if($tryb == "DodajPkt"){
            //POBIERANIE ZMIENNYCH
            $idZawodnika = $_GET['zawodnik'];
            $Suma = $_GET['Suma'];
            $Ilosc10 = $_GET['ilosc10'];
            $nrRundy = $_GET['nrRundy'];
            //DODANIE DO TABELI
            $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika` = '".$idZawodnika."';");
            $wiersz = $rezultat->fetch_assoc();
                $idDruzyny = $wiersz['ID_druzyny'];
            $rezultat = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny` = '".$idDruzyny."';");
            $wiersz = $rezultat->fetch_assoc();
                $SumaDruz = $wiersz['SumaPkt'];
            $SumaDruz += $Suma;
            //SPRAWDZANIE CZY USER MA PKT W TEJ RUNDZIE
            $rezultatSecurityCheck = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw` = '".$idZawodnika."' AND `ID_Rundy` = '".$nrRundy."';");
            if($rezultatSecurityCheck->num_rows != 0){
                //Error
                $_SESSION['ErrorPtsExist'] = 1;
            }else{
                $_SESSION['PtsDone'] = 1;
                mysqli_query($polaczenie, "INSERT INTO `punkty` (`ID_zaw`, `Suma`, `Ilosc_10`, `ID_Rundy`) VALUES('".$idZawodnika."', '".$Suma."', '".$Ilosc10."', '".$nrRundy."');");
                mysqli_query($polaczenie, "UPDATE `druzyny` SET `SumaPkt`='".$SumaDruz."' WHERE `ID_druzyny`='".$idDruzyny."';");
                $czynnosc = "Dodawanie punktów";
            }
            echo "Done";
        }else if($tryb == "wczytajNowaRunda"){
            echo include"nowaRunda.php";
        }else if($tryb == "NowaRunda"){
            //POBIERANIE ZMIENNYCH
            $_SESSION['NowaRunda']=1;
            $nazwaShl = mb_convert_case($_GET['NazwaShl'], MB_CASE_TITLE, "UTF-8");
            $idSez = $_GET['NazwaSez'];
            //DODAWANIE DO TABELI
            mysqli_query($polaczenie, "INSERT INTO `rundy` (`IdSezonu`, `NazwaShl`) VALUES('".$idSez."', '".$nazwaShl."');");
            $czynnosc = "Dodawanie rundy";
        }else if($tryb == "wczytajEdytujZawodnika"){
            echo include"edytujZawodnika1.php";
        }else if($tryb == "refresh"){
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
        }else if($tryb == "UsunZawodnika"){
            $Idzaw = $_GET['IDZaw'];
            mysqli_query($polaczenie, "DELETE FROM `zawodnicy` WHERE `ID_zawodnika`='".$Idzaw."';");
            $czynnosc ="Usunięcie zawodnika";
        }else if($tryb == "wczytajKreatorDruzyn"){
            echo include"kreatorDruzyn.php";
        }else if($tryb == "refreshDruzyny"){
            $IdDruzyny = $_GET['druzyny'];
            echo include"kreatorDruzynForm.php";
        }else if($tryb == "KreatorDruzyn"){
            //ZAWODNICY
            $idZaw1 = $_GET['zawodnik1'];
            $idZaw2 = $_GET['zawodnik2'];
            $idZaw3 = $_GET['zawodnik3'];
            $idZaw4 = $_GET['zawodnik4'];
            $idZaw5 = $_GET['zawodnik5'];
            $idZaw6 = $_GET['zawodnik6'];
            $IDD = $_GET['druzyny'];
            //ZERUJE WSZYSTKICH Z TEJ DRUŻYNY
            mysqli_query($polaczenie, "UPDATE `zawodnicy` SET `ID_druzyny`='0' WHERE `ID_druzyny`='".$IDD."';");
            //ZAPISUJE NOWYCH DO TEJ DRUŻYNY
            mysqli_query($polaczenie, "UPDATE `zawodnicy` SET `ID_druzyny`='".$IDD."' WHERE `ID_zawodnika` = '".$idZaw1."' OR `ID_zawodnika` = '".$idZaw2."' OR `ID_zawodnika` = '".$idZaw3."' OR `ID_zawodnika` = '".$idZaw4."' OR `ID_zawodnika` = '".$idZaw5."' OR `ID_zawodnika` = '".$idZaw6."';");
            $czynnosc ="Kreator drużyn";

        }else if($tryb == "EndRound"){
            mysqli_query($polaczenie, "UPDATE `zawodnicy` SET `ID_druzyny`=0 WHERE 1");
        }else if($tryb == "wczytajDodajSzkole"){
            echo include"dodajSzkole.php";
        }else if($tryb == "DodajShl"){
            $nazwaShl = mb_convert_case($_GET['szkola'], MB_CASE_TITLE, "UTF-8");
            $adres = mb_convert_case($_GET['adres'], MB_CASE_TITLE, "UTF-8");
            $www = $_GET['www'];
            //SPRAWDZANIE CZY JEST JUŻ W BAZIE
            $check = $polaczenie->query("SELECT * FROM `szkoly` WHERE `NazwaSzkoly`='".$nazwaShl."' AND `Adres`='".$adres."' AND `WWW`='".$www."';");
            if($check->num_rows != 0){
                echo '<script>alert("Taki zawodnik już istnieje");</script>';
            }else{
                mysqli_query($polaczenie, "INSERT INTO `szkoly` (`NazwaSzkoly`, `Adres`, `WWW`) VALUES('".$nazwaShl."','".$adres."','".$www."');");
                $czynnosc = "Dodawanie szkoły";
            }
        }else if($tryb == "wczytajEdytujPkt"){
            echo include"edytujPunkty.php";
        }else if($tryb == "refreshEP"){
            $IDZaw = $_GET['IDZaw'];
            $NrRundy = $_GET['NrRundy'];
            echo include"editPoints.php";
        }else if($tryb == "EdytujPkt"){
            $Suma = $_GET['Suma'];
            $ilosc10 = $_GET['ilosc10'];
            $nrRundy = $_GET['nrRundy'];
            $zawodnik = $_GET['zawodnik'];

            mysqli_query($polaczenie, "UPDATE `punkty` SET `Suma`='".$Suma."', `Ilosc_10`='".$ilosc10."' WHERE `ID_zaw`='".$zawodnik."' AND `ID_Rundy`='".$nrRundy."';");
        }
        @logi($czynnosc, $polaczenie);
    }
?>
