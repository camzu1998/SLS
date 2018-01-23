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

        echo '<div class="row">';
            echo '<div class="four columns window">';
                echo '<a href="kic.php?id='.$ID.'&runda='.$IDR.'">'.$KIC." ".$Nazwa.'</a>';
            echo '</div>';
            echo '<div class="four columns window">';
                echo '<a href="kid.php?id='.$ID.'&runda='.$IDR.'">'.$KID." ".$Nazwa.'</a>';
            echo '</div>';
            echo '<div class="four columns window">';
                echo '<a href="kd.php?id='.$ID.'">'.$KD." ".$Nazwa.'</a>';
            echo '</div>';
        echo '</div>';
        echo '<div class="row">';
            echo '<div class="four columns window">';
                echo '<a href="kdpk.php?id='.$ID.'&runda='.$IDR.'">'.$KDPK." ".$Nazwa.'</a>';
            echo '</div>';
            echo '<div class="four columns window">';
                echo '<a href="kdg.php?id='.$ID.'&runda='.$IDR.'">'.$KDG." ".$Nazwa.'</a>';
            echo '</div>';
            echo '<div class="four columns window" style="line-height: 50px;">';
                echo '<a href="kgic.php?id='.$ID.'">'.$KGIC." ".$Nazwa.'</a></li>';
            echo '</div>';
        echo '</div>';
        echo '<div class="row">';
            echo '<div class="four columns window" style="line-height: 50px;">';
                echo '<a href="kgid.php?id='.$ID.'">'.$KGID." ".$Nazwa.'</a>';
            echo '</div>';
        echo '</div>';
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
