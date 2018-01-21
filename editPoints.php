<?php
    $IDZaw = $_GET['IDZaw'];
    $nrRundy = $_GET['NrRundy'];
    $rezultat = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw`='".$IDZaw."' AND `ID_rundy` = '".$nrRundy."';");
    $wiersz = $rezultat->fetch_assoc();
        $sumaPkt = $wiersz['Suma'];
        $ilosc_10 = $wiersz['Ilosc_10'];

?>
<form method="get">
    <br>
    <p>Suma pkt:</p>
    <input type="number" name="SumaPkt" id="SumaPkt" value="<?php echo $sumaPkt; ?>" />
    <p>Ilość 10:</p>
    <input type="number" name="ilosc10" id="ilosc10" value="<?php echo $ilosc_10; ?>" />
</form>
