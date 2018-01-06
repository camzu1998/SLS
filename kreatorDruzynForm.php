<?php
$IDD = $_GET['druzyny'];
$konkursRezultat = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$IDD."';");
$wiersz = $konkursRezultat->fetch_assoc();
    $konkurs = $wiersz['konkurs'];
    $idShl = $wiersz['ID_szkoly'];
function zawodnicy($rezultat){
    for($i=0;$i<$rezultat->num_rows;$i++){
        $wiersz = $rezultat->fetch_assoc();
            $id = $wiersz['ID_zawodnika'];
            $imieNazwisko = $wiersz['Imie Nazwisko'];
            $idDruzyny = $wiersz['ID_druzyny'];
        echo '<option value="'.$id.'">'.$imieNazwisko.'</option>';
    }
}
?>
<input type="text" placeholder="Wyszukaj zawodnika" oninput="w3.filterHTML('.Zawodnicy', 'option', this.value)" style="width: auto !important;"/> <br>
<select name="zawodnik1" id="zawodnik1" class="Zawodnicy" required>
<?php
    $zawodnik = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_druzyny` = '".$IDD."';");
    $wiersz = $zawodnik->fetch_assoc();
        $id1 = $wiersz['ID_zawodnika'];
        $imieNazwisko1 = $wiersz['Imie Nazwisko'];
    echo'<option value="'.$id1.'">'.$imieNazwisko1.'</option>';

    if($konkurs == 1){
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='M' AND `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }else{
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }
    zawodnicy($rezultat);
?>
</select>
<select name="zawodnik2" id="zawodnik2" class="Zawodnicy" required>
<?php
    $wiersz = $zawodnik->fetch_assoc();
        $id1 = $wiersz['ID_zawodnika'];
        $imieNazwisko1 = $wiersz['Imie Nazwisko'];
    echo'<option value="'.$id1.'">'.$imieNazwisko1.'</option>';

    if($konkurs == 1){
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='M' AND `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }else{
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }
    zawodnicy($rezultat);
?>
</select>
<select name="zawodnik3" id="zawodnik3" class="Zawodnicy" required>
<?php
    $wiersz = $zawodnik->fetch_assoc();
        $id1 = $wiersz['ID_zawodnika'];
        $imieNazwisko1 = $wiersz['Imie Nazwisko'];
    echo'<option value="'.$id1.'">'.$imieNazwisko1.'</option>';

    if($konkurs == 1){
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='M' AND `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }else{
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }
    zawodnicy($rezultat);
?>
</select>
<br>
<select name="zawodnik4" id="zawodnik4" class="Zawodnicy" required>
<?php
    $wiersz = $zawodnik->fetch_assoc();
        $id1 = $wiersz['ID_zawodnika'];
        $imieNazwisko1 = $wiersz['Imie Nazwisko'];
    echo'<option value="'.$id1.'">'.$imieNazwisko1.'</option>';

    if($konkurs == 1){
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='K' AND `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }else{
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }
    zawodnicy($rezultat);
?>
</select>
<select name="zawodnik5" id="zawodnik5" class="Zawodnicy" required>
<?php
    $wiersz = $zawodnik->fetch_assoc();
        $id1 = $wiersz['ID_zawodnika'];
        $imieNazwisko1 = $wiersz['Imie Nazwisko'];
    echo'<option value="'.$id1.'">'.$imieNazwisko1.'</option>';

    if($konkurs == 1){
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='K' AND `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }else{
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }
    zawodnicy($rezultat);
?>
</select>
<select name="zawodnik6" id="zawodnik6" class="Zawodnicy" required>
<?php
    $wiersz = $zawodnik->fetch_assoc();
        $id1 = $wiersz['ID_zawodnika'];
        $imieNazwisko1 = $wiersz['Imie Nazwisko'];
    echo'<option value="'.$id1.'">'.$imieNazwisko1.'</option>';

    if($konkurs == 1){
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `Plec`='K' AND `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }else{
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_druzyny` != '".$IDD."' AND `ID_szkoly`='".$idShl."'");
    }
    zawodnicy($rezultat);
?>
</select>
<br>
