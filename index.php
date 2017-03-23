
<?php

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
<body>
<div class="container">
    <form action="result.php" method="POST">
        <div class="form-group">
            <label for="name">Votre produit :</label>
            <input type="text" name="name" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="sport">Votre sport :</label>
            <input type="text" name="sport" class="form-control"/>
        </div>
        <input type="submit" class="btn btn-default" name="search" value="Rechercher" />
    </form>
</div>

</body>
</html>

