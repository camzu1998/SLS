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
        $lp=1;
        //Wybiera druzyne
        $zawodnik = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `plec`='M'");
        for($i=0;$i<$zawodnik->num_rows;$i++){
            $wiersz = $zawodnik->fetch_assoc();
                $ID = $wiersz['ID_zawodnika'];
                $nazwa = $wiersz['Imie Nazwisko'];
                $ID_shl = $wiersz['ID_szkoly'];
            $punkty = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw`='".$ID."'");
            $SumaPkt = 0;
            for($x=0;$x<$punkty->num_rows;$x++){
                $wierszPKT = $punkty->fetch_assoc();
                    $pkt = $wierszPKT['Suma'];
                $SumaPkt += $pkt;
            }
            $szkola = $polaczenie->query("SELECT * FROM `szkoly` WHERE `ID`='".$ID_shl."';");
            $wierszShl = $szkola->fetch_assoc();
                $nazwaSHL = $wierszShl['NazwaSzkoly'];
            echo '<tr><td>'.$lp."</td><td>".$nazwa."</td><td>".$SumaPkt."</td><td>".$nazwaSHL."</td></tr>";
            $lp++;
        }
    }else{
        $aktywny = $polaczenie->query("SELECT * FROM `sezony` WHERE `Zakonczony` = 0;");
        $wiersz = $aktywny->fetch_assoc();
            $ID = $wiersz['ID'];
        header('Location: kgic.php?id='.$ID);
    }
}
?>
