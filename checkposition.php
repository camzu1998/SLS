<?php
$runda = $_GET['runda'];
$x=1;
$zawodnicyM = $polaczenie->query("SELECT * FROM `pkt_m` WHERE `ID_Rundy`='".$runda."' ORDER BY `Suma` DESC;");
for($i=1;$i<=$zawodnicyM->num_rows;$i++){
    $wiersz1 = $zawodnicyM->fetch_assoc();
        $ID = $wiersz1['ID'];
        $IDP = $wiersz1['IDP'];
        $ID1 = $wiersz1['IDZ'];
        $Suma1 = $wiersz1['Suma'];
        $Ilosc101 = $wiersz1['Ilosc_10'];
        $Miejsce = $wiersz1['Miejsce'];
        $ID_Rundy = $wiersz1['ID_Rundy'];
    $rezultatM = $polaczenie->query("SELECT * FROM `pkt_m` WHERE `ID_Rundy`='".$runda."' ORDER BY `Suma` DESC LIMIT 999 OFFSET ".$i."");
    $wiersz3 = $rezultatM->fetch_assoc();
        $IDP = $wiersz3['IDP'];
        $ID2 = $wiersz3['IDZ'];
        $Suma2 = $wiersz3['Suma'];
        $Ilosc102 = $wiersz3['Ilosc_10'];
        $Miejsce = $wiersz3['Miejsce'];
        $ID_Rundy = $wiersz3['ID_Rundy'];
    if($Suma1 == $Suma2){
        if($Ilosc101 == $Ilosc102){
            mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
            mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
        }else if($Ilosc101 > $Ilosc102){
            //GRACZ1 MA MIEJSCE WYZEJ
            mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
            $x++;
            mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
        }else if($Ilosc101 < $Ilosc102){
            //GRACZ2 MA MIEJSCE WYZEJ
            mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
            $x++;
            mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
        }
    }else if($Suma1 > $Suma2){
        //GRACZ1 MA MIEJSCE WYZEJ
        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
        $x++;
        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
    }else if($Suma1 < $Suma2){
        //GRACZ2 MA MIEJSCE WYZEJ
        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
        $x++;
        mysqli_query($polaczenie, "UPDATE `pkt_m` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
    }
}

$x=1;
$zawodnicyK = $polaczenie->query("SELECT * FROM `pkt_k` WHERE `ID_Rundy`='".$runda."' ORDER BY `Suma` DESC;");
for($i=1;$i<=$zawodnicyK->num_rows;$i++){
    $wiersz1 = $zawodnicyK->fetch_assoc();
        $ID = $wiersz1['ID'];
        $IDP = $wiersz1['IDP'];
        $ID1 = $wiersz1['IDZ'];
        $Suma1 = $wiersz1['Suma'];
        $Ilosc101 = $wiersz1['Ilosc_10'];
        $Miejsce = $wiersz1['Miejsce'];
        $ID_Rundy = $wiersz1['ID_Rundy'];
    $rezultatK = $polaczenie->query("SELECT * FROM `pkt_k` WHERE `ID_Rundy`='".$runda."' ORDER BY `Suma` DESC LIMIT 999 OFFSET ".$i."");
    $wiersz3 = $rezultatK->fetch_assoc();
        $IDP = $wiersz3['IDP'];
        $ID2 = $wiersz3['IDZ'];
        $Suma2 = $wiersz3['Suma'];
        $Ilosc102 = $wiersz3['Ilosc_10'];
        $Miejsce = $wiersz3['Miejsce'];
        $ID_Rundy = $wiersz3['ID_Rundy'];
    if($Suma1 == $Suma2){
        if($Ilosc101 == $Ilosc102){
            mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
            mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
        }else if($Ilosc101 > $Ilosc102){
            //GRACZ1 MA MIEJSCE WYZEJ
            mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
            $x++;
            mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
        }else if($Ilosc101 < $Ilosc102){
            //GRACZ2 MA MIEJSCE WYZEJ
            mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
            $x++;
            mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
        }
    }else if($Suma1 > $Suma2){
        //GRACZ1 MA MIEJSCE WYZEJ
        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
        $x++;
        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
    }else if($Suma1 < $Suma2){
        //GRACZ2 MA MIEJSCE WYZEJ
        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID2."' AND `ID_Rundy`='".$runda."';");
        $x++;
        mysqli_query($polaczenie, "UPDATE `pkt_k` SET `Miejsce`='".$x."' WHERE `IDZ`='".$ID1."' AND `ID_Rundy`='".$runda."';");
    }
}


