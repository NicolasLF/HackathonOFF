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
    $motRecherche = urlencode(cleanString($_POST['name']));

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
        $url = "https://fr-en.openfoodfacts.org/category/1.json?q=" . $motRecherche . "&rpp=10&include_entities=true&result_type=recent&lang=fr&locale=fr";
        $raw = file_get_contents($url);
        file_put_contents($dir . '/' . $motRecherche . '.json', $raw);
        $json = json_decode($raw);
    }


    if(!empty($json->results)) {
        foreach($json->results as $msg) {
            echo "<u>" . $msg->from_user_name ."</u> : ". $msg->text;
            echo "<br />";
        }
    }else {
        echo "Rien n'a été trouvé";
    }
}else {
    echo "Aucune recherche effectué";
}


?>

