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
        $lp=1;
        $pktdruzyny = $polaczenie->query("SELECT * FROM `pktdruzyny` WHERE `ID_rundy`='".$IDRundy."' ORDER BY `SumaPkt` DESC");
        for($i=0;$i<$pktdruzyny->num_rows;$i++){
            $wiersz = $pktdruzyny->fetch_assoc();
                $IDD = $wiersz['ID_druzyny'];
                $SumaPkt = $wiersz['SumaPkt'];
            $druzyny = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$IDD."' AND `konkurs` != 1;");
            $wierszDruz = $druzyny->fetch_assoc();
                $nazwa = $wierszDruz['NazwaDruzyny'];
                $ID_shl = $wierszDruz['ID_szkoly'];
            $szkola = $polaczenie->query("SELECT * FROM `szkoly` WHERE `ID`='".$ID_shl."';");
            $wierszShl = $szkola->fetch_assoc();
                $nazwaSHL = $wierszShl['NazwaSzkoly'];
            if($nazwa != null){
                echo "<tr><td>".$lp."</td><td>".$nazwa."</td><td>".$SumaPkt."</td><td>".$nazwaSHL."</td></tr>";
                $lp++;
            }
        }
    }else{
        $runda = $polaczenie->query("SELECT * FROM `rundy` ORDER BY `ID` DESC LIMIT 1");
        $wiersz = $runda->fetch_assoc();
            $IDRundy = $wiersz['ID'];
        $aktywny = $polaczenie->query("SELECT * FROM `sezony` WHERE `Zakonczony` = 0;");
        $wiersz = $aktywny->fetch_assoc();
            $ID = $wiersz['ID'];
        header('Location: kdpk.php?id='.$ID);
    }
}
?>
