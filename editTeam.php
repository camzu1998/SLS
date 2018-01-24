<?php
    $IDD = $_GET['druzyna'];
    $rezultat = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$IDD."';");
    $wiersz = $rezultat->fetch_assoc();
        $Nazwa = $wiersz['NazwaDruzyny'];
        $konkurs = $wiersz['konkurs'];
        $IDS = $wiersz['ID_szkoly'];
?>
<form method="get" id="ETForm"><br>
    <span>Wybierz szkołę:</span>
    <select id="szkola" name="szkola" style="width: -webkit-fill-available;">
    <?php
        $first = $polaczenie->query("SELECT * FROM `szkoly` WHERE `ID` = '".$IDS."';");
        if($first->num_rows != 0){
            $wierszf = $first->fetch_assoc();
                $nazwaShl = $wierszf['NazwaSzkoly'];
                $ID = $wierszf['ID'];
            echo '<option value="'.$ID.'">'.$nazwaShl.'</option>';
        }

        $rezultat = $polaczenie->query("SELECT * FROM `szkoly` WHERE `ID` != '".$IDS."';");
        if($rezultat->num_rows != 0){
            for($i=0;$i<$rezultat->num_rows;$i++){
                $wiersz = $rezultat->fetch_assoc();
                    $nazwaShl = $wiersz['NazwaSzkoly'];
                    $ID = $wiersz['ID'];
                echo '<option value="'.$ID.'">'.$nazwaShl.'</option>';
            }
        }
    ?>
    </select><br>
    <span>Nazwa drużyny:</span>
    <input type="text" name="Nazwa" id="Nazwa" style="width: auto !important;" value="<?php echo $Nazwa; ?>" required/> <br>
    <span>Bierze udział w konkursie:</span><br>
    <p>Tak</p>
    <input type="radio" name="konkurs" value="1" <?php if($konkurs == 1){ echo 'checked';} ?>/> <br>
    <p>Nie</p>
    <input type="radio" name="konkurs" value="0" <?php if($konkurs == 0){ echo 'checked';} ?>/> <br>
</form>