//PIERWSZE 6 MIEJSC DO POJEDYNKU
$zawodnikM = $polaczenie->query("SELECT * FROM `pkt_m` WHERE `ID_Rundy`='".$runda."' ORDER BY `Miejsce` DESC");
for($i=0;$i<$zawodnikM->num_rows;$i++){
    //BIERZEMY PKT 1 GRACZA
    $wiersz = $zawodnikM->fetch_assoc();
        $SumaPkt1 = $wiersz['Suma'];
        $Ilosc101 = $wiersz['Ilosc_10'];
        $Miejsce1 = $wiersz['Miejsce'];
        $ID1 = $wiersz['IDZ'];
    $checking = $polaczenie->query("SELECT * FROM `pkt_m` WHERE `ID_Rundy`='".$runda."' AND `IDZ`!='".$ID1."' AND `Miejsce`='".$Miejsce1."' ORDER BY `Suma` DESC LIMIT 6");
    if($checking->num_rows != 0){
        //POJEDYNEK DOSTĘPNY
        for($y=0;$y<$checking->num_rows;$y++){
            $wiersz2 = $checking->fetch_assoc();
                $Suma2 = $wiersz2['Suma'];
                $ID2 = $wiersz2['IDZ'];
                $Ilosc102 = $wiersz2['Ilosc_10'];
            $MultipleCheck = $polaczenie->query("SELECT * FROM `pojedynki` WHERE `IDZ1`='".$ID2."';");
            if($MultipleCheck->num_rows != 0){
                //BRAK WPISU
            }else{
                mysqli_query($polaczenie, "INSERT INTO `pojedynki` (`IDZ1`, `IDZ2`, `ID_rundy`) VALUES('".$ID1."', '".$ID2."', '".$runda."');");
            }
        }
    }
}
$zawodnikK = $polaczenie->query("SELECT * FROM `pkt_k` WHERE `ID_Rundy`='".$runda."' ORDER BY `Miejsce` DESC");
for($i=0;$i<$zawodnikK->num_rows;$i++){
    //BIERZEMY PKT 1 GRACZA
    $wiersz = $zawodnikK->fetch_assoc();
        $SumaPkt1 = $wiersz['Suma'];
        $Ilosc101 = $wiersz['Ilosc_10'];
        $Miejsce1 = $wiersz['Miejsce'];
        $ID1 = $wiersz['IDZ'];
    $checking = $polaczenie->query("SELECT * FROM `pkt_k` WHERE `ID_Rundy`='".$runda."' AND `IDZ`!='".$ID1."' AND `Miejsce`='".$Miejsce1."' ORDER BY `Suma` DESC LIMIT 6");
    if($checking->num_rows != 0){
        //POJEDYNEK DOSTĘPNY
        for($y=0;$y<$checking->num_rows;$y++){
            $wiersz2 = $checking->fetch_assoc();
                $Suma2 = $wiersz2['Suma'];
                $ID2 = $wiersz2['IDZ'];
                $Ilosc102 = $wiersz2['Ilosc_10'];
            $MultipleCheck = $polaczenie->query("SELECT * FROM `pojedynki` WHERE `IDZ1`='".$ID2."';");
            if($MultipleCheck->num_rows != 0){
                //BRAK WPISU
            }else{
                mysqli_query($polaczenie, "INSERT INTO `pojedynki` (`IDZ1`, `IDZ2`, `ID_rundy`) VALUES('".$ID1."', '".$ID2."', '".$runda."');");
            }
        }
    }
}
echo "Sprawdzanie zakończone!";
?>
