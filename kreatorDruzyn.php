<form method="GET">
    <span>Wybierz drużyne</span>
    <input type="text" placeholder="Wyszukaj drużyne" oninput="w3.filterHTML('#druzyny', 'option', this.value)" style="width: auto !important;"/> <br>
    <select name="druzyny" id="druzyny" onchange="refreshDruzyny();">
        <option style="display:none;"></option>
        <?php
        $rezultat = $polaczenie->query("SELECT * FROM `druzyny` WHERE 1");
        for($i=0;$i<$rezultat->num_rows;$i++){
            $wiersz = $rezultat->fetch_assoc();
                $id = $wiersz['ID_druzyny'];
                $NazwaDruzyny = $wiersz['NazwaDruzyny'];
                $NazwaSzkoly = $wiersz['NazwaSzkoly'];
            echo '<option value='.$id.'>'.$NazwaDruzyny.'('.$NazwaSzkoly.')</option>';
        }
        ?>
    </select><br>
    <div id="formularz">

    </div>
    <button onclick="wyslijKD();">Stwórz drużynę</button>
</form>
