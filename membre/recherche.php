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

    foreach (glob($dir . '/*.json') as $file) {
        if (basename($file, '.json') == $searchedName) {
            $match = $file;
        }
    }

    if ($match != '' && (time() - filemtime($match) < 60)) {
        $raw = file_get_contents($match);
        $json = json_decode($raw);
    } else {

        $url = 'https://fr-en.openfoodfacts.org/cgi/search.pl?search_terms='.$searchedName.'&search_simple=1&json=1&page_size=50';
        $raw = file_get_contents($url);
        file_put_contents($dir . '/' . $searchedName . '.json', $raw);
        $json = json_decode($raw);
    }

    if(!empty($json->products)) {
        foreach($json->products as $msg) {
            echo "<a href='detail.php?id=" . $msg->code . "&name=" . $msg->product_name . "&quantity=" . $msg->quantity. "&grade=" . $msg->nutrition_grade_fr . "&energy=" . $msg->nutriments->energy_value . "&img=" . $msg->image_small_url . "'>" .  $msg->product_name . "</a>";
            echo "<br />";
            echo "<img src=" . $msg->image_small_url . ">";
            echo "<br />";
        }
    }else {
        echo "Rien n'a été trouvé.";
    }
}else {
    echo "Aucune recherche effectuée.";
}


?>