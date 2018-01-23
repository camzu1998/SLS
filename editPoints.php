<?php
    $IDZaw = $_GET['IDZaw'];
    $nrRundy = $_GET['NrRundy'];
    $rezultat = $polaczenie->query("SELECT * FROM `punkty` WHERE `ID_zaw`='".$IDZaw."' AND `ID_rundy` = '".$nrRundy."';");
    $wiersz = $rezultat->fetch_assoc();
        $sumaPkt = $wiersz['Suma'];
        $x=1;
        for($i=0;$i<10;$i++){
            $pkt[$i] = $wiersz['pkt'.$x];
            $x++;
        }
        $ilosc_10 = $wiersz['Ilosc_10'];

?>
<form method="get">
    <br>
    <span>Punkty: </span>
    <?php
    for($i=0;$i<10;$i++){
        echo '<input type="number" name="pkt'.$i.'" id="pkt'.$i.'" min="0" max="10" oninput="updateDP();" value="'.$pkt[$i].'" style="width: 80px !important;" required/>';
    }
    ?>
</form>
