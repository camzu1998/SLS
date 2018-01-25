<?php
//PIERWSZE 6 MIEJSC DO POJEDYNKU
$zawodnik1 = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_Rundy`='1' ORDER BY `Suma` LIMIT 6");
for($i=0;$i<$zawodnik1->num_rows;$i++){
    //BIERZEMY PKT 1 GRACZA
    $wiersz = $zawodnik1->fetch_assoc();
        $SumaPkt1 = $wiersz['Suma'];
        $Ilosc101 = $wiersz['Ilosc_10'];
        $ID1 = $wiersz['ID_zaw'];
    //BIERZEMY PKT 2 GRACZA
    $wiersz2 = $zawodnik1->fetch_assoc();
        $SumaPkt2 = $wiersz2['Suma'];
        $Ilosc102 = $wiersz2['Ilosc_10'];
        $ID2 = $wiersz2['ID_zaw'];
    //SPRAWDZAMY CZY TYLE SAMO PKT
    if($SumaPkt1 == $SumaPkt2){
        //SPRAWDZAMY CZY TYLE SAMO 10
        if($Ilosc101 == $Ilosc102){
            if($ID1 != null && $ID2 != null){
                mysqli_query($polaczenie, "INSERT INTO `pojedynki` (`IDZ1`,`IDZ2`) VALUES('".$ID1."', '".$ID2."');");
                echo "Pojedynek dostępny!";
            }
        }else{
            echo "Brak pojedynku!";
        }
    }else{
        echo "Brak pojedynku!";
    }
}
$zawodnicy = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_Rundy`='1' ORDER BY `Suma` DESC;");
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
            mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID1."' AND `ID_Rundy`='1';");
            $x++;
            mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID2."' AND `ID_Rundy`='1';");
        }else{
            //GRACZ2 MA MIEJSCE WYZEJ
            mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID2."' AND `ID_Rundy`='1';");
            $x++;
            mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID1."' AND `ID_Rundy`='1';");
        }
    }else if($Suma1 > $Suma2){
        //GRACZ1 MA MIEJSCE WYZEJ
        mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID1."' AND `ID_Rundy`='1';");
        $x++;
        mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID2."' AND `ID_Rundy`='1';");
    }else{
        //GRACZ2 MA MIEJSCE WYZEJ
        mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID2."' AND `ID_Rundy`='1';");
        $x++;
        mysqli_query($polaczenie, "UPDATE `punkty` SET `Miejsce`='".$x."' WHERE `ID_zaw`='".$ID1."' AND `ID_Rundy`='1';");
    }
    echo "Kolejka";
}
?>
