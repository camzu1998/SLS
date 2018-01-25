<?php
$rezultat = $polaczenie->query("SELECT * FROM `pojedynki`");
?>
<form method="get">
    <select id="pojedynek" name="pojedynek" style="width: -webkit-fill-available;" onchange="refreshP();">
        <option></option>
        <?php
        for($i=0;$i<$rezultat->num_rows;$i++){
            $wiersz = $rezultat->fetch_assoc();
                $ID = $wiersz['ID'];
                $IDZ1 = $wiersz['IDZ1'];
                $IDZ2 = $wiersz['IDZ2'];
            $zapytanie1 = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$IDZ1."';");
            $wiersz1 = $zapytanie1->fetch_assoc();
                $ImieNazwisko1 = $wiersz1['Imie Nazwisko'];
            $zapytanie2 = $polaczenie->query("SELECT * FROM `zawodnicy` WHERE `ID_zawodnika`='".$IDZ2."';");
            $wiersz2 = $zapytanie2->fetch_assoc();
                $ImieNazwisko2 = $wiersz2['Imie Nazwisko'];
            echo '<option value="'.$ID.'">'.$ImieNazwisko1.' vs. '.$ImieNazwisko2.'</option>';
        }

        ?>
    </select>
    <div id="Pojedynek"></div>
    <button onclick="wyslijP();">Wyslij</button>
</form>
