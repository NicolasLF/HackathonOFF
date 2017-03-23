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

//include_once 'connect.php';
//
//$db = mysqli_connect(SERVER, USER, PASS, DB);
//mysqli_set_charset($db,"utf8");
//
//$req = "SELECT * FROM bddsports";
//$res = mysqli_query($db, $req);

$id = $_GET["id"];

echo $_GET['name'];
echo "<br/>";
echo "<img src=" . $_GET['img'] . ">";
echo "<br/>";
echo $_GET['quantity'];
echo "<br/>";
echo $_GET['grade'];
echo "<br/>";
echo $_GET['energy'];


?>

    <form action="result.php" method="POST">
        <div class="ui-widget">
            <label for="sport">Votre sport :</label>
            <input type="text" name="sport" id="search-input" class="form-control"/>
        </div>
        <input type="submit" class="btn btn-default" name="search" value="Rechercher" />
    </form>
</body>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/script.js"></script>

</html>