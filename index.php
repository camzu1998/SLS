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
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top:5px !important;">
                <div class="six columns">
                    <img src="img.jpg" style="float:left;"/>
                    <h2>SZKOLNA LIGA STRZELECKA</h2>
                </div>
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
            <div class="row">
                <!-- WYBÓR SEZONU -->
                <?php include"listaSezonow.php";?>
            </div>
            <div id="id01" class="modal">
                <form class="modal-content animate" action="logowanie.php" method="post">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    </div>
                    <div class="kontener">
                        <label><b>Login</b></label>
                        <input type="text" placeholder="Wpisz login" name="Login" required>
                        <label><b>Hasło</b></label>
                        <input type="password" placeholder="Wpisz hasło" name="Haslo" required>
                        <button type="submit">Zaloguj się</button>
                    </div>
                    <div class="kontener" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Anuluj</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="five columns" style="margin-top: 10px !important;">
                    <ul>
                        <?php include"tabelka.php"; ?>
                    </ul>
                </div>
                <div class="seven columns">
                    <script src="js/zegar.js"></script>
                    <div id="zegar"></div>
                </div>
            </div>
        </div>
        <footer>
            Kamil Langer 2017 Wszelkie prawa zastrzeżone &copy; kamillanger4@gmail.com
        </footer>
    </body>
</html>
