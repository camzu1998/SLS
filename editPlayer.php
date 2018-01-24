<?php
    $idZaw = $_GET['IDZaw'];
    $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika` = '".$idZaw."';");
    $wiersz = $rezultat->fetch_assoc();
    $imieNazwisko = $wiersz['Imie Nazwisko'];
    $plec = $wiersz['Plec'];
    $druzyna = $wiersz['ID_druzyny'];
    $ID_szkoly = $wiersz['ID_szkoly'];
?>

<form method="get"><br>
    <span>Imię i Nazwisko</span>
    <input type="text" name="ImieNazwisko" id="ImieNazwisko" value="<?php echo $imieNazwisko; ?>"style="width: auto !important;" required/> <br>
    <span>Drużyna:</span>
    <select name="druzyna" id="druzyna" style="width: -webkit-fill-available;">
        <?php
            $rezultatDruz = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$druzyna."';");
            $wiersz = $rezultatDruz->fetch_assoc();
                $nazwa = $wiersz['NazwaDruzyny'];
            echo '<option value="'.$druzyna.'">'.$nazwa.'</option>';
            $rezultatDruz = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_szkoly`='".$ID_szkoly."' AND `ID_druzyny`!='".$druzyna."';");
            for($i=0;$i<$rezultatDruz->num_rows;$i++){
                $wiersz = $rezultatDruz->fetch_assoc();
                    $nazwa = $wiersz['NazwaDruzyny'];
                    $IDD = $wiersz['ID_druzyny'];
                echo '<option value="'.$IDD.'">'.$nazwa.'</option>';
            }

        ?>
        <option value="0">BRAK DRUŻYNY</option>
    </select>
    <span>Płeć:</span><br>
    <span>Mężyczyzna</span>
    <input type="radio" name="Plec" id="Plec" value="M" <?php if($plec == 'M'){ echo"checked"; } ?> /> <br>
    <span>Kobieta</span>
    <input type="radio" name="Plec" id="Plec" value="K" <?php if($plec == 'K'){ echo"checked"; } ?>/> <br>
</form>
