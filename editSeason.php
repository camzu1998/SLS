<?php
$sezon = $_GET['sezon'];
$rezultat = $polaczenie->query("SELECT * FROM `sezony` WHERE `ID`='".$sezon."';");
$wiersz = $rezultat->fetch_assoc();
    $Data = $wiersz['Data'];
?>
<form method="get">
    <span>Data(np. 2017/2018):</span>
    <input type="text" name="nazwa" id="nazwa" style="width: auto !important;" value="<?php echo $Data; ?>" required/> <br>
</form>
