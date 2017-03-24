<?php

// Vérification de la validité des informations
// Hachage du mot de passe
include '../connect.php';
$bdd = new PDO(DSN, USER, PASS);

if (isset($_POST['inscription'])){

$pass_hache = sha1($_POST['password']);

// Insertion
$req = $bdd->prepare('INSERT INTO user(name, password, email, firstname) VALUES(:name, :pass, :email,:firstname)');
$req->execute(array(
    'name' => $_POST['name'],
    'pass' => $pass_hache,
    'email' => $_POST['email'],
    'firstname' => $_POST['firstname']));
}
if (isset($_POST['connexion'])){
    // Hachage du mot de passe
    $pass_hache = sha1($_POST['password']);

// Vérification des identifiants

    $req = $bdd->prepare('SELECT * FROM user WHERE email = :email AND password = :pass');
    $req->execute(array(
        'email' => $_POST['email'],
        'pass' => $pass_hache));


    $resultat = $req->fetch();

    if (!$resultat)
    {
        echo 'Mauvais identifiant ou mot de passe !';
    }
    else
    {
        session_start();
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['name'] = $resultat['name'];
        $_SESSION['firstname'] = $resultat['firstname'];
        header('location: index.php');

    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Eat N Run</title>
</head>
<body>
<div class="container">

    <div class="row">
        <div class="col-xs-12 text-center">
            <h1>IDENTIFICATION</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <form method="post" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="firstname">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <button type="submit" name="inscription" class="btn btn-default">Inscription</button>
            </form>
        </div>
        <div class="col-sm-6">
            <form method="post" action="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <button type="submit" name="connexion" class="btn btn-default">Connexion</button>
            </form>
        </div>
    </div>
</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>