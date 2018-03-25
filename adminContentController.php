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
        }else if($tryb == "CheckTeamPts"){
            $nrRundy = $_GET['runda'];
            $zawodnik = $_GET['zawodnik'];

            $zawodnikInf = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$zawodnik."';");
            $wiersz = $zawodnikInf->fetch_assoc();
                $IDD = $wiersz['ID_druzyny'];
            $pktZawodnika = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw`='".$zawodnik."' AND `ID_Rundy`='".$nrRundy."';");
            $wierszPkt = $pktZawodnika->fetch_assoc();
                $punkty = $wierszPkt['Suma'];
            $druzyna = $polaczenie->query("SELECT * FROM `pktdruzyny` WHERE `ID_druzyny`='".$IDD."' AND `ID_rundy`='".$nrRundy."';");
            if($druzyna->num_rows != 0){
                $wiersz = $druzyna->fetch_assoc();
                    $SumaPkt = $wiersz['SumaPkt'];
                $SumaPkt -= $punkty;
            }else{
                $SumaPkt = 0;
            }
            echo $SumaPkt;
        }else if($tryb == "DodajPkt"){
            //POBIERANIE ZMIENNYCH
            $x=1;
            for($i=0;$i<10;$i++){
                $pkt[$i] = $_GET['pkt'.$x];
                $x++;
            }
            $idZawodnika = $_GET['zawodnik'];
            $Suma = $_GET['Suma'];
            $Ilosc10 = $_GET['ilosc10'];
            $nrRundy = $_GET['nrRundy'];
            $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika` = '".$idZawodnika."';");
            $wiersz = $rezultat->fetch_assoc();
                $idDruzyny = $wiersz['ID_druzyny'];
                $Plec = $wiersz['Plec'];
            //SPRAWDZANIE CZY USER MA PKT W TEJ RUNDZIE
            $rezultatSecurityCheck = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw` = '".$idZawodnika."' AND `ID_Rundy` = '".$nrRundy."';");
            if($rezultatSecurityCheck->num_rows != 0){
                //Error
                $_SESSION['ErrorPtsExist'] = 1;
            }else{
                $_SESSION['PtsDone'] = 1;
                mysqli_query($polaczenie, "INSERT INTO `punkty` (`ID_zaw`, `Suma`, `pkt1`, `pkt2`, `pkt3`, `pkt4`, `pkt5`, `pkt6`, `pkt7`, `pkt8`, `pkt9`, `pkt10`, `Ilosc_10`, `ID_Rundy`, `Plec`) VALUES('".$idZawodnika."', '".$Suma."', '".$pkt[0]."', '".$pkt[1]."', '".$pkt[2]."', '".$pkt[3]."', '".$pkt[4]."', '".$pkt[5]."', '".$pkt[6]."', '".$pkt[7]."', '".$pkt[8]."', '".$pkt[9]."', '".$Ilosc10."', '".$nrRundy."', '".$Plec."');");
                //WPIS DO PKT_M || PKT_K
                $rezultatIDP = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw`='".$idZawodnika."' AND `ID_Rundy`='".$nrRundy."' ");
                $wierszIDP = $rezultatIDP->fetch_assoc();
                    $IDP = $wierszIDP['ID'];
                if($Plec == 'M'){
                    mysqli_query($polaczenie, "INSERT INTO `pkt_m` (`IDP`, `IDZ`, `Suma`, `Ilosc_10`, `Miejsce`, `ID_Rundy`) VALUES ('".$IDP."', '".$idZawodnika."', '".$Suma."', '".$Ilosc10."', '0', '".$nrRundy."');");
                }else if($Plec == 'K'){
                    mysqli_query($polaczenie, "INSERT INTO `pkt_k` (`IDP`, `IDZ`, `Suma`, `Ilosc_10`, `Miejsce`, `ID_Rundy`) VALUES ('".$IDP."', '".$idZawodnika."', '".$Suma."', '".$Ilosc10."', '0', '".$nrRundy."');");
                }else{
                    $_SESSION['SEXERROR']=1;
                }
                //SPRAWDZANIE CZY DRUZYNA MA JUZ WPIS W TEJ RUNDZIE
                $rezultatDruz = $polaczenie->query("SELECT * FROM `pktdruzyny` WHERE `ID_druzyny`='".$idDruzyny."' AND `ID_rundy`='".$nrRundy."';");
                if($rezultatDruz->num_rows != 0){
                    $wierszDruz = $rezultatDruz->fetch_assoc();
                        $sumapkt = $wierszDruz['SumaPkt'];
                        $id = $wierszDruz['ID'];
                    $sumadruz = $Suma + $sumapkt;
                    mysqli_query($polaczenie, "UPDATE `pktdruzyny` SET `SumaPkt`='".$sumadruz."' WHERE `ID`='".$id."';");
                }else{
                    mysqli_query($polaczenie, "INSERT INTO `pktdruzyny` (`ID_druzyny`, `SumaPkt`, `ID_rundy`) VALUES ('".$idDruzyny."', '".$Suma."', '".$nrRundy."');");
                }
                //UZYSKANIE ID SEZONU
                $sezony = $polaczenie->query("SELECT * FROM `rundy` WHERE `ID`='".$nrRundy."';");
                $wierszRunda = $sezony->fetch_assoc();
                    $IDS = $wierszRunda['IdSezonu'];
                //SPRAWDZANIE CZY DRUŻYNA MA JUŻ WPIS W GPD
                $checkGPD = $polaczenie->query("SELECT * FROM `gpd` WHERE `ID_druzyny`='".$idDruzyny."' AND `ID_sez`='".$IDS."';");
                if($checkGPD->num_rows != 0){
                    $wierszGPD = $checkGPD->fetch_assoc();
                        $sumaGPD = $wierszGPD['SumaPkt'];
                    $sumaGPD += $Suma;
                    mysqli_query($polaczenie, "UPDATE `gpd` SET `SumaPkt`='".$sumaGPD."' WHERE `ID_druzyny`='".$idDruzyny."' AND `ID_sez`='".$IDS."';");
                }else{
                    mysqli_query($polaczenie, "INSERT INTO `gpd` (`ID_druzyny`, `ID_sez`, `SumaPkt`) VALUES('".$idDruzyny."', '".$IDS."' ,'".$Suma."');");
                }
                //WPIS DO PKT GEN
                //SPRAWDZANIE CZY TRZEBA UTWORZYC WPIS
                $rezultatCR = $polaczenie->query("SELECT * FROM `pkt_gen` WHERE `ID_zaw`='".$idZawodnika."' AND `ID_sez`='".$IDS."';");
                if($rezultatCR->num_rows != 0){
                    //DOPISANIE PKT
                    //POBRANIE AKTUALNEJ SUMY
                    $wierszGP = $rezultatCR->fetch_assoc();
                        $SumaGP = $wierszGP['Suma'];
                    //DODANIE
                    $SumaGP += $Suma;
                    //AKTUALIZACJA
                    mysqli_query($polaczenie, "UPDATE `pkt_gen` SET `Suma`='".$SumaGP."' WHERE `ID_zaw`='".$idZawodnika."' AND `ID_sez`='".$IDS."';");
                }else{
                    //TWORZENIE WPISU
                    mysqli_query($polaczenie, "INSERT INTO `pkt_gen` (`ID_zaw`, `Suma`, `ID_sez`) VALUES ('".$idZawodnika."', '".$Suma."', '".$IDS."');");
                }
            }
            echo "Done";
        }else if($tryb == "wczytajNowaRunda"){
            echo include"nowaRunda.php";
        }else if($tryb == "NowaRunda"){
            //POBIERANIE ZMIENNYCH
            $_SESSION['NowaRunda']=1;
            $nazwaShl = mb_convert_case($_GET['NazwaShl'], MB_CASE_TITLE, "UTF-8");
            $idSez = $_GET['NazwaSez'];
            $Data = $_GET['Data'];
            //DODAWANIE DO TABELI
            mysqli_query($polaczenie, "INSERT INTO `rundy` (`IdSezonu`, `NazwaShl`, `Data`) VALUES('".$idSez."', '".$nazwaShl."', '".$Data."');");
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
            //IDD
            $IDD = $_GET['druzyna'];
            //RESZTA DANYCH
            $Plec = $_REQUEST['Plec'];
            mysqli_query($polaczenie, "UPDATE `zawodnicy` SET `Imie Nazwisko`='".$ImieNazwisko."',`ID_druzyny`='".$IDD."',`Plec`='".$Plec."' WHERE `ID_zawodnika`='".$Idzaw."';");
            $czynnosc ="Edycja zawodnika";
            $_SESSION['PlayerEdit']=1;
        }else if($tryb == "UsunZawodnika"){
            $IDZaw = $_GET['IDZaw'];
            mysqli_query($polaczenie, "DELETE FROM `zawodnicy` WHERE `ID_zawodnika`='".$IDZaw."';");
            mysqli_query($polaczenie, "DELETE FROM `punkty` WHERE `ID_zaw` ='".$IDZaw."';");
            $_SESSION['PlayerDelete']=1;
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
            $_SESSION['TeamCreator']=1;

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
                $_SESSION['SchoolExist']=1;
            }else{
                mysqli_query($polaczenie, "INSERT INTO `szkoly` (`NazwaSzkoly`, `Adres`, `WWW`) VALUES('".$nazwaShl."','".$adres."','".$www."');");
                $czynnosc = "Dodawanie szkoły";
                $_SESSION['SchoolDone']=1;
            }
        }else if($tryb == "wczytajEdytujPkt"){
            echo include"edytujPunkty.php";
        }else if($tryb == "refreshEP"){
            $IDZaw = $_GET['IDZaw'];
            $NrRundy = $_GET['NrRundy'];
            echo include"editPoints.php";
        }else if($tryb == "EdytujPkt"){
            $Suma = $_GET['Suma'];
            $x=1;
            for($i=0;$i<10;$i++){
                $pkt[$i] = $_GET['pkt'.$x];
                $x++;
            }
            $ilosc10 = $_GET['ilosc10'];
            $nrRundy = $_GET['nrRundy'];
            $zawodnik = $_GET['zawodnik'];
            //Druzyna Zawodnika
            $druzyna = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$zawodnik."';");
            $wierszD = $druzyna->fetch_assoc();
                $IDD = $wierszD['ID_druzyna'];
            //Poprzednia suma pkt
            $BefPkt = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw`='".$zawodnik."' AND `ID_Rundy`='".$nrRundy."';");
            $wierszBP = $BefPkt->fetch_assoc();
                $BeforeSuma = $wierszBP['Suma'];
            //Aktualna wartość sumy druz
            $PtsTeam = $polaczenie->query("SELECT * FROM `pktdruzyny` WHERE `ID_druzyny`='".$IDD."' AND `ID_rundy`='".$nrRundy."';");
            $wierszPT = $PtsTeam->fetch_assoc();
                $SumaPkt = $wierszPT['SumaPkt'];
            //Odejmujemy stare pkt
            $SumaPkt -= $BeforeSuma;
            //Dodajemy nowe pkt
            $SumaPkt += $Suma;

            mysqli_query($polaczenie, "UPDATE `punkty` SET `Suma`='".$Suma."', `pkt1`='".$pkt[0]."', `pkt2`='".$pkt[1]."', `pkt3`='".$pkt[2]."', `pkt4`='".$pkt[3]."', `pkt5`='".$pkt[4]."', `pkt6`='".$pkt[5]."', `pkt7`='".$pkt[6]."', `pkt8`='".$pkt[7]."', `pkt9`='".$pkt[8]."', `pkt10`='".$pkt[9]."', `Ilosc_10`='".$ilosc10."' WHERE `ID_zaw`='".$zawodnik."' AND `ID_Rundy`='".$nrRundy."';");

            mysqli_query($polaczenie, "UPDATE `pktdruzyny` SET `SumaPkt`='".$SumaPkt."' WHERE `ID_druzyny`='".$IDD."' AND `ID_runda`='".$nrRundy."';");

            $czynnosc = "Edycja punktów zawodnika: ".$zawodnik;
            $_SESSION['EdycjaPkt']=1;
        }else if($tryb == "UsunPkt"){
            $IdRun = $_GET['IDrundy'];
            $IdZaw = $_GET['IDzaw'];
            //Druzyna Zawodnika
            $druzyna = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$IdZaw."';");
            $wierszD = $druzyna->fetch_assoc();
                $IDD = $wierszD['ID_druzyna'];
            //Punkty do usuniecia
            $BefPkt = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw`='".$IdZaw."' AND `ID_Rundy`='".$IdRun."';");
            $wierszBP = $BefPkt->fetch_assoc();
                $BeforeSuma = $wierszBP['Suma'];
            //Punkty druzyny
            $PtsTeam = $polaczenie->query("SELECT * FROM `pktdruzyny` WHERE `ID_druzyny`='".$IDD."' AND `ID_rundy`='".$IdRun."';");
            $wierszPT = $PtsTeam->fetch_assoc();
                $SumaPkt = $wierszPT['SumaPkt'];
            $SumaPkt -= $BeforeSuma;
            //AKTUALIZACJA W BAZIE
            mysqli_query($polaczenie, "UPDATE `pktdruzyny` SET `SumaPkt`='".$SumaPkt."' WHERE `ID_druzyny`='".$IDD."' AND `ID_runda`='".$IdRun."';");
            mysqli_query($polaczenie, "DELETE FROM `punkty` WHERE `ID_zaw` ='".$IdZaw."' AND `ID_Rundy`='".$IdRun."'");
            $_SESSION['PtsDelete'] = 1;
            $czynnosc = "Usuwanie pkt zawodnika: ".$zawodnik;
        }else if($tryb == "wczytajEdytujDruz"){
            echo include"edytujDruzyne.php";
        }else if($tryb == "refreshED"){
            $druzyna = $_GET['druzyna'];
            echo include"editTeam.php";
        }else if($tryb == "EdytujDruz"){
            $druzyna = $_GET['druzyna'];
            $nazwa = $_GET['nazwa'];
            $konkurs = $_GET['konkurs'];
            $szkola = $_GET['szkola'];

            mysqli_query($polaczenie, "UPDATE `druzyny` SET `NazwaDruzyny`='".$nazwa."', `konkurs`='".$konkurs."', `ID_szkoly`='".$szkola."' WHERE `ID_druzyny` = '".$druzyna."' ;");
            $_SESSION['TeamUpdate'] = 1;
        }else if($tryb == "UsunDruz"){
            $druzyna = $_GET['druzyna'];
            //USUWANIE DRUZYNY
            mysqli_query($polaczenie, "DELETE FROM `druzyny` WHERE `ID_druzyny` ='".$druzyna."';");
            mysqli_query($polaczenie, "DELETE FROM `pktdruzyny` WHERE `ID_druzyny` ='".$druzyna."';");
            mysqli_query($polaczenie, "DELETE FROM `gpd` WHERE `ID_druzyny` ='".$druzyna."'; ");
            mysqli_query($polaczenie, "UPDATE `zawodnicy` SET `ID_druzyny` ='0' WHERE `ID_druzyny` ='".$druzyna."';");
            $_SESSION['TeamDelete'] = 1;
        }else if($tryb == "wczytajEdytujSzkole"){
            echo include"edytujSzkole.php";
        }else if($tryb == "refreshES"){
            $szkola = $_GET["szkola"];
            echo include"editSchool.php";
        }else if($tryb == "EdytujShl"){
            $szkola = $_GET["szkola"];
            $nazwaSzkola = $_GET["nazwaSzkola"];
            $WWW = $_GET["www"];
            $Adres = $_GET["adres"];

            mysqli_query($polaczenie, "UPDATE `szkoly` SET `NazwaSzkoly`='".$nazwaSzkola."', `Adres`='".$Adres."', `WWW`='".$WWW."' WHERE `ID`='".$szkola."';");
            //FLAGA
            $_SESSION['UpdateShl']=1;
        }else if($tryb == "UsunShl"){
            $szkola = $_GET["szkola"];

            //USUWANIE Z TABELI SZKOLA
            mysqli_query($polaczenie, "DELETE FROM `szkoly` WHERE `ID`='".$szkola."';");
            //USUWANIE DRUZYN I ICH DANYCH
            $rezultatDruz = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_szkoly`='".$szkola."';");
            for($i=0;$i<$rezultatDruz->num_rows;$i++){
                $wierszDruz = $rezultatDruz->fetch_assoc();
                    $IDD = $wierszDruz['ID_druzyny'];
                mysqli_query($polaczenie, "DELETE FROM `pktdruzyny` WHERE `ID_druzyny` ='".$IDD."';");
                mysqli_query($polaczenie, "DELETE FROM `gpd` WHERE `ID_druzyny` ='".$IDD."'; ");
            }
            mysqli_query($polaczenie, "DELETE FROM `druzyny` WHERE `ID_szkoly`='".$szkola."';");
            //USUWANIE ZAWODNIKÓW
            $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_szkoly`='".$szkola."';");
            for($x=0;$x<$rezultat->num_rows;$x++){
                $wiersz = $rezultat->fetch_assoc();
                    $ID = $wiersz['ID_zawodnika'];
                mysqli_query($polaczenie, "DELETE FROM `punkty` WHERE `ID_zaw` ='".$ID."';");
            }
            mysqli_query($polaczenie, "DELETE FROM `zawodnicy` WHERE `ID_szkoly`='".$szkola."';");
            //FLAGA
            $_SESSION['DeleteShl']=1;
        }else if($tryb == "wczytajDodajSez"){
            echo include "dodajSezon.php";
        }else if($tryb == "DodajSezon"){
            $nazwa = $_GET['nazwa'];
            //ZABEZPIECZENIE PRZED TAKA SAMA NAZWA
            $rezultat = $polaczenie->query("SELECT * FROM `seozny` WHERE `Data`='".$nazwa."';");
            if($rezultat->num_rows != 0){
                //ERROR
                $_SESSION['SezonExist'] = 1;
            }else{
                mysqli_query($polaczenie, "UPDATE `sezony` SET `Zakonczony`='1' WHERE 1");
                mysqli_query($polaczenie, "INSERT INTO `sezony` (`Data`, `Zakonczony`) VALUES ('".$nazwa."', '0');");
                $_SESSION['DodajSezon'] = 1;
            }
        }else if($tryb == "wczytajEdytujSez"){
            echo include "edytujSezon.php";
        }else if($tryb == "refreshESEZ"){
            $sezon = $_GET['sezon'];
            echo include "editSeason.php";
        }else if($tryb == "EdytujSezon"){
            $nazwa = $_GET['nazwa'];
            $sezon = $_GET['sezon'];
            //ZABEZPIECZENIE PRZED TAKA SAMA NAZWA
            $rezultat = $polaczenie->query("SELECT * FROM `seozny` WHERE `Data`='".$nazwa."';");
            if($rezultat->num_rows != 0){
                //ERROR
                $_SESSION['SezonExist'] = 1;
            }else{
                mysqli_query($polaczenie, "UPDATE `sezony` SET `Data` = '".$nazwa."' WHERE `ID`='".$sezon."';");
                $_SESSION['UpdateSezon'] = 1;
            }
        }else if($tryb == "UsunSezon"){
            //DANE
            $IDS = $_GET['sezon'];
            //USUWANIE PKT
            mysqli_query($polaczenie, "DELETE FROM `gpd` WHERE `ID_sez`='".$IDS."';");
            $rundy = $polaczenie->query("SELECT * FROM `rundy` WHERE `IdSezonu`='".$IDS."';");
            for($i=0;$i<$rundy->num_rows;$i++){
                $wiersz = $rundy->fetch_assoc();
                    $IDR = $wiersz['ID'];
                mysqli_query($polaczenie, "DELETE FROM `pktdruzyny` WHERE `ID_rundy`='".$IDR."';");
                mysqli_query($polaczenie, "DELETE FROM `punkty` WHERE `ID_Rundy`='".$IDR."';");
            }
            //USUWANIE RUND
            mysqli_query($polaczenie, "DELETE FROM `rundy` WHERE `IdSezonu`='".$IDS."';");
            //USUWANIE SEZONU
            mysqli_query($polaczenie, "DELETE FROM `sezony` WHERE `ID`='".$IDS."';");
            $_SESSION['DeleteSeason']=1;
        }else if($tryb == "wczytajEdytujRunde"){
            echo include "edytujRunde.php";
        }else if($tryb == "refreshER"){
            $IDR = $_GET['runda'];
            echo include "editRound.php";
        }else if($tryb == "EdytujRunde"){
            $IDR = $_GET['runda'];
            $nazwaShl = mb_convert_case($_GET['NazwaShl'], MB_CASE_TITLE, "UTF-8");
            $idSez = $_GET['NazwaSez'];
            $Data = $_GET['Data'];

            mysqli_query($polaczenie, "UPDATE `rundy` SET `IdSezonu`='".$idSez."', `NazwaShl`='".$nazwaShl."', `Data`='".$Data."' WHERE `ID`='".$IDR."';");
            $_SESSION['UpdateRound']=1;
        }else if($tryb == "UsunRunde"){
            $IDR = $_GET['runda'];
            //KASOWANIE PKT Z RUND
            mysqli_query($polaczenie, "DELETE FROM `punkty` WHERE `ID_Rundy`='".$IDR."';");
            mysqli_query($polaczenie, "DELETE FROM `pktdruzyny` WHERE `ID_rundy`='".$IDR."';");
            $_SESSION['DeleteRound']=1;
        }else if($tryb == "wczytajCheckPosition"){
            echo include "sprawdzanieMiejsca.php";
        }else if($tryb == "CheckPosition"){
            $runda = $_GET['runda'];
            $SecuCheck = $polaczenie->query("SELECT * FROM `pojedynki` WHERE `ID_rundy`='".$runda."';");
            if($SecuCheck->num_rows != 0){
                echo "Wciśnij przycisk Zamknij Okno!";
                $_SESSION['SprawdzanieError'] = 1;
            }else{
                echo include "checkposition.php";
            }
        }else if($tryb == "wczytajPojedynki"){
            echo include "wczytajPojedynki.php";
        }else if($tryb == "Pojedynek"){
            $IDP = $_GET['IDP'];
            echo include "pojedynek.php";
        }else if($tryb == "Wyniki"){
            $IDP = $_GET['IDP'];
            $IDZ = $_GET['Winner'];
            //POBRANIE INFORMACJI O POJEDYNKU
            $pojedynek = $polaczenie->query("SELECT * FROM `pojedynki` WHERE `ID`='".$IDP."';");
            $wierszP = $pojedynek->fetch_assoc();
                $IDZ1 = $wierszP['IDZ1'];
                $IDZ2 = $wierszP['IDZ2'];
                $IDR = $wierszP['ID_rundy'];
            //POBIERANIE INFORMACJI O ZAWODNIKACH
            $info1 = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$IDZ1."'");
            $wiersz = $info1->fetch_assoc();
                $Plec = $wiersz['Plec'];
            //MIEJSCA ZAWODNIKÓW
            if($Plec=='M'){
                $miejsce1 = $polaczenie->query("SELECT * FROM `pkt_m` WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                $wiersz1 = $miejsce1->fetch_assoc();
                    $pos1 = $wiersz1['Miejsce'];
                $miejsce2 = $polaczenie->query("SELECT * FROM `pkt_m` WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                $wiersz2 = $miejsce2->fetch_assoc();
                    $pos2 = $wiersz2['Miejsce'];
            }else{
                $miejsce1 = $polaczenie->query("SELECT * FROM `pkt_k` WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                $wiersz1 = $miejsce1->fetch_assoc();
                    $pos1 = $wiersz1['Miejsce'];
                $miejsce2 = $polaczenie->query("SELECT * FROM `pkt_k` WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                $wiersz2 = $miejsce2->fetch_assoc();
                    $pos2 = $wiersz2['Miejsce'];
            }
            if($IDZ == $IDZ1){
                //wygrał gracz 1
                if($pos1 < $pos2){
                    //gracz oboronił miejsce
                }else if($pos1 > $pos2){
                    //gracz awansuje
                    if($Plec=='M'){
                        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$pos2."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                        //degradacja
                        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$pos1."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                    }else{
                        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$pos2."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                        //degradacja
                        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$pos1."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                    }
                }else{
                    if($Plec=='M'){
                        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$pos2."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                        //degradacja
                        $pos1++;
                        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$pos1."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                    }else{
                        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$pos2."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                        //degradacja
                        $pos1++;
                        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$pos1."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                    }
                }
            }else{
                //wygrał gracz 2
                if($pos2 < $pos1){
                    //gracz oobronił pozycje
                }else if($pos2 > $pos1){
                    //gracz awansuje
                    if($Plec=='M'){
                        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$pos1."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                        //degradacja
                        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$pos2."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                    }else{
                        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$pos1."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                        //degradacja
                        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$pos2."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                    }
                }else{
                    if($Plec=='M'){
                        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$pos1."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                        //degradacja
                        $pos2++;
                        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$pos2."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                    }else{
                        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$pos1."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ2."';");
                        //degradacja
                        $pos2++;
                        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$pos2."' WHERE `ID_Rundy`='".$IDR."' AND `IDZ`='".$IDZ1."';");
                    }
                }
            }
            mysqli_query($polaczenie, "DELETE FROM `pojedynki` WHERE `ID`='".$IDP."';");
        }
        @logi($czynnosc, $polaczenie);
    }
?>
