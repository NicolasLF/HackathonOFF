<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 23/03/17
 * Time: 18:17
 */
session_start();
if (!isset($_SESSION['id'])){
   header('location: identification.php');
}


include '../connect.php';
$bdd = new PDO(DSN, USER, PASS);
$iduser = $_SESSION['id'];

if (isset($_POST['selectaliment'])) {
    $req = $bdd->prepare('INSERT INTO food(date, product, nbkcal, id_user) VALUES(:date, :product, :nbkcal,:id_user)');
    $req->execute(array(
        'date' => date("Y-m-d"),
        'product' => $_POST['id'],
        'nbkcal' => $_POST['calo'],
        'id_user' => $iduser));
    header('location: index.php');
}

if (isset($_POST['sp'])) {
    $sport = $_POST['sport'];
    $req = $bdd->prepare('SELECT * FROM bddsports WHERE name= :sport');
    $req->bindValue(':sport', $sport);
    $req->execute();
    $res = $req->fetch();

    $kcaltotal = $_POST['timesport'] * $res['kcalh'];
    $id = $res['id'];

    $req1 = $bdd->prepare('INSERT INTO sports(id_bddsports, id_user, date, kcaltotal, time) VALUES(:id_bddsports, :id_user, :date, :kcaltotal, :time)');
    $req1->execute(array(
        'id_bddsports' => $id,
        'id_user' => $iduser,
        'date' => date("Y-m-d"),
        'kcaltotal' => $kcaltotal,
        'time' => $_POST['timesport']));
    header('location: index.php');

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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">


    <link href="https://fonts.googleapis.com/css?family=Anton|Passion+One|Permanent+Marker|Sigmar+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato|PT+Sans+Narrow|PT+Serif|Varela+Round" rel="stylesheet">

    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>

    <title>Eat N Run</title>

    <style>
        body{
            background-color: white;
        }
        #gauge2 > svg > text > tspan {
            display: none !important;
        }
        .modal-lg {
            width: 80%!important;
        }
        .ct-label{
            font-size: 14px;
        }
    </style>
</head>
<body>

<a href="../index.php" class="logo">EAT N RUN</a><a href="deconnexion.php" style="margin: 15px 10px 0 0;" class="btn btn-primary pull-right">Log Out</a>
<h2>Bonjour <?= $_SESSION['firstname']?></h2>

