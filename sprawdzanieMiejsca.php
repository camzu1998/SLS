<form method="get">
    <span>Wybierz rundę: </span>
    <select id="runda" name="runda" required onchange="wyslijSM();">
        <option></option>
        <?php
        $rezultat = $polaczenie->query("SELECT * FROM `rundy` ORDER BY `ID` DESC");
        for($i=0;$i<$rezultat->num_rows;$i++){
            $wiersz = $rezultat->fetch_assoc();
                $ID = $wiersz['ID'];
                $Sezon = $wiersz['IdSezonu'];
            $lata = $polaczenie->query("SELECT * FROM `sezony` WHERE `ID`='".$Sezon."';");
            $wierszSez = $lata->fetch_assoc();
                $nazwa = $wierszSez['Data'];
            echo '<option value='.$ID.'>'.$ID.'('.$nazwa.')</option>';
        }
        ?>
    </select> <br>
    <span id="wynik"></span> <br>
    <button>Zamknij okno</button>
</form>
