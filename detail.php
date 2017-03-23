<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>EatnRun</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">

</head>

<body>

<?php

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
            echo $msg->brands;
            echo "<br/>";
            echo $msg->quantity;
            echo "<br/>";
            echo $msg->nutrition_grade_fr;
            echo "<br/>";
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

</body>

</html>