<div class="row chapeau">
    <div class="col-md-5">
        <div class="col-xs-12 text-center">
        </div>
        <div class="col-sm-offset-1 col-sm-10 text-center ">
            <div id="gauge" class="text-center" style="margin:0 auto; width: 300px; height: 150px;"></div>
            <h3 style="margin-top: 0px;">Calories consommées ce jour</h3>
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="aliment" class="control-label member-title-field">Qu'avez vous mangé?</label>
                    <input type="text" class="form-control" name="aliment" id="aliment" placeholder="Repas,aliments...">
                </div>
                <div class="form-group">
                    <button type="submit" name="manger" class="btn btn-default" data-toggle="modal"
                            data-target="#myModal">Ajouter
                    </button>
                </div>
            </form>
        </div>
        <div class="col-xs-12">


            <?php
            function cleanString($string)
            {
                // on supprime : majuscules ; / ? : @ & = + $ , . ! ~ * ( ) les espaces multiples et les underscore
                $string = strtolower($string);
                $string = preg_replace("/[^a-z0-9_'\s-]/", "", $string);
                $string = preg_replace("/[\s-]+/", " ", $string);
                $string = preg_replace("/[\s_]/", " ", $string);
                return $string;
            }

            if (isset($_POST['manger']) && isset($_POST['aliment'])) {
                $searchedName = urlencode(cleanString($_POST['aliment']));

                $dir = '../cache';
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

                    $url = 'https://fr-en.openfoodfacts.org/cgi/search.pl?search_terms=' . $searchedName . '&search_simple=1&json=1&page_size=20';
                    $raw = file_get_contents($url);
                    file_put_contents($dir . '/' . $searchedName . '.json', $raw);
                    $json = json_decode($raw);
                }

                if (!empty($json->products)) {
                    foreach ($json->products as $msg) {
                        if (!isset($msg->image_small_url)) {
                            $msg->image_small_url = '';
                        }
                        if (isset($msg->nutriments->energy_value) && isset($msg->quantity)) {
                            $calo = round(($msg->nutriments->energy_value * $msg->quantity / 100) / 4.1868);
                            echo '<div class="col-xs-10 listeProduit"><img style="width: 50px;height:50px;" src="' . $msg->image_small_url . '">' . $msg->product_name;
                            echo "</div><div class='col-xs-2'><form method='post' class=\"pull-right\"><input type='hidden' name='calo' value=' $calo '><input type='hidden' name='id' value=' $msg->code '><button type=\"submit\" name=\"selectaliment\" class=\"btn btn-default\" data-toggle=\"modal\"data-target=\"#myModal\">Ajouter</button></form></div>";

                        }
                    }
                } else {
                    echo "Rien n'a été trouvé.";
                }
            }
            ?>

        </div>
    </div>
    <div class="col-md-2">
        <p>Jauge de bien-être</p>
        <div id="gauge2" class="text-center" style="margin:0 auto; width: 300px; height: 150px;"></div>
        <?php
        if (isset($_SESSION['toto'])) {
            if ($_SESSION['toto'] < 0.7) {
                echo '<div class="text-center">
            <img src="homer_sport.gif" alt="" style="height: 200px;"class="img-circle">
        </div>';

            } elseif ($_SESSION['toto'] > 1.3) {
                echo '<div class="text-center">
            <img src="bodybuilder.gif" alt="" style="height: 200px; width: 200px;"class="img-circle">
        </div>';

            } else {
                echo '<div class="text-center">
            <img src="applause.gif" alt="" style="height: 200px; width: 200px;"class="img-circle">
        </div>';
            }
        }

        ?>


    </div>
    <div class="col-md-5">
        <div class="col-xs-12 text-center">
            <div class="col-sm-offset-1 col-sm-10 text-center ">
                <div id="gauge1" class="text-center" style="margin:0 auto; width: 200px; height: 150px;"></div>
                <h3 style="margin-top: 0px;">Calories perdues ce jour</h3>
                <form class="form-horizontal" method="post">
                    <div class="form-group ui-widget">
                        <label for="search-input" class="member-title-field">Quel sport avez vous pratiqué aujourd'hui?</label>
                        <input type="text" name="sport" id="search-input" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="temps" class="control-label member-title-field">Combien de temps?(en heure)</label>
                        <input size="4" type="text" name="timesport" class="form-control" id="temps" placeholder="Qté">
                    </div>
                    <div class="form-group">

                        <button type="submit" name="sp" class="btn btn-default">Ajouter</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="col-sm-offset-1 col-sm-10 listeProduit">
            <form class="form-inline datePicker" method="post">
                <div class="form-group ">
                    <?php if (isset($_POST['godate'])) {
                        ?>
                        <p>Date: <input type="text" name="date" id="datepicker" value="<?= $_POST['date']; ?>"></p>
                        <?php
                    } else { ?>
                        <p>Date: <input type="text" name="date" id="datepicker" value="<?= date("m/d/Y"); ?>"></p>
                        <?php
                    }
                    ?>
                </div>
                <div class="form-group">

                    <button type="submit" name="godate" class="btn btn-default">Let's go !</button>
                </div>
            </form>

            <?php
            $date = date("m/d/Y");
            if (isset($_POST['godate'])) {
                $date = $_POST['date'];
            }
            $daypoid = '';
            $req = $bdd->query("SELECT * FROM food WHERE id_user = $iduser AND date = date_format(str_to_date('$date','%m/%d/%Y'), '%Y-%m-%d');");

            while ($resultat = $req->fetch()) {

                if (isset($resultat['product']) && !empty($resultat['product'])) {

                    $dir = '../cache';
                    $match = '';

                    foreach (glob($dir . '/*.json') as $file) {
                        if (basename($file, '.json') == $resultat['product']) {
                            $match = $file;
                        }
                    }

                    if ($match != '' && (time() - filemtime($match) < 60000)) {
                        $raw = file_get_contents($match);
                        $json = json_decode($raw);
                    } else {

                        $url = 'https://fr-en.openfoodfacts.org/code/' . $resultat['product'] . '.json';

                        $raw = file_get_contents($url);
                        file_put_contents($dir . '/' . $resultat['product'] . '.json', $raw);
                        $json = json_decode($raw);
                    }

                    if (!empty($json->products)) {
                        foreach ($json->products as $msg) {
                            if (!isset($msg->image_small_url)) {
                                $msg->image_small_url = '';
                            }
                            echo '<img style="width: 50px;height:50px;" src="' . $msg->image_small_url . '">  ' . $msg->product_name . '</br>';
                            $daypoid += round(($msg->nutriments->energy_value * $msg->quantity / 100) / 4.1868);
                        }
                    }
                }
            }?>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="col-sm-offset-1 col-sm-10">
            <ul class="list-group">
                <?php
                $kcaltotal = '';
                $req2 = $bdd->query("SELECT s.*,b.name, b.kcalh  FROM sports as s INNER JOIN bddsports as b ON s.id_bddsports = b.id WHERE id_user = $iduser AND date = date_format(str_to_date('$date','%m/%d/%Y'), '%Y-%m-%d');");

                while ($resultat2 = $req2->fetch()) {
                    $kcaltotal += $resultat2['kcaltotal'];
                    echo '<li class="list-group-item"><span class="badge">' . $resultat2['kcaltotal'] . '</span>Vous avez fait <strong>' . $resultat2['time'] . '</strong> heures de <strong>' . $resultat2['name'] . '</strong> et vous avez perdu :</li>';
                }

                ?>
            </ul>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Voir l'historique de la semaine</button>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title" id="myModalLabel">Stats de la semaine</h2>
            </div>
            <div class="ct-chart ct-double-octave" id="chart1"></div>
            <ul>
                <li style="color:#F4C63D;">
                    Calories brulées dans la semaine
                </li>
                <li style="color:#D70206;">
                    Calories gagnées dans la semaine
                </li>
            </ul>
        </div>
    </div>
