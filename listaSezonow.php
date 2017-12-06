<?php
session_start();
require_once "connect.php";
@$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
@$polaczenie->set_charset("utf8");
@$polaczenie->query("SET CHARACTER_SET utf8_polish_ci");
if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
} else {
    @$IdSezonu = @$_GET['id'];
    if(@$IdSezonu != null){
        $wybrany = $polaczenie->query("SELECT * FROM `sezony` WHERE `ID` = ".$IdSezonu.";");
        $reszta = $polaczenie->query("SELECT * FROM `sezony` WHERE `ID` != ".$IdSezonu.";");
        $wiersz = $wybrany->fetch_assoc();
            $Nazwa = $wiersz['Data'];
            $ID = $wiersz['ID'];
            $Zakonczony = $wiersz['Zakonczony'];
        echo '<div class="menuSez">';
            echo '<a class="first" href="index.php?id='.$ID.'">'.$Nazwa.'</a>';
            echo '<div class="menuContent">';
            for($i=0;$i<$reszta->num_rows;$i++){
                $wiersz = $reszta->fetch_assoc();
                $ID = $wiersz['ID'];
                $Nazwa = $wiersz['Data'];
                $Zakonczony = $wiersz['Zakonczony'];
                echo '<a href="index.php?id='.$ID.'">'.$Nazwa.'</a>';
            }
    }else{
        $ileSez = $polaczenie->query("SELECT * FROM `sezony` WHERE `Zakonczony` != 0;");
        $aktywny = $polaczenie->query("SELECT * FROM `sezony` WHERE `Zakonczony` = 0;");
        $wiersz = $aktywny->fetch_assoc();
            $Nazwa = $wiersz['Data'];
            $ID = $wiersz['ID'];
            $Zakonczony = $wiersz['Zakonczony'];
        echo '<div class="menuSez">';
            echo '<a class="first" href="index.php?id='.$ID.'">'.$Nazwa.'</a>';
            echo '<div class="menuContent">';
            for($i=0;$i<$ileSez->num_rows;$i++){
                $wiersz = $ileSez->fetch_assoc();
                $ID = $wiersz['ID'];
                $Nazwa = $wiersz['Data'];
                $Zakonczony = $wiersz['Zakonczony'];
                echo '<a href="index.php?id='.$ID.'">'.$Nazwa.'</a>';
            }
    }
        echo '</div>';
    echo '</div>';
}
