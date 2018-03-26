<?php
    $IDZaw = $_GET['IDZaw'];
    $nrRundy = $_GET['NrRundy'];
    $info1 = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$IDZaw."'");
    $wiersz = $info1->fetch_assoc();
        $Plec = $wiersz['Plec'];
    if($Plec == "M"){
        $rezultat = $polaczenie->query("SELECT * FROM `pkt_m` WHERE `IDZ`='".$IDZaw."' AND `ID_Rundy`='".$nrRundy."';");
    }else if($Plec == "K"){
        $rezultat = $polaczenie->query("SELECT * FROM `pkt_k` WHERE `IDZ`='".$IDZaw."' AND `ID_Rundy`='".$nrRundy."';");
    }
    $wiersz = $rezultat->fetch_assoc();
        $Miejsce = $wiersz['Miejsce'];
?>
<form method="get">
    <br>
    <span>Miejsce:</span>
    <input type="number" name="Miejsce" id="Miejsce" value="<?php echo $Miejsce ?>" min="1" />
</form>
