<form method="GET"><br>
    <div class="four columns" style="margin-left: auto !important;">
        <input type="text" placeholder="Wyszukaj zawodnika" oninput="w3.filterHTML('#zawodnik', 'option', this.value)" style="width: auto !important;"/> <br>
        <select name="druzyna" id="druzyna" onchange="refreshED();" style="width: -webkit-fill-available;">
            <option></option>
            <?php
            $rezultat = $polaczenie->query("SELECT * FROM `druzyny` WHERE 1");
            for($i=0;$i<$rezultat->num_rows;$i++){
                $wiersz = $rezultat->fetch_assoc();
                    $id = $wiersz['ID_druzyny'];
                    $nazwa = $wiersz['NazwaDruzyny'];
                echo '<option value='.$id.'>'.$nazwa.'</option>';
            }
            ?>
        </select><br>
    </div>
    <div class="eight columns" id="formularz">

    </div>
    <button onclick="wyslijED();">Dalej</button>
    <button onclick="wyslijUD();" style="background-color: red;">Usuń</button>
</form>
