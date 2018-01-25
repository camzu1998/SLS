<?php
$IDP = $_GET['IDP'];
$rezultat = $polaczenie->query("SELECT * FROM `pojedynki` WHERE `ID`='".$IDP."';");
$wiersz = $rezultat->fetch_assoc();
    $IDZ1 = $wiersz['IDZ1'];
    $IDZ2 = $wiersz['IDZ2'];
$zapytanie1 = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$IDZ1."';");
$wiersz1 = $zapytanie1->fetch_assoc();
    $ImieNazwisko1 = $wiersz1['Imie Nazwisko'];
$zapytanie2 = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$IDZ2."';");
$wiersz2 = $zapytanie2->fetch_assoc();
    $ImieNazwisko2 = $wiersz2['Imie Nazwisko'];
?>
<form method="get">
    <span>Wybierz wygranego:</span>
    <br>
    <div class="row">
        <div class="six columns"><?php echo $ImieNazwisko1; ?></div>
        <div class="six columns"><?php echo $ImieNazwisko2; ?></div>
    </div>
    <div class="row">
        <div class="six columns"><input type="radio" name="Winner" value="<?php echo $IDZ1; ?>" checked/></div>
        <div class="six columns"><input type="radio" name="Winner" value="<?php echo $IDZ2; ?>"/></div>
    </div>
</form>
