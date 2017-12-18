<form method="get"><br>
    <span>Wybierz szkołę:</span>
    <select id="szkola" name="szkola">
    <option style="display: hidden;"></option>
    <?php
        $rezultat = $polaczenie->query("SELECT * FROM `szkoly` WHERE 1");
        for($i=0;$i<$rezultat->num_rows;$i++){
            $wiersz = $rezultat->fetch_assoc();
                $nazwaShl = $wiersz['NazwaSzkoly'];
                $ID = $wiersz['ID'];
            echo '<option value="'.$ID.'">'.$nazwaShl.'</option>';
        }
    ?>
    </select>
    <span>Imię:</span>
    <input type="text" name="Imie" id="Imie" style="width: auto !important;" required/> <br>
    <span>Nazwisko:</span>
    <input type="text" name="Nazwisko" id="Nazwisko" style="width: auto !important;" required/> <br>
    <span>Płeć:</span><br>
    <span>Mężyczyzna</span>
    <input type="radio" name="Plec" id="Plec" value="M" checked/> <br>
    <span>Kobieta</span>
    <input type="radio" name="Plec" id="Plec" value="K"/> <br>
    <button onclick="wyslijDZ();">Wyślij</button>
</form>
