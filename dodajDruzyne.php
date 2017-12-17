<form method="get"><br>
    <span>Nazwa szkoły:</span>
    <input type="text" name="Szkola" id="Szkola" style="width: auto !important;" required/> <br>
    <span>WWW:</span>
    <input type="text" name="WWW" id="WWW" style="width: auto !important;"/> <br>
    <span>Adres:</span>
    <input type="text" name="Adres" id="Adres" style="width: auto !important;" required/> <br>
    <span>Nazwa drużyny:</span>
    <input type="text" name="Nazwa" id="Nazwa" style="width: auto !important;" required/> <br>
    <span>Bierze udział w konkursie:</span><br>
    <p>Tak</p>
    <input type="radio" name="konkurs" id="konkurs" value="1" checked/> <br>
    <p>Nie</p>
    <input type="radio" name="konkurs" id="konkurs" value="0" /> <br>
    <button onclick="wyslijDD();">Wyślij</button>
</form>
