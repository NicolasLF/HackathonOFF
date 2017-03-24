<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 23/03/17
 * Time: 21:57
 */
require_once 'connect.php';
$pdo = new PDO(DSN, USER, PASS);

$term = $_GET['term'];


$req = $pdo->prepare('SELECT * FROM bddsports WHERE name LIKE :term'); // j'effectue ma requête SQL grâce au mot-clé LIKE

$req->execute(array('term' => '%'.$term.'%'));

$array = array(); // on créé le tableau


while($data = $req->fetch()) // on effectue une boucle pour obtenir les données
{
    array_push($array, $data['name']); // et on ajoute celles-ci à notre tableau
}

echo json_encode($array); // il n'y a plus qu'à convertir en JSON