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
$name = $_GET['name'];
echo $name;
echo "<br/>";
$image = $_GET['img'];
echo "<img src=" . $image . ">";
echo "<br/>";
$quantity = $_GET['quantity'];
echo $quantity;
echo "<br/>";
$grade = $_GET['grade'];
echo $grade;
echo "<br/>";
$energy = $_GET['energy'];
echo $energy;


?>

    <form action="" method="POST">
        <div class="ui-widget">
            <label for="search-input">Votre sport :</label>
            <input type="text" name="sport" id="search-input" class="form-control"/>
        </div>
        <input type="submit" class="btn btn-default" name="search" value="Rechercher" />
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
    $sportHours = round($energyKcal/$res['kcalh']);
    $sportMinutes = round(($energyKcal/$res['kcalh']-round($energyKcal/$res['kcalh']))*60);
    echo '<p>Il faut donc que vous fassiez '. $sportHours .' heures et '. $sportMinutes .' minutes de sport !!<br />Il y a encore du taf !</p>';
}
?>
</body>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/script.js"></script>

</html>