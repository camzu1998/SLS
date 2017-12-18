<?php
require_once "connect.php";
@$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
@$polaczenie->set_charset("utf8");
@$polaczenie->query("SET CHARACTER_SET utf8_polish_ci");
if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
} else {
    function wyswietlanie($Nazwa, $ID, $IDR){
        /* ZMIENNE POMOCNICZE */
        $KIC = "Klasyfikacja indywidualna chłopców";
        $KID = "Klasyfikacja indywidualna dziewcząt";
        $KD = "Klasyfikacja drużynowa";
        $KDPK = "Klasyfikacja drużynowa poza konkursem";
        $KDG = "Klasyfikacja drużynowa generalna";
        $KGIC = "Klasyfikacja generalna indywidualna chłopców";
        $KGID = "Klasyfikacja generalna indywidualna dziewcząt";

        echo '<li><a href="kic.php?id='.$ID.'&runda='.$IDR.'">'.$KIC." ".$Nazwa.'</a></li>';
        echo '<li><a href="">'.$KID." ".$Nazwa.'</a></li>';
        echo '<li><a href="">'.$KD." ".$Nazwa.'</a></li>';
        echo '<li><a href="">'.$KDPK." ".$Nazwa.'</a></li>';
        echo '<li><a href="">'.$KDG." ".$Nazwa.'</a></li>';
        echo '<li><a href="">'.$KGIC." ".$Nazwa.'</a></li>';
        echo '<li><a href="">'.$KGID." ".$Nazwa.'</a></li>';
    }

    @$IdSezonu = @$_GET['id'];
    $zapytanie = $polaczenie->query("SELECT * FROM `rundy` ORDER BY `ID` DESC");
    $wiersz = $zapytanie->fetch_assoc();
        $IDR = $wiersz['ID'];

    if($IdSezonu == null){
        /*SPRAWDZENIE AKTUALNEGO SEZONU */
        $aktywny = $polaczenie->query("SELECT * FROM `sezony` WHERE `Zakonczony` = 0;");
        $wiersz = $aktywny->fetch_assoc();
            $ID = $wiersz['ID'];
            $Nazwa = $wiersz['Data'];
        $_SESSION['wybranySezon'] = $ID;
        wyswietlanie($Nazwa,$ID,$IDR);
    }else{
        $aktywny = $polaczenie->query("SELECT * FROM `sezony` WHERE `ID` = ".$IdSezonu.";");
        $wiersz = $aktywny->fetch_assoc();
            $ID = $wiersz['ID'];
            $Nazwa = $wiersz['Data'];
        $_SESSION['wybranySezon'] = $ID;
        wyswietlanie($Nazwa,$ID,$IDR);
    }
}
