<form method="GET"><br>
    <div class="four columns" style="margin-left: auto !important;">
        <input type="text" placeholder="Wyszukaj runde" oninput="w3.filterHTML('#runda', 'option', this.value)" style="width: auto !important;"/> <br>
        <select name="runda" id="runda" onchange="refreshER();">
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
        </select><br>
    </div>
    <div class="eight columns" id="formularz">

    </div>
    <button onclick="wyslijER();">Dalej</button>
    <button onclick="wyslijUR();" style="background-color: red;">Usuń</button>
    <button onclick="zakonczRunde();" style="background-color: red;">Zakończ rundę</button>
</form>
