
<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 23/03/17
 * Time: 15:12
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

<form action="result.php" method="POST">
    <label for="name">Votre produit :</label>
    <input type="text" name="name" />
    <br />
    <label for="sport">Votre sport :</label>
    <input type="text" name="sport" />
    <input type="submit" name="search" value="Rechercher" />
</form>


</body>
</html>

