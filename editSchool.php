<?php
$szkola = $_GET['szkola'];
$rezultat = $polaczenie->query("SELECT * FROM `szkoly` WHERE `ID`='".$szkola."';");
$wiersz = $rezultat->fetch_assoc();
    $nazwa = $wiersz['NazwaSzkoly'];
    $adres = $wiersz['Adres'];
    $www = $wiersz['WWW'];

?>
<form method="get">
    <span>Nazwa szkoły:</span>
    <input type="text" name="nazwaSzkola" id="nazwaSzkola" style="width: auto !important;" required value="<?php echo $nazwa; ?>"/> <br>
    <span>WWW:</span>
    <input type="text" name="WWW" id="WWW" style="width: auto !important;" value="<?php echo $adres; ?>"/> <br>
    <span>Adres:</span>
    <input type="text" name="Adres" id="Adres" style="width: auto !important;" required value="<?php echo $www; ?>"/> <br>
</form>
