<?php

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>EatnRun</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
<body>
<div class="container">
    <form action="result.php" method="POST">
        <div class="form-group">
            <label for="name">Votre produit :</label>
            <input type="text" name="name" class="form-control"/>
        </div>
        <div id="accordion" class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Recherche avancée</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="brands">Marque</label>
                            <input type="text" name="brands" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="nutrition_grades">Valeur nutritionnelle</label>
                            <label class="radio-inline">
                                <input type="radio" name="nutrition_grades" id="nutrition_grade_A" value="A"> A
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="nutrition_grades" id="nutrition_grade_B" value="B"> B
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="nutrition_grades" id="nutrition_grade_C" value="C"> C
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="nutrition_grades" id="nutrition_grade_D" value="D"> D
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="nutrition_grades" id="nutrition_grade_E" value="E"> E
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="palm_oil" name="palm_oil" >
                                Produit sans huile de palme
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-default" name="search" value="Rechercher" />
    </form>
</div>


</body>

<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</html>

