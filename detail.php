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

</body>

</html>