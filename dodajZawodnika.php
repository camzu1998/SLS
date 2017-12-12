<form method="get"><br>
    <span>Imię:</span>
    <input type="text" name="Imie" id="Imie" style="width: auto !important;"/> <br>
    <span>Nazwisko:</span>
    <input type="text" name="Nazwisko" id="Nazwisko" style="width: auto !important;"/> <br>
    <span>Płeć:</span><br>
    <span>Mężyczyzna</span>
    <input type="radio" name="Plec" id="Plec" value="M"/> <br>
    <span>Kobieta</span>
    <input type="radio" name="Plec" id="Plec" value="K"/> <br>
    <span>Drużyna:</span>
    <select name="druzyna" id="Druzyna">
        <?php
            $rezultat = $polaczenie->query("SELECT * FROM `druzyny` WHERE 1");
            for($i=0;$i<$rezultat->num_rows;$i++){
                $wiersz = $rezultat->fetch_assoc();
                    $nazwa = $wiersz['NazwaDruzyny'];
                    $szkola = $wiersz['NazwaSzkoly'];
                echo '<option value="'.$nazwa.'">'.$nazwa.'('.$szkola.')</option>';
            }
        ?>
    </select> <br>
    <button onclick="wyslij();">Wyślij</button>
</form>
