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
        <link rel="stylesheet" href="css/snackbar.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.leanModal.min.js"></script>
        <script src="js/loginpopup.js"></script>
        <script src="js/w3.js"></script>
        <script src="js/adminContent.js"></script>
        <script src="js/snackbarController.js"></script>
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
                    <a onclick="wyswietlaj('Edytuj punkty', `edytujpkt`);"> Edytuj punkty</a>
                </div>
                <div class="four columns window">
                    <a onclick="wyswietlaj('Nowa runda', `nowarunda`);">Rozpocznij rundę</a> <br>
                    <a onclick="zakonczRunde();">Zakończ rundę</a>
                </div>
                <div class="four columns window">
                    <a onclick="wyswietlaj('Dodaj szkołe', `dodajSzkole`);">Dodaj szkołe</a> <br>
                    <span>Edytuj szkołe</span>
                </div>
            </div>
            <div class="row">
                <div class="four columns window">
                    <a onclick="wyswietlaj('Kreator drużyn', `kreatordruzyn`);">Kreator drużyn</a> <br>
                    <span>Logi:</span>
                </div>
            </div>
            <div id="dialogWindow" class="window" style="display: none; position: absolute; z-index: 997; top: 0 !important; height: auto; background: white; line-height: normal; width: 100%; padding:16px;">
                <div id="title" style="float:left;"></div>
                <span onclick="document.getElementById('dialogWindow').style.display='none'" class="close" title="Close">&times;</span>
                <div id="content" style="text-align: center; margin-top:10px;">

                </div>
            </div>
        </div>
        <footer>
            Kamil Langer 2017 Wszelkie prawa zastrzeżone &copy; kamillanger4@gmail.com
        </footer>
        <div id="snackbar"><span id="tekst"></span></div>
        <?php
        if(isset($_SESSION['ErrorPtsExist'])){
            ?> <script>openSnackbar('ErrorPtsExist');</script> <?php
        }else if(isset($_SESSION['PtsDone'])){
            ?> <script>openSnackbar('PtsDone');</script> <?php
        }else if(isset($_SESSION['ZawodnikExist'])){
            ?> <script>openSnackbar('ZawodnikExist');</script> <?php
        }else if(isset($_SESSION['ZawodnikDone'])){
            ?> <script>openSnackbar('ZawodnikDone');</script> <?php
        }else if(isset($_SESSION['TeamExist'])){
            ?> <script>openSnackbar('TeamExist');</script> <?php
        }else if(isset($_SESSION['TeamDone'])){
            ?> <script>openSnackbar('TeamDone');</script> <?php
        }else if(isset($_SESSION['NowaRunda'])){
            ?> <script>openSnackbar('NowaRunda');</script> <?php
        }else if(isset($_SESSION['PlayerDelete'])){
            ?> <script>openSnackbar('PlayerDelete');</script> <?php
        }else if(isset($_SESSION['EdycjaPkt'])){
            ?> <script>openSnackbar('EdycjaPkt');</script> <?php
        }else if(isset($_SESSION['SchoolExist'])){
            ?> <script>openSnackbar('SchoolExist');</script> <?php
        }else if(isset($_SESSION['SchoolDone'])){
            ?> <script>openSnackbar('SchoolDone');</script> <?php
        }else if(isset($_SESSION['TeamCreator'])){
            ?> <script>openSnackbar('TeamCreator');</script> <?php
        }else if(isset($_SESSION['PlayerEdit'])){
            ?> <script>openSnackbar('PlayerEdit');</script> <?php
        }else if(isset($_SESSION['PtsDelete'])){
            ?> <script>openSnackbar('PtsDelete');</script> <?php
        }
        unset($_SESSION['ErrorPtsExist']);
        unset($_SESSION['PtsDone']);
        unset($_SESSION['ZawodnikExist']);
        unset($_SESSION['ZawodnikDone']);
        unset($_SESSION['TeamExist']);
        unset($_SESSION['TeamDone']);
        unset($_SESSION['NowaRunda']);
        unset($_SESSION['PlayerDelete']);
        unset($_SESSION['EdycjaPkt']);
        unset($_SESSION['SchoolExist']);
        unset($_SESSION['SchoolDone']);
        unset($_SESSION['TeamCreator']);
        unset($_SESSION['PlayerEdit']);
        unset($_SESSION['PtsDelete']);
        ?>
    </body>
</html>
