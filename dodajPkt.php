<form method="get"><br>
    <?php
    //AKTUALNA RUNDA
    $rezultat = $polaczenie->query("SELECT * FROM `rundy` LIMIT 1 ");
    $wiersz = $rezultat->fetch_assoc();
     echo "Aktualny nr rundy: ".$wiersz['ID'];
    ?>
    <br>
    <span>Zawodnik:</span>
    <input type="text" placeholder="Wyszukaj gracza" oninput="w3.filterHTML('#zawodnik', 'option', this.value)" style="width: auto !important;"/> <br>
    <select id="zawodnik" name="zawodnik" required>
        <?php
        $rezultat = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE 1");
        for($i=0;$i<$rezultat->num_rows;$i++){
            $wiersz = $rezultat->fetch_assoc();
                $id = $wiersz['ID_zawodnika'];
                $imieNazwisko = $wiersz['Imie Nazwisko'];
                $idDruzyny = $wiersz['ID_druzyny'];
            $rezultat2 = $polaczenie->query("SELECT * FROM `druzyny` WHERE `ID_druzyny`='".$idDruzyny."';");
            $wiersz2 = $rezultat2->fetch_assoc();
                $nazwa = $wiersz2['NazwaDruzyny'];
            echo '<option value="'.$id.'">'.$imieNazwisko.'('.$nazwa.')</option>';
        }
        ?>
    </select><br>
    <span>Nr rundy:</span>
    <select name="runda" id="runda" required>
        <?php
            $rezultat = $polaczenie->query("SELECT * FROM `rundy` WHERE 1");
            for($i=0;$i<$rezultat->num_rows;$i++){
                $wiersz = $rezultat->fetch_assoc();
                    $nazwa = $wiersz['ID'];
                echo '<option value="'.$nazwa.'">'.$nazwa.'</option>';
            }
        ?>
    </select> <br>
    <span>Punkty:</span>
    <?php
    for($i=0;$i<10;$i++){
        echo '<input type="number" name="pkt'.$i.'" id="pkt'.$i.'" oninput="updateDP();" value="0" style="width: 80px !important;" required/>';
    }
    ?><br>
    <span>Ilosc10:</span>
    <input type="text" name="Ilosc10" id="Ilosc10" value="0" style="width: auto !important;" required/> <br>
    <span id="wynik"></span>
    <button onclick="wyslijDP();">Wyślij</button>
</form>
