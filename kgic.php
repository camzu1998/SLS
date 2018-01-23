<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Strona główna</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Szkolna Liga Strzelecka">
        <meta name="author" content="Kamil Langer">
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="css/index.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/w3.js"></script>
        <script src="js/tables.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top:5px !important;">
                <a href="index.php" style="text-decoration: none; color: black;">
                    <div class="six columns">
                        <img src="img.png" width="100px" style="float:left;"/>
                        <h2>SZKOLNA LIGA STRZELECKA</h2>
                    </div>
                </a>
                <?php
                    if(!isset($_SESSION['zalogowany'])){
                        ?><div class="six columns" style="text-align: right;"><a onclick="document.getElementById('id01').style.display='block'">Zaloguj się</a></div><?php
                    }else{
                        ?><div class="six columns" style="text-align: right;"> <?php
                        echo '<span style="margin-left: 5px;"> Witaj '.$_SESSION['Imie'].' </span>';
                        if($_SESSION['Admin'] != 0){
                            echo '<a href="panelAdmin.php"> Panel Administracyjny </a>';
                        }
                        ?>
                            <a href="logout.php" style="color: #CC0033; text-decoration: none;"> Wyloguj się </a>
                        </div> <?php
                    }
                ?>
            </div>
            <div class="row" style="margin-top:15px;">
                <div class="six columns">
                    <!-- WYBÓR SEZONU -->
                    <?php include"listaSezonow.php";?>
                </div>
            </div>
            <div class="row">
                <div class="five columns" style="margin-top: 10px !important;">
                    <ul>
                    <?php include"tabelkaSmall.php"; ?>
                    </ul>
                </div>
                <div class="seven columns">
                    <table id="kgic">
                        <thead><tr><th>Miejsce</th><th>Imię i nazwisko</th><th>Punkty</th><th>Nazwa szkoły</th><th></th></tr></thead>
                        <tbody id="tabeleczka">
                            <?php include"tabelaKGIC.php"; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer>
            Kamil Langer 2017 Wszelkie prawa zastrzeżone &copy; kamillanger4@gmail.com
        </footer>
    </body>
</html>