</div>


<?php
$date3 = date("Y-m-d");
$req3 = $bdd->query("SELECT nbkcal FROM food WHERE id_user = $iduser AND date = '$date3'");
$tt6 = '';
while ($resultat3 = $req3->fetch()) {
    $tt6 += $resultat3['nbkcal'];
}
$date3 = date("Y-m-d", strtotime('- 1 DAY'));
$req3 = $bdd->query("SELECT nbkcal FROM food WHERE id_user = $iduser AND date = '$date3'");
$tt = '';
while ($resultat3 = $req3->fetch()) {
    $tt += $resultat3['nbkcal'];
}
$date4 = date("Y-m-d", strtotime('- 2 DAY'));
$req4 = $bdd->query("SELECT nbkcal FROM food WHERE id_user = $iduser AND date = '$date4'");
$tt1 = '';
while ($resultat4 = $req4->fetch()) {
    $tt1 += $resultat4['nbkcal'];
}
$date5 = date("Y-m-d", strtotime('- 3 DAY'));
$req5 = $bdd->query("SELECT nbkcal FROM food WHERE id_user = $iduser AND date = '$date5'");
$tt2 = '';
while ($resultat5 = $req5->fetch()) {
    $tt2 += $resultat5['nbkcal'];
}
$date6 = date("Y-m-d", strtotime('- 4 DAY'));
$req6 = $bdd->query("SELECT nbkcal FROM food WHERE id_user = $iduser AND date = '$date6'");
$tt3 = '';
while ($resultat6 = $req6->fetch()) {
    $tt3 += $resultat6['nbkcal'];
}
$date7 = date("Y-m-d", strtotime('- 5 DAY'));
$req7 = $bdd->query("SELECT nbkcal FROM food WHERE id_user = $iduser AND date = '$date7'");
$tt4 = '';
while ($resultat7 = $req7->fetch()) {
    $tt4 += $resultat7['nbkcal'];
}
$date8 = date("Y-m-d", strtotime('- 6 DAY'));
$req8 = $bdd->query("SELECT nbkcal FROM food WHERE id_user = $iduser AND date = '$date8'");
$tt5 = '';
while ($resultat8 = $req8->fetch()) {
    $tt5 += $resultat8['nbkcal'];
}


