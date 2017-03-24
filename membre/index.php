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
include 'connect.php';

if (isset($_POST['selectaliment'])) {
    $req = $bdd->prepare('INSERT INTO food(date, product, nbkcal, id_user) VALUES(:date, :product, :nbkcal,:id_user)');
    $req->execute(array(
        'date' => date("Y-m-d"),
        'product' => $_POST['id'],
        'nbkcal' => $_POST['calo'],
        'id_user' => 1));
}
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <!--                    <span>Hello --><? //= $_SESSION['firstname']; ?><!--</span>-->
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
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="aliment" class="control-label">Qu'avez vous mangé?</label>
                    <input type="text" class="form-control" name="aliment" id="aliment" placeholder="Repas,aliments...">
                </div>
                <div class="form-group">
                    <button type="submit" name="manger" class="btn btn-default" data-toggle="modal"
                            data-target="#myModal">Ajouter
                    </button>
                </div>
            </form>
        </div>
        <div class="col-xs-12">


            <?php
            function cleanString($string)
            {
                // on supprime : majuscules ; / ? : @ & = + $ , . ! ~ * ( ) les espaces multiples et les underscore
                $string = strtolower($string);
                $string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
                $string = preg_replace("/[\s-]+/", " ", $string);
                $string = preg_replace("/[\s_]/", " ", $string);
                return $string;
            }

            if (isset($_POST['manger']) && isset($_POST['aliment'])) {
                $searchedName = urlencode(cleanString($_POST['aliment']));

                $dir = '../cache';
                $match = '';

                foreach (glob($dir . '/*.json') as $file) {
                    if (basename($file, '.json') == $searchedName) {
                        $match = $file;
                    }
                }

                if ($match != '' && (time() - filemtime($match) < 60)) {
                    $raw = file_get_contents($match);
                    $json = json_decode($raw);
                } else {

                    $url = 'https://fr-en.openfoodfacts.org/cgi/search.pl?search_terms=' . $searchedName . '&search_simple=1&json=1&page_size=20';
                    $raw = file_get_contents($url);
                    file_put_contents($dir . '/' . $searchedName . '.json', $raw);
                    $json = json_decode($raw);
                }

                if (!empty($json->products)) {
                    foreach ($json->products as $msg) {
                        if (!isset($msg->image_small_url)) {
                            $msg->image_small_url = '';
                        }
                        $calo = round(($msg->nutriments->energy_value * $msg->quantity / 100) / 4.1868);
                        echo '<div class="col-xs-10"><img style="width: 50px;height:50px;" src="' . $msg->image_small_url . '">' . $msg->product_name;
                        echo "</div><div class='col-xs-2'><form method='post' class=\"pull-right\"><input type='hidden' name='calo' value=' $calo '><input type='hidden' name='id' value=' $msg->code '><button type=\"submit\" name=\"selectaliment\" class=\"btn btn-default\" data-toggle=\"modal\"data-target=\"#myModal\">Ajouter</button></form></div>";
                    }
                } else {
                    echo "Rien n'a été trouvé.";
                }
            }
            ?>

        </div>
    </div>
    <div class="col-xs-6">
        <div class="col-xs-12 text-center">
            <div class="col-sm-offset-3 col-sm-6 text-center ">
                <div id="gauge1" class="text-center" style="width: 200px; height: 200px;"></div>
                <h1>Calories perdu ce jour</h1>
                <form class="form-horizontal" method="get">
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
        <form class="form-inline" method="post">
            <div class="form-group">
                <p>Date: <input type="text" name="date" id="datepicker"></p>
            </div>
            <div class="form-group">

                <button type="submit" name="godate" class="btn btn-default">Let's go !</button>
            </div>
        </form>

        <?php
        $date = date("m/d/Y");
        if (isset($_POST['godate'])){
            $date = $_POST['date'];
        }

        $req = $bdd->query("SELECT * FROM food WHERE id_user = 1 AND date = date_format(str_to_date('$date','%m/%d/%Y'), '%Y-%m-%d');");

        while ($resultat = $req->fetch()) {
            echo $resultat['product'];
        }

        ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker();
    });
</script>
</body>
</html>
