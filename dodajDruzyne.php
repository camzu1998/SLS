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
    <span>Nazwa drużyny:</span>
    <input type="text" name="Nazwa" id="Nazwa" style="width: auto !important;" required/> <br>
    <span>Bierze udział w konkursie:</span><br>
    <p>Tak</p>
    <input type="radio" name="konkurs" id="konkurs" value="1" checked/> <br>
    <p>Nie</p>
    <input type="radio" name="konkurs" id="konkurs" value="0" /> <br>
    <button onclick="wyslijDD();">Wyślij</button>
</form>
