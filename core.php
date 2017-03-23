<?php


function cleanString($string) {
    // on supprime : majuscules ; / ? : @ & = + $ , . ! ~ * ( ) les espaces multiples et les underscore
    $string = strtolower($string);
    $string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
    $string = preg_replace("/[\s-]+/", " ", $string);
    $string = preg_replace("/[\s_]/", " ", $string);
    return $string;
}

if(isset($_POST['product']) && !empty($_POST['product'])) {
    $searchedProduct = urlencode(cleanString($_POST['product']));

    $dir = 'cache';
    $match = '';

    foreach (glob($dir . '/*.json') as $file) {
        if (basename($file, '.json') == $searchedProduct) {
            $match = $file;
        }
    }


if ($match != '' && (time() - filemtime($match) < 60)) {
    $raw = file_get_contents($match);
    $json = json_decode($raw);
} else {
    $url = 'http://world.openfoodfacts.org/api/v0/product/'. $searchedProduct .'.json';
    $raw = file_get_contents($url);
    file_put_contents($dir . '/' . $searchedProduct . '.json', $raw);
    $json = json_decode($raw);
}

if(!empty($json->products)) {
    foreach ($json->products as $msg) {
        echo "<u>" . $msg->product_name . "</u> : " . $msg->energy_100g;
        echo "<br />";
    }
} else {
    echo "Rien n'a été trouvé.";
    }
} else {
    echo "Aucune recherche effectuée.";
}