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
    $categories = '';
    $brands = '';
    $nutrition_grades = '';
    $allergens = '';
    $palm_oil = 'indifferent';

    if (isset($_POST['brands']))
    {
        $brands = urlencode(cleanString($_POST['brands']));
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

        $url = 'https://fr-en.openfoodfacts.org/cgi/search.pl?search_terms='.$searchedName.'&ingredients_from_palm_oil='.$palm_oil. '&brands='.$brands.'&nutrition_grades='.$nutrition_grades.'&search_simple=1&json=1&page_size=50';

        $raw = file_get_contents($url);
        file_put_contents($dir . '/' . $searchedName . '.json', $raw);
        $json = json_decode($raw);
    }

    if(!empty($json->products)) {
        foreach($json->products as $msg) {
            echo "<a href='detail.php?id=" . $msg->code . "'>" .  $msg->product_name . "</a>";
            echo "<br />";
            echo "<img src=" . $msg->image_small_url . ">";
            echo "<br />";
            echo $msg->brands;
            echo "<br />";
            echo "<br />";
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


