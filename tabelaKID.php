<?php
require_once "connect.php";
@$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
@$polaczenie->set_charset("utf8");
@$polaczenie->query("SET CHARACTER_SET utf8_polish_ci");
if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
} else {
    @$IdSezonu = @$_GET['id'];
    @$IDRundy = @$_GET['runda'];
    if(@$IdSezonu != null || @$IDRundy != null){
        $punkty = $polaczenie->query("SELECT * FROM `pkt_k` WHERE `ID_Rundy`='".$IDRundy."' ORDER BY `Miejsce` ASC;");
        for($i=0;$i<$punkty->num_rows;$i++){
            $wiersz = $punkty->fetch_assoc();
                $IDZaw = $wiersz['IDZ'];
                $Suma = $wiersz['Suma'];
                $Ilosc10 = $wiersz['Ilosc_10'];
                $Miejsce = $wiersz['Miejsce'];
            $zawodnik = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$IDZaw."' AND `Plec`='K';");
            $wiersz = $zawodnik->fetch_assoc();
                $nazwa = $wiersz['Imie Nazwisko'];
                $szkola = $wiersz['ID_szkoly'];
            $szkoly = $polaczenie->query("SELECT * FROM `szkoly` WHERE `ID`='".$szkola."';");
            $wiersz = $szkoly->fetch_assoc();
                $nazwaSHL = $wiersz['NazwaSzkoly'];
            if($nazwa != null){
                echo "<tr><td>".$Miejsce."</td><td>".$nazwa."</td><td>".$Suma."</td><td>".$nazwaSHL."</td></tr>";
            }
        }
    }else{
        $runda = $polaczenie->query("SELECT * FROM `rundy` ORDER BY `ID` DESC LIMIT 1");
        $wiersz = $runda->fetch_assoc();
            $IDRundy = $wiersz['ID'];
        $aktywny = $polaczenie->query("SELECT * FROM `sezony` WHERE `Zakonczony` = 0;");
        $wiersz = $aktywny->fetch_assoc();
            $ID = $wiersz['ID'];
        header('Location: kid.php?id='.$ID.'&runda='.$IDRundy);
    }
}
?>
