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
        $druzyna = $polaczenie->query("SELECT * FROM `druzyny` WHERE `konkurs`!=0");
        for($i=0;$i<$druzyna->num_rows;$i++){
            $wiersz = $druzyna->fetch_assoc();
                $IDD = $wiersz['ID_druzyny'];
                $nazwa = $wiersz['NazwaDruzyny'];
                $ID_shl = $wiersz['ID_szkoly'];
            $punkty = $polaczenie->query("SELECT * FROM `pktdruzyny` WHERE `ID_druzyny`='".$IDD."'");
            $SumaPkt = 0;
            for($x=0;$x<$punkty->num_rows;$x++){
                $wierszPKT = $punkty->fetch_assoc();
                    $pkt = $wierszPKT['SumaPkt'];
                $SumaPkt += $pkt;
            }
            $szkola = $polaczenie->query("SELECT * FROM `szkoly` WHERE `ID`='".$ID_shl."';");
            $wierszShl = $szkola->fetch_assoc();
                $nazwaSHL = $wierszShl['NazwaSzkoly'];
            echo "<tr><td>".$lp."</td><td>".$nazwa."</td><td>".$SumaPkt."</td><td>".$nazwaSHL."</td></tr>";
            $lp++;
        }
    }else{
        $runda = $polaczenie->query("SELECT * FROM `rundy` ORDER BY `ID` DESC LIMIT 1");
        $wiersz = $runda->fetch_assoc();
            $IDRundy = $wiersz['ID'];
        $aktywny = $polaczenie->query("SELECT * FROM `sezony` WHERE `Zakonczony` = 0;");
        $wiersz = $aktywny->fetch_assoc();
            $ID = $wiersz['ID'];
        header('Location: kdg.php?id='.$ID);
    }
}
?>
