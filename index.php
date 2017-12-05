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
        <script src="js/jquery-3.2.1.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top:5px !important;">
                <div class="six columns">
                    <img src="img.jpg" style="float:left;"/>
                    <h2>SZKOLNA LIGA STRZELECKA</h2>
                </div>
                <div class="six columns" style="text-align: right;"><a>Zaloguj się</a>|<a>Zarejestruj się</a> </div>
            </div>
            <div class="row">
                <!-- WYBÓR SEZONU -->
                <?php include"listaSezonow.php";?>
            </div>
            <div class="row">
                <div class="four columns">
                    <?php include"tabelki.php"; ?>
                </div>
                <div class="eight columns">
                    <script src="js/zegar.js"></script>
                    <div id="zegar"></div>
                </div>
            </div>
        </div>
    </body>
</html>
