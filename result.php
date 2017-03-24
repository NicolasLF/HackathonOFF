<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Eat N Run</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Anton|Passion+One|Permanent+Marker|Sigmar+One" rel="stylesheet">

</head>

<body>

<?php

function cleanString($string) {
    // on supprime : majuscules ; / ? : @ & = + $ , . ! ~ * ( ) les espaces multiples et les underscore
    $string = strtolower($string);
    $string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
    $string = preg_replace("/[\s-]+/", " ", $string);
    $string = preg_replace("/[\s_]/", " ", $string);
    return $string;
}

if(isset($_POST['name']) && !empty($_POST['name'])) {
    $searchedName = urlencode(cleanString($_POST['name']));

    $dir = 'cache';
    $match = '';
    $brand = '';
    $nutrition_grades = '';
    $palm_oil = '';

    if (isset($_POST['brand']))
    {
        $brand = urlencode(cleanString($_POST['brand']));
    }

    if (isset($_POST['nutrition_grades']))
    {
        $nutrition_grades = urlencode(cleanString($_POST['nutrition_grades']));
    }

    if (isset($_POST['palm_oil']))
    {
        $palm_oil = urlencode(cleanString($_POST['palm_oil']));
    }

    foreach (glob($dir . '/*.json') as $file) {
        if (basename($file, '.json') == $searchedName) {
            $match = $file;
        }
    }

    if ($match != '' && (time() - filemtime($match) < 60)) {
        $raw = file_get_contents($match);
        $json = json_decode($raw);
    } else {


        $url = 'https://fr-en.openfoodfacts.org/cgi/search.pl?search_terms='.$searchedName. '+' .$brand. '&ingredients_from_palm_oil='.$palm_oil. '&nutrition_grades='.$nutrition_grades.'&search_simple=1&json=1&page_size=50';

        $raw = file_get_contents($url);
        file_put_contents($dir . '/' . $searchedName . '.json', $raw);
        $json = json_decode($raw);
    }
?>
<a href="index.php" class="logo">EAT N RUN</a>
<h2>Liste des produits</h2>
    <div class="container-fluid">

        <div class="row">

<?php


    if(!empty($json->products)) {
        foreach($json->products as $msg) {

        if (!empty($msg->image_small_url)) {

            echo '<div class="col-xs-2"><a href="detail.php?id=' . $msg->code . '" class="thumbnail">' . $msg->product_name . '<br /><img src="' . $msg->image_small_url . '"><br />' . $msg->brands . '</a></div>';
        }

        }
    }else {
        echo "Rien n'a été trouvé.";
    }
}else {
    echo "Aucune recherche effectuée.";
}


?>
        </div>
    </div>
</body>

</html>


