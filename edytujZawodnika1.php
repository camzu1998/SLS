<form method="GET"><br>
    <div class="four columns" style="margin-left: auto !important;">
        <input type="text" placeholder="Wyszukaj zawodnika" oninput="w3.filterHTML('#zawodnik', 'option', this.value)" style="width: auto !important;"/> <br>
        <select name="zawodnik" id="zawodnik" onchange="refresh();" style="width: -webkit-fill-available;">
            <option></option>
            <?php
            $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE 1");
            for($i=0;$i<$rezultat->num_rows;$i++){
                $wiersz = $rezultat->fetch_assoc();
                    $id = $wiersz['ID_zawodnika'];
                    $ImieNazwisko = $wiersz['Imie Nazwisko'];
                echo '<option value='.$id.'>'.$ImieNazwisko.'</option>';
            }
            ?>
        </select><br>
    </div>
    <div class="eight columns" id="formularz">

    </div>
    <button onclick="wyslijEZ();">Dalej</button>
    <button onclick="wyslijUZ();" style="background-color: red;">Usuń</button>
</form>
