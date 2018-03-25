<?php
require_once "connect.php";
@$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
@$polaczenie->set_charset("utf8");
@$polaczenie->query("SET CHARACTER_SET utf8_polish_ci");
if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
} else {
    @$IdSezonu = @$_GET['id'];
    if(@$IdSezonu != null){
        $lp = 1;
        $rezultatPkt = $polaczenie->query("SELECT * FROM `pkt_gen` WHERE `ID_sez`='".$IdSezonu."' ORDER BY `Suma` DESC;");
        for($i=0;$i<$rezultatPkt->num_rows;$i++){
            //Wybieramy dane
            $wiersz = $rezultatPkt->fetch_assoc();
                $IDZ = $wiersz['ID_zaw'];
                $Suma = $wiersz['Suma'];
            $rezultatPlec = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$IDZ."' AND `Plec`='K';");
            if($rezultatPlec->num_rows != 0){
                $wiersz1 = $rezultatPlec->fetch_assoc();
                    $ImieNazwisko = $wiersz1['Imie Nazwisko'];
                    $SHL = $wiersz1['ID_szkoly'];
                $rezultatSHL = $polaczenie->query("SELECT * FROM `szkoly` WHERE `ID`='".$SHL."';");
                $wiersz2 = $rezultatSHL->fetch_assoc();
                    $NazwaShl = $wiersz2['NazwaSzkoly'];
                echo "<tr><td>".$lp."</td><td>".$ImieNazwisko."</td><td>".$Suma."</td><td>".$NazwaShl."</td></tr>";
                $lp++;
            }
        }
    }else{
        $aktywny = $polaczenie->query("SELECT * FROM `sezony` WHERE `Zakonczony` = 0;");
        $wiersz = $aktywny->fetch_assoc();
            $ID = $wiersz['ID'];
        header('Location: kgic.php?id='.$ID);
    }
}
?>
