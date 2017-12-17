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
        <link rel="stylesheet" href="css/loginpopup.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.leanModal.min.js"></script>
        <script src="js/loginpopup.js"></script>
        <script src="js/w3.js"></script>
        <script src="js/adminContent.js"></script>
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
                    if(!isset($_SESSION['zalogowany']) || $_SESSION['Admin'] == 0){
                        header('Location: index.php');
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
            <div class="row">
                <div class="four columns window">
                    <a onclick="wyswietlaj('Dodaj zawodnika', `dodajzaw`);">  Dodaj zawodnika </a> <br>
                    <a onclick="wyswietlaj('Edytuj zawodnika', `edytujzaw`);">  Edytuj zawodnika </a>
                </div>
                <div class="four columns window">
                    <a onclick="wyswietlaj('Dodaj drużynę', `dodajdruz`);">  Dodaj drużynę </a> <br>
                    <span>Edytuj drużynę</span>
                </div>
                <div class="four columns window">
                    <span>Rozpocznij sezon</span> <br>
                    <span>Zakończ sezon</span>
                </div>
            </div>
            <div class="row">
                <div class="four columns window">
                    <a onclick="wyswietlaj('Dodaj punkty', `dodajpkt`);">  Dodaj punkty </a> <br>
                    <span>Edytuj szkołę</span>
                </div>
                <div class="four columns window">
                    <a onclick="wyswietlaj('Nowa runda', `nowarunda`);">Rozpocznij rundę</a> <br>
                    <a onclick="zakonczRunde();">Zakończ rundę</a>
                </div>
                <div class="four columns window">
                    <span>Logi</span> <br>
                    <a onclick="wyswietlaj('Kreator drużyn', `kreatordruzyn`);">Kreator drużyn</a>
                </div>
            </div>
            <div id="dialogWindow" class="window" style="display: none; position: absolute; z-index: 997; top: 0 !important; height: auto; background: white; line-height: normal; width: 100%; padding:16px;">
                <div id="title" style="float:left;"></div>
                <span onclick="document.getElementById('dialogWindow').style.display='none'" class="close" title="Close">&times;</span>
                <div id="content" style="text-align: center; margin-top:10px;">

                </div>
            </div>
        </div>
        <div id="test"></div>
        <footer>
            Kamil Langer 2017 Wszelkie prawa zastrzeżone &copy; kamillanger4@gmail.com
        </footer>
    </body>
</html>
