<form method="GET"><br>
    <div class="four columns" style="margin-left: auto !important;">
        <input type="text" placeholder="Wyszukaj szkołe" oninput="w3.filterHTML('#szkola', 'option', this.value)" style="width: auto !important;"/> <br>
        <select name="szkola" id="szkola" onchange="refreshSZ();">
            <option></option>
            <?php
            $rezultat = $polaczenie->query("SELECT * FROM `szkoly` WHERE 1");
            for($i=0;$i<$rezultat->num_rows;$i++){
                $wiersz = $rezultat->fetch_assoc();
                    $id = $wiersz['ID'];
                    $NazwaSzkoly = $wiersz['NazwaSzkoly'];
                echo '<option value='.$id.'>'.$NazwaSzkoly.'</option>';
            }
            ?>
        </select><br>
    </div>
    <div class="eight columns" id="formularz">

    </div>
    <button onclick="wyslijES();">Dalej</button>
    <button onclick="wyslijUS();" style="background-color: red;">Usuń</button>
</form>
