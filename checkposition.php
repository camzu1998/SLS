<?php
$runda = $_GET['runda'];
//PIERWSZE 6 MIEJSC DO POJEDYNKU
$zawodnik1 = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_Rundy`='".$runda."' ORDER BY `Suma` DESC LIMIT 6");
for($i=0;$i<$zawodnik1->num_rows;$i++){
    //BIERZEMY PKT 1 GRACZA
    $wiersz = $zawodnik1->fetch_assoc();
        $SumaPkt1 = $wiersz['Suma'];
        $Ilosc101 = $wiersz['Ilosc_10'];
        $ID1 = $wiersz['ID_zaw'];
    $checking = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_Rundy`='".$runda."' AND `ID_zaw`!='".$ID1."' AND `Suma`='".$SumaPkt1."' AND `Ilosc_10`='".$Ilosc101."' ORDER BY `Suma` DESC LIMIT 6");
    if($checking->num_rows != 0){
        //POJEDYNEK DOSTĘPNY
        for($y=0;$y<$checking->num_rows;$y++){
            $wiersz2 = $checking->fetch_assoc();
                $Suma2 = $wiersz2['Suma'];
                $ID2 = $wiersz2['ID_zaw'];
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
$zawodnicy = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_Rundy`='".$runda."' ORDER BY `Suma` DESC;");
for($x=1;$x<=$zawodnicy->num_rows;$x++){
    $wiersz1 = $zawodnicy->fetch_assoc();
        $Suma1 = $wiersz1['Suma'];
        $ID1 = $wiersz1['ID_zaw'];
        $Ilosc101 = $wiersz1['Ilosc_10'];
    $wiersz1 = $zawodnicy->fetch_assoc();
        $Suma2 = $wiersz1['Suma'];
        $ID2 = $wiersz1['ID_zaw'];
        $Ilosc102 = $wiersz1['Ilosc_10'];
    if($Suma1 == $Suma2){
        if($Ilosc101 > $Ilosc102){
            //GRACZ1 MA MIEJSCE WYZEJ
            mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID1."' AND `ID_Rundy`='".$runda."';");
            $x++;
            mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID2."' AND `ID_Rundy`='".$runda."';");
        }else{
            //GRACZ2 MA MIEJSCE WYZEJ
            mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID2."' AND `ID_Rundy`='".$runda."';");
            $x++;
            mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID1."' AND `ID_Rundy`='".$runda."';");
        }
    }else if($Suma1 > $Suma2){
        //GRACZ1 MA MIEJSCE WYZEJ
        mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID1."' AND `ID_Rundy`='".$runda."';");
        $x++;
        mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID2."' AND `ID_Rundy`='".$runda."';");
    }else{
        //GRACZ2 MA MIEJSCE WYZEJ
        mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID2."' AND `ID_Rundy`='".$runda."';");
        $x++;
        mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID1."' AND `ID_Rundy`='".$runda."';");
    }
}
echo "Sprawdzanie zakończone!";
?>
