<?php
$IDD = $_GET['druzyny'];
$zawodnicy = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_Druzyny` = '".$IDD."';");
if($zawodnicy->num_rows != 0){
    for($i=0;$i<$zawodnicy->num_rows;$i++){
        $wiersz = $zawodnicy->fetch_assoc();
            $ImieNazwisko = $wiersz['Imie Nazwisko'];
    }
}else{
    function zawodnicy(){
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='M'");
        for($i=0;$i<$rezultat->num_rows;$i++){
            $wiersz = $rezultat->fetch_assoc();
                $id = $wiersz['ID_zawodnika'];
                $imieNazwisko = $wiersz['Imie Nazwisko'];
                $idDruzyny = $wiersz['ID_druzyny'];
            $rezultat2 = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$idDruzyny."';");
            $wiersz2 = $rezultat2->fetch_assoc();
                $nazwa = $wiersz2['NazwaDruzyny'];
            echo '<option value="'.$id.'">'.$imieNazwisko.'('.$nazwa.')</option>';
        }
    }
}
?>
<input type="text" placeholder="Wyszukaj zawodnika" oninput="w3.filterHTML('.Zawodnicy', 'option', this.value)" style="width: auto !important;"/> <br>
<select name="zawodnik1" id="zawodnik1" class="Zawodnicy" required>
    <option style="display: none;"></option>
<?php
    $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='M'");
    for($i=0;$i<$rezultat->num_rows;$i++){
        $wiersz = $rezultat->fetch_assoc();
            $id = $wiersz['ID_zawodnika'];
            $imieNazwisko = $wiersz['Imie Nazwisko'];
            $idDruzyny = $wiersz['ID_druzyny'];
        $rezultat2 = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$idDruzyny."';");
        $wiersz2 = $rezultat2->fetch_assoc();
            $nazwa = $wiersz2['NazwaDruzyny'];
        echo '<option value="'.$id.'">'.$imieNazwisko.'('.$nazwa.')</option>';
    }
?>
</select>
<select name="zawodnik2" id="zawodnik2" class="Zawodnicy" required>
    <option style="display: none;"></option>
<?php
    $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='M'");
    for($i=0;$i<$rezultat->num_rows;$i++){
        $wiersz = $rezultat->fetch_assoc();
            $id = $wiersz['ID_zawodnika'];
            $imieNazwisko = $wiersz['Imie Nazwisko'];
            $idDruzyny = $wiersz['ID_druzyny'];
        $rezultat2 = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$idDruzyny."';");
        $wiersz2 = $rezultat2->fetch_assoc();
            $nazwa = $wiersz2['NazwaDruzyny'];
        echo '<option value="'.$id.'">'.$imieNazwisko.'('.$nazwa.')</option>';
    }
?>
</select>
<select name="zawodnik3" id="zawodnik3" class="Zawodnicy" required>
    <option style="display: none;"></option>
<?php
    $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='M'");
    for($i=0;$i<$rezultat->num_rows;$i++){
        $wiersz = $rezultat->fetch_assoc();
            $id = $wiersz['ID_zawodnika'];
            $imieNazwisko = $wiersz['Imie Nazwisko'];
            $idDruzyny = $wiersz['ID_druzyny'];
        $rezultat2 = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$idDruzyny."';");
        $wiersz2 = $rezultat2->fetch_assoc();
            $nazwa = $wiersz2['NazwaDruzyny'];
        echo '<option value="'.$id.'">'.$imieNazwisko.'('.$nazwa.')</option>';
    }
?>
</select>
<br>
<select name="zawodnik4" id="zawodnik4" class="Zawodnicy" required>
    <option style="display: none;"></option>
<?php
    $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='K'");
    for($i=0;$i<$rezultat->num_rows;$i++){
        $wiersz = $rezultat->fetch_assoc();
            $id = $wiersz['ID_zawodnika'];
            $imieNazwisko = $wiersz['Imie Nazwisko'];
            $idDruzyny = $wiersz['ID_druzyny'];
        $rezultat2 = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$idDruzyny."';");
        $wiersz2 = $rezultat2->fetch_assoc();
            $nazwa = $wiersz2['NazwaDruzyny'];
        echo '<option value="'.$id.'">'.$imieNazwisko.'('.$nazwa.')</option>';
    }
?>
</select>
<select name="zawodnik5" id="zawodnik5" class="Zawodnicy" required>
    <option style="display: none;"></option>
<?php
    $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='K'");
    for($i=0;$i<$rezultat->num_rows;$i++){
        $wiersz = $rezultat->fetch_assoc();
            $id = $wiersz['ID_zawodnika'];
            $imieNazwisko = $wiersz['Imie Nazwisko'];
            $idDruzyny = $wiersz['ID_druzyny'];
        $rezultat2 = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$idDruzyny."';");
        $wiersz2 = $rezultat2->fetch_assoc();
            $nazwa = $wiersz2['NazwaDruzyny'];
        echo '<option value="'.$id.'">'.$imieNazwisko.'('.$nazwa.')</option>';
    }
?>
</select>
<select name="zawodnik6" id="zawodnik6" class="Zawodnicy" required>
    <option style="display: none;"></option>
<?php
    $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='K'");
    for($i=0;$i<$rezultat->num_rows;$i++){
        $wiersz = $rezultat->fetch_assoc();
            $id = $wiersz['ID_zawodnika'];
            $imieNazwisko = $wiersz['Imie Nazwisko'];
            $idDruzyny = $wiersz['ID_druzyny'];
        $rezultat2 = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$idDruzyny."';");
        $wiersz2 = $rezultat2->fetch_assoc();
            $nazwa = $wiersz2['NazwaDruzyny'];
        echo '<option value="'.$id.'">'.$imieNazwisko.'('.$nazwa.')</option>';
    }
?>
</select>
<br>
