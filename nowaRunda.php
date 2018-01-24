<form method="get"><br>
    <span>Wybierz sezon:</span>
    <select id="sezon" name="sezon">
    <?php
    $rezultat = $polaczenie->query("SELECT * FROM `sezony`  ORDER BY `ID` DESC");
    for($i=0;$i<$rezultat->num_rows;$i++){
        $wiersz = $rezultat->fetch_assoc();
            $nazwa = $wiersz['Data'];
            $ID = $wiersz['ID'];
        echo '<option value='.$ID.'>'.$nazwa.'</option>';
    }
    ?>
    </select><br>
    <span>Nazwa szkoły w której odbywa się runda:</span>
    <!-- <input type="text" name="nazwaShl" id="nazwaShl" style="width= 200px !important;" required/> -->
    <select name="nazwaShl" id="nazwaShl" style="width: -webkit-fill-available;">
        <?php
        $szkoly = $polaczenie->query("SELECT * FROM `szkoly` WHERE 1");
        for($i=0;$i<$szkoly->num_rows;$i++){
            $wiersz = $szkoly->fetch_assoc();
                $nazwa = $wiersz['NazwaSzkoly'];
            echo '<option value="'.$nazwa.'">'.$nazwa.'</option>';
        }
        ?>
    </select><br>
    <span>Data:</span>
    <input type="date" name="Data" id="Data"/>
    <button onclick="wyslijNR();">Rozpocznij nową rundę</button>
</form>
