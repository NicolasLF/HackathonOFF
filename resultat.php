<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 23/03/17
 * Time: 15:14
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

if(isset($_POST['mot']) && !empty($_POST['mot'])) {
    $motRecherche = urlencode(cleanString($_POST['mot']));

    $dir = 'cache';
    $match = '';

    foreach (glob($dir . '/*.json') as $fichier) {
        if (basename($fichier, '.json') == $motRecherche) {
            $match = $fichier;
        }
    }

    if ($match != '' && (time() - filemtime($match) < 60)) {
        $raw = file_get_contents($match);
        $json = json_decode($raw);
    } else {
        $url = "https://fr-en.openfoodfacts.org/cgi/search.pl?search_terms='.$motRecherche.'&search_simple=1&action=process&json=1&page_size=1000";
        $raw = file_get_contents($url);
        file_put_contents($dir . '/' . $motRecherche . '.json', $raw);
        $json = json_decode($raw);
    }
    if(!empty($json->products)) {
        foreach($json->products as $msg) {
            echo '<u>' . $msg->product_name .'</u> : '. $msg->nutriments->energy_value;
            echo "<br />";
        }
    }else {
        echo "Rien n'a été trouvé.";
    }
}else {
    echo "Aucune recherche effectu&eacute;e.";
}

?>
</body>
</html>

