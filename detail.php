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

</head>

<body>

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
            echo $msg->product_name;
            echo "<br/>";
            echo "<img src=" . $msg->image_small_url . ">";
            echo "<br/>";
            echo $msg->brand;
            echo "<br/>";
            $quantity = $msg->quantity;
            echo $msg->quantity;
            echo "<br/>";
            echo $msg->nutrition_grade_fr;
            echo "<br/>";
            $energy = $msg->nutriments->energy_value;
            echo round($msg->nutriments->energy_value / 4.1868) . " kcal pour 100g";
            echo "<br/>";
            echo round(($msg->nutriments->energy_value * $msg->quantity / 100) / 4.1868) . " kcal";
        }
    }else {
        echo "Rien n'a été trouvé.";
    }
}else {
    echo "Aucune recherche effectuée.";
}

?>

    <form action="" method="POST">
        <div class="ui-widget">
            <label for="search-input">Votre sport :</label>
            <input type="text" name="sport" id="search-input" class="form-control"/>
        </div>
        <input type="submit" class="btn btn-default" name="search" value="Selectionner" />
    </form>

<?php
if (isset($_POST['sport'])) {
    $sport = $_POST['sport'];

    $req = $pdo->prepare('SELECT * FROM bddsports WHERE name= :sport');
    $req->bindValue(':sport', $sport);
    $req->execute();

    $res = $req->fetch();
    echo '<br /><p>Vous avez choisi : '. $sport .' qui vous fait perdre : '. $res['kcalh'] .' kcal/h !</p><br />';
    $energyKcal = round(($energy/4.1868)*($quantity/100));
    $sportHours = floor($energyKcal/$res['kcalh']);
    $sportMinutes = round(($energyKcal/$res['kcalh']-floor($energyKcal/$res['kcalh']))*60);
    echo '<p>Il faut donc que vous fassiez '. $sportHours .' heures et '. $sportMinutes .' minutes de sport !!<br />Il y a encore du taf !</p>';
}
?>
</body>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/script.js"></script>

</html>