<?php
require_once "connect.php";
@$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
@$polaczenie->set_charset("utf8");
@$polaczenie->query("SET CHARACTER_SET utf8_polish_ci");
if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
} else {
    @$IdSezonu = @$_GET['id'];
    if($IdSezonu != null){
        $zapytanie1 = $polaczenie->query("SELECT * FROM `rundy` WHERE `IdSezonu` = ".$IdSezonu.";");
        for($i=0;$i<$zapytanie1->num_rows;$i++){
            $wiersz = $zapytanie1->fetch_assoc();
                $IDRund[$i] = $wiersz['ID'];
        }
        /** MAMY ID WSZYSTKICH RUND **/
        $lp = 1;
        $zapytanie2 = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `plec` = 'M';");
        for($i=0;$i<$zapytanie2->num_rows;$i++){
            $wiersz = $zapytanie2->fetch_assoc();
                $IDZaw = $wiersz['ID_zawodnika'];
                $nazwa = $wiersz['Imie Nazwisko'];
                $idZespolu = $wiersz['ID_druzyny'];
            /** MAMY DANE ZAWODNIKA **/
            $zapytanie3 = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw` =".$IDZaw." AND `ID_Rundy` =".@$IDRund[$i].";");
            $wiersz = $zapytanie3->fetch_assoc();
                $punkty = $wiersz['Suma'];
                $ilosc_10 = $wiersz['Ilosc_10'];
            /** MAMY PUNKTY ZAWODNIKA **/
            $zapytanie4 = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`=".$idZespolu.";");
            $wiersz = $zapytanie4->fetch_assoc();
                $nazwaShl = $wiersz['NazwaSzkoly'];
            /** MAMY NAZWE SZKOLY **/
            echo "<tr><td>".$lp."</td><td>".$nazwa."</td><td>".$punkty."</td><td>".$nazwaShl."</td></tr>";
            $lp++;
        }


    }else{
        header('Location: kic.php?id=2');
    }
}
?>
