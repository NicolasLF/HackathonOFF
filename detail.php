<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>EatnRun</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Anton|Passion+One|Permanent+Marker|Sigmar+One" rel="stylesheet">

</head>

<body>
<a href="index.php" class="logo">EAT N RUN</a>


<?php

require_once 'connect.php';
$pdo = new PDO(DSN, USER, PASS);




$id = $_GET["id"];

function cleanString($string) {
    // on supprime : majuscules ; / ? : @ & = + $ , . ! ~ * ( ) les espaces multiples et les underscore
    $string = strtolower($string);
    $string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
    $string = preg_replace("/[\s-]+/", " ", $string);
    $string = preg_replace("/[\s_]/", " ", $string);
    return $string;
}


if(isset($_GET['id']) && !empty($_GET['id'])) {

    $dir = 'cache';
    $match = '';

    foreach (glob($dir . '/*.json') as $file) {
        if (basename($file, '.json') == $id) {
            $match = $file;
        }
    }

    if ($match != '' && (time() - filemtime($match) < 60)) {
        $raw = file_get_contents($match);
        $json = json_decode($raw);
    } else {

        $url = 'https://fr-en.openfoodfacts.org/code/'.$id.'.json';

        $raw = file_get_contents($url);
        file_put_contents($dir . '/' . $id . '.json', $raw);
        $json = json_decode($raw);
    }

    if(!empty($json->products)) {
        foreach($json->products as $msg) {
            echo '<h2>'. $msg->product_name .'</h2>
            <div class="container">
            <div class="row">
            <div class="col-xs-5 cadre">';

            echo '
            <img src="' . $msg->image_small_url . '">';

            echo '
<p>'. $msg->brands .'</p>';

            $quantity = $msg->quantity;
            echo '
<p>'. $msg->quantity .'</p>';

            switch ($msg->nutrition_grade_fr) {
                case 'a';
            echo '
<img src="img/nutriscore-a.svg" class="nutri">';
            break;
                case 'b';
                    echo '
<img src="img/nutriscore-b.svg" class="nutri">';
                    break;
                case 'c';
                    echo '
<img src="img/nutriscore-c.svg" class="nutri">';
                    break;
                case 'd';
                    echo '
<img src="img/nutriscore-d.svg" class="nutri">';
                    break;
                case 'e';
                    echo '
<img src="img/nutriscore-e.svg" class="nutri">';
                    break;
            }
            $energy = $msg->nutriments->energy_value;
            echo '
<p>'. round($msg->nutriments->energy_value / 4.1868) . ' kcal pour 100g</p>';

            echo '<p>'. round(($msg->nutriments->energy_value * $msg->quantity / 100) / 4.1868) . ' kcal</p>
            </div>';
        }
    }else {
        echo "Rien n'a été trouvé.";
    }
}else {
    echo "Aucune recherche effectuée.";
}

?>


    <div class="col-xs-5 col-xs-offset-2 cadre">
        <form action="" method="POST">
            <div class="ui-widget choixsport">
                <br />
                <label for="search-input">Votre sport :</label>
                <br />
                <input type="text" name="sport" id="search-input" class="form-control"/>
            </div>
            <br />
            <input type="submit" class="btn btn-default" name="search" value="Selectionner" />
        </form>


<?php
if (isset($_POST['sport'])) {
    $sport = $_POST['sport'];

    $req = $pdo->prepare('SELECT * FROM bddsports WHERE name= :sport');
    $req->bindValue(':sport', $sport);
    $req->execute();

    $res = $req->fetch();
    echo '<br /><br /><br /><br /><p>Vous avez choisi : '. $sport .' qui vous fait perdre : '. $res['kcalh'] .' kcal/h !</p><br />';
    $energyKcal = round(($energy/4.1868)*($quantity/100));
    $sportHours = floor($energyKcal/$res['kcalh']);
    $sportMinutes = round(($energyKcal/$res['kcalh']-floor($energyKcal/$res['kcalh']))*60);
    echo '<p>Il faut donc que vous fassiez<br/>'. $sportHours .' heures et '. $sportMinutes .' minutes de sport !!<br />Il y a encore du taf !</p>';
}
?>
</div>
</div>
</div>
</body>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/script.js"></script>

</html>