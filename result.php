
<?php

function cleanString($string) {
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

    foreach (glob($dir . '/*.json') as $file) {
        if (basename($file, '.json') == $searchedName) {
            $match = $file;
        }
    }

    if ($match != '' && (time() - filemtime($match) < 60)) {
        $raw = file_get_contents($match);
        $json = json_decode($raw);
    } else {
        $url = "https://fr-en.openfoodfacts.org/cgi/search.pl?search_terms='.$searchedName.'&search_simple=1&action=process&json=1&page_size=1000";
        $raw = file_get_contents($url);
        file_put_contents($dir . '/' . $searchedName . '.json', $raw);
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
    echo "Aucune recherche effectuée.";
}



