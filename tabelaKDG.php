<?php
require_once "connect.php";
@$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
@$polaczenie->set_charset("utf8");
@$polaczenie->query("SET CHARACTER_SET utf8_polish_ci");
if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
} else {
    $lp=1;
    @$IdSezonu = @$_GET['id'];
    if(@$IdSezonu != null){
        $rezultat = $polaczenie->query("SELECT * FROM `gpd` WHERE `ID_sez`='".$IdSezonu."' ORDER BY `SumaPkt` DESC");
        for($i=0;$i<$rezultat->num_rows;$i++){
            $wiersz = $rezultat->fetch_assoc();
                $IDD = $wiersz['ID_druzyny'];
                $Suma = $wiersz['SumaPkt'];
            $rezultatD = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$IDD."' AND `konkurs`='1';");
            if($rezultatD->num_rows != 0){
                $wiersz1 = $rezultatD->fetch_assoc();
                    $Nazwa = $wiersz1['NazwaDruzyny'];
                    $SHL = $wiersz1['ID_szkoly'];
                $rezultatShl = $polaczenie->query("SELECT * FROM `szkoly` WHERE `ID`='".$SHL."';");
                $wiersz2 = $rezultatShl->fetch_assoc();
                    $NazwaShl = $wiersz2['NazwaSzkoly'];
                echo "<tr><td>".$lp."</td><td>".$Nazwa."</td><td>".$Suma."</td><td>".$NazwaShl."</td></tr>";
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
        header('Location: kdg.php?id='.$ID);
    }
}
?>
