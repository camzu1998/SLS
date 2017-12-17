<?php
$idZaw = $_GET['IDZaw'];
$rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika` = '".$idZaw."';");
$wiersz = $rezultat->fetch_assoc();
$imieNazwisko = $wiersz['Imie Nazwisko'];
$plec = $wiersz['Plec'];
$druzyna = $wiersz['ID_druzyny'];
?>

<form method="get"><br>
    <span>Imię i Nazwisko</span>
    <input type="text" name="ImieNazwisko" id="ImieNazwisko" value="<?php echo $imieNazwisko; ?>"style="width: auto !important;" required/> <br>
    <span>Płeć:</span><br>
    <span>Mężyczyzna</span>
    <input type="radio" name="Plec" id="Plec" value="M" <?php if($plec == 'M'){ echo"checked"; } ?> /> <br>
    <span>Kobieta</span>
    <input type="radio" name="Plec" id="Plec" value="K" <?php if($plec == 'K'){ echo"checked"; } ?>/> <br>
</form>
