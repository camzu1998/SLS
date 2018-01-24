<?php
$IDR = $_GET['runda'];
$rezultat = $polaczenie->query("SELECT * FROM `rundy` WHERE `ID`='".$IDR."';");
$wiersz = $rezultat->fetch_assoc();
    $NazwaShl = $wiersz['NazwaShl'];
    $IDS = $wiersz['IdSezonu'];
    $Data = $wiersz['Data'];
?>
<form method="get"><br>
    <span>Wybierz sezon:</span>
    <select id="sezon" name="sezon">
    <?php
        $first = $polaczenie->query("SELECT * FROM `sezony` WHERE `ID`='".$IDS."';");
        $wierszFirst = $first->fetch_assoc();
            $nazwa = $wierszFirst['Data'];
            $ID = $wierszFirst['ID'];
        echo '<option value='.$ID.'>'.$nazwa.'</option>';

        $rezultat = $polaczenie->query("SELECT * FROM `sezony` WHERE `ID`!='".$IDS."' ORDER BY `ID` DESC");
        for($i=0;$i<$rezultat->num_rows;$i++){
            $wiersz = $rezultat->fetch_assoc();
                $nazwa = $wiersz['Data'];
                $ID = $wiersz['ID'];
            echo '<option value='.$ID.'>'.$nazwa.'</option>';
        }
    ?>
    </select><br>
    <span>Nazwa szkoły w której odbywa się runda:</span>
    <select name="nazwaShl" id="nazwaShl">
        <?php
        $first = $polaczenie->query("SELECT * FROM `szkoly` WHERE `NazwaSzkoly`='".$NazwaShl."';");
        $wierszFirst = $first->fetch_assoc();
            $nazwa = $wierszFirst['NazwaSzkoly'];
        echo '<option value="'.$nazwa.'">'.$nazwa.'</option>';
        $szkoly = $polaczenie->query("SELECT * FROM `szkoly` WHERE `NazwaSzkoly`!='".$NazwaShl."';");
        for($i=0;$i<$szkoly->num_rows;$i++){
            $wiersz = $szkoly->fetch_assoc();
                $nazwa = $wiersz['NazwaSzkoly'];
            echo '<option value="'.$nazwa.'">'.$nazwa.'</option>';
        }
        ?>
    </select><br>
    <span>Data:</span>
    <input type="date" name="Data" id="Data" value="<?php echo $Data; ?>"/>
</form>