$date3 = date("Y-m-d");
$req3 = $bdd->query("SELECT kcaltotal FROM sports WHERE id_user = $iduser AND date = '$date3'");
$aa6 = '';
while ($resultat3 = $req3->fetch()) {
    $aa6 += $resultat3['kcaltotal'];
}
$date3 = date("Y-m-d", strtotime('- 1 DAY'));
$req3 = $bdd->query("SELECT kcaltotal FROM sports WHERE id_user = $iduser AND date = '$date3'");
$aa = '';
while ($resultat3 = $req3->fetch()) {
    $aa += $resultat3['kcaltotal'];
}
$date4 = date("Y-m-d", strtotime('- 2 DAY'));
$req4 = $bdd->query("SELECT kcaltotal FROM sports WHERE id_user = $iduser AND date = '$date4'");
$aa1 = '';
while ($resultat4 = $req4->fetch()) {
    $aa1 += $resultat4['kcaltotal'];
}
$date5 = date("Y-m-d", strtotime('- 3 DAY'));
$req5 = $bdd->query("SELECT kcaltotal FROM sports WHERE id_user = $iduser AND date = '$date5'");
$aa2 = '';
while ($resultat5 = $req5->fetch()) {
    $aa2 += $resultat5['kcaltotal'];
}
$date6 = date("Y-m-d", strtotime('- 4 DAY'));
$req6 = $bdd->query("SELECT kcaltotal FROM sports WHERE id_user = $iduser AND date = '$date6'");
$aa3 = '';
while ($resultat6 = $req6->fetch()) {
    $aa3 += $resultat6['kcaltotal'];
}
$date7 = date("Y-m-d", strtotime('- 5 DAY'));
$req7 = $bdd->query("SELECT kcaltotal FROM sports WHERE id_user = $iduser AND date = '$date7'");
$aa4 = '';
while ($resultat7 = $req7->fetch()) {
    $aa4 += $resultat7['kcaltotal'];
}
$date8 = date("Y-m-d", strtotime('- 6 DAY'));
$req8 = $bdd->query("SELECT kcaltotal FROM sports WHERE id_user = $iduser AND date = '$date8'");
$aa5 = '';
while ($resultat8 = $req8->fetch()) {
    $aa5 += $resultat8['kcaltotal'];
}
?>
<script>
    // Initialize a Line chart in the container with the ID chart1
    new Chartist.Line('#chart1', {
        labels: ['Sam', 'Dim','Lun', 'Mar', 'Mer', 'Jeu', 'Ven'],
        series: [
            [parseInt('<?php echo $tt5;?>'), parseInt('<?php echo $tt4;?>'), parseInt('<?php echo $tt3;?>'), parseInt('<?php echo $tt2;?>'), parseInt('<?php echo $tt1;?>'), parseInt('<?php echo $tt;?>'), parseInt('<?php echo $tt6;?>')],
                [],
            [parseInt('<?php echo $aa5;?>'), parseInt('<?php echo $aa4;?>'), parseInt('<?php echo $aa3;?>'), parseInt('<?php echo $aa2;?>'), parseInt('<?php echo $aa1;?>'), parseInt('<?php echo $aa;?>'), parseInt('<?php echo $aa6;?>')],
        ],
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script src="../js/raphael-2.1.4.min.js"></script>
<script src="../js/justgage.js"></script>
<script>
    var g = new JustGage({
        id: "gauge",
        value: parseInt('<?php echo $daypoid; ?>'),
        min: 0,
        max: 2500,
        title: "Calories consommées ce jour",
    });
</script>
<script>
    var g = new JustGage({
        id: "gauge1",
        value: parseInt('<?php echo $kcaltotal;?>'),
        min: 0,
        max: 4000,
        title: "Calories perdues ce jour",
        levelColors: [
            "#ff0002",
            "#ffbd00",
            "#05ff00"
        ]
    });
</script>
<?php
if ($kcaltotal != 0 && $kcaltotal != 0){
    $totalcal = $kcaltotal / $daypoid;
    $_SESSION['toto'] = $totalcal;
}else{
    $_SESSION['toto'] = 0;
}

?>
<script>
    var g = new JustGage({
        id: "gauge2",
        value: <?php echo $totalcal;?>,
        min: 0,
        max: 2,
        title: "Visitors",
        levelColors: [
            "#ff0002",
            "#ffbd00",
            "#05ff00"
        ]
    });
</script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="../js/script.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker();
    });
</script>
</body>
</html>
