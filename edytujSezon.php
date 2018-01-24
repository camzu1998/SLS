<form method="GET"><br>
    <div class="four columns" style="margin-left: auto !important;">
        <input type="text" placeholder="Wyszukaj sezon" oninput="w3.filterHTML('#sezon', 'option', this.value)" style="width: auto !important;"/> <br>
        <select name="sezon" id="sezon" onchange="refreshESEZ();">
            <option></option>
            <?php
            $rezultat = $polaczenie->query("SELECT * FROM `sezony` WHERE 1");
            for($i=0;$i<$rezultat->num_rows;$i++){
                $wiersz = $rezultat->fetch_assoc();
                    $id = $wiersz['ID'];
                    $Data = $wiersz['Data'];
                echo '<option value='.$id.'>'.$Data.'</option>';
            }
            ?>
        </select><br>
    </div>
    <div class="eight columns" id="formularz">

    </div>
    <button onclick="wyslijESEZ();">Dalej</button>
    <button onclick="wyslijUSEZ();" style="background-color: red;">Usuń</button>
</form>
