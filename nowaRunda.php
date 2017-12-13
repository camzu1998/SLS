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
    <input type="text" name="nazwaShl" id="nazwaShl" style="width= 200px !important;"/>
    <button onclick="wyslijNR();">Rozpocznij nową rundę</button>
</form>
