<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 23/03/17
 * Time: 18:17
 */
session_start();
//if (!isset($_SESSION['id'])){
//    header('location: identification.php');
//}
echo 'Hello World';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
<!--                    <span>Hello --><?//= $_SESSION['firstname']; ?><!--</span>-->
                </a>
            </div>
            <a href="deconnexion.php" class="btn-primary pull-right">Log out</a>
        </div>
    </nav>
<div class="row">
    <div class="col-xs-6">
        <div class="col-xs-12 text-center">
        </div>
        <div class="col-sm-offset-3 col-sm-6 text-center ">
            <div id="gauge" class="text-center" style="width: 200px; height: 200px;"></div>
            <h1>Calories consommé ce jour</h1>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="aliment" class="control-label">Qu'avez vous mangé?</label>
                    <input type="text" class="form-control" id="aliment" placeholder="Repas,aliments...">
                </div>
                <div class="form-group">
                    <label for="aliment" class="control-label">Quantité :</label>
                    <input size="4" type="text" class="form-control" id="aliment" placeholder="Qté">
                </div>
                <div class="form-group">

                        <button type="submit" class="btn btn-default">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="col-xs-12 text-center">
            <div class="col-sm-offset-3 col-sm-6 text-center ">
                <div id="gauge1" class="text-center" style="width: 200px; height: 200px;"></div>
                <h1>Calories perdu ce jour</h1>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="sport" class="control-label">Quel sport avez vous fait aujourd'hui?</label>
                        <input type="text" class="form-control" id="sport" placeholder="Repas,aliments...">
                    </div>
                    <div class="form-group">
                        <label for="temps" class="control-label">Combien de temps?(en heure)</label>
                        <input size="4" type="text" class="form-control" id="temps" placeholder="Qté">
                    </div>
                    <div class="form-group">

                        <button type="submit" class="btn btn-default">Ajouter</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
    <div class="row">
        <div class="col-xs-12">
        </div>
    </div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <script src="../js/raphael-2.1.4.min.js"></script>
    <script src="../js/justgage.js"></script>
    <script>
        var g = new JustGage({
            id: "gauge",
            value: 7000,
            min: 0,
            max: 8000,
            title: "Visitors",
        });
    </script>
    <script>
        var g = new JustGage({
            id: "gauge1",
            value: 3000,
            min: 0,
            max: 8000,
            title: "Visitors",
            levelColors: [
                "#ff0002",
                "#ffbd00",
                "#05ff00"
            ]
        });
    </script>
</body>
</html>
