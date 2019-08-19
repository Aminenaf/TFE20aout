<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Europe/Brussels');

$token = $_GET['token'];

include("dbConnect.php");

$req = $bdd->prepare("SELECT token_mail,token_mail_exp FROM token WHERE token_mail = ?");
$req->execute(array($token));
$user = $req->fetch();
$dateexp = $user['token_mail_exp'];
$datenow = date("Y-m-d H:i:s");

if ($user['token_mail'] == $token && $dateexp > $datenow) {
    $insertmbr = $bdd->prepare("INSERT INTO membre(nom, prenom, date_naissance, telephone, email, mdp, id_section, date_inscription) VALUES(?,?,?,?,?,?,?,now())");
    $insertmbr->execute(array($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['dateNaiss'], $_SESSION['telephone'], $_SESSION['mail'], $_SESSION['mdp'], $_SESSION['idsection']));
    ?>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Amine Nafia">

        <title>Brownsea</title>

        <link rel="shortcut icon" href="assets/images/icone.png">

        <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Custom styles for our template -->
        <link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
        <link rel="stylesheet" href="assets/css/main.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

    <?php include("header.php"); ?>

    <div class="container">

        <div class="row">

            <!-- Article main content -->
            <article class="col-xs-12 maincontent">
                <header class="page-header">
                    <h1 class="page-title">Félicitation</h1>
                </header>
                <br>
                <br>
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3 class="thin text-center">Votre compte à bien été créé</h3>
                            <p class="text-center text-muted">Vous pouvez à présent vous connecter sur votre compte<br>
                                <a href="connexion.php">Connexion</a> !</p>
                            <hr>
                        </div>
                    </div>

                </div>

            </article>
            <!-- /Article -->

        </div>
    </div>    <!-- /container -->

    <?php include("footer.php") ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/headroom.min.js"></script>
    <script src="assets/js/jQuery.headroom.min.js"></script>
    <script src="assets/js/template.js"></script>
    </body>
    </html>
    <?php
}
else {
    ?>
    <html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport"    content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author"      content="Amine Nafia">

        <title>Brownsea</title>

        <link rel="shortcut icon" href="assets/images/icone.png">

        <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Custom styles for our template -->
        <link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
        <link rel="stylesheet" href="assets/css/main.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

    <?php include("header.php"); ?>

    <div class="container">

        <div class="row">

            <!-- Article main content -->
            <article class="col-xs-12 maincontent">
                <header class="page-header">
                    <h1 class="page-title">Erreur</h1>
                </header>
                <br>
                <br>
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3 class="thin text-center">Votre lien à expiré</h3>
                            <p class="text-center text-muted">Vous pouvez refaire une demande d'inscription via le formulaire<br>
                                <a href="inscription.php">Inscription</a> !</p>
                            <hr>
                        </div>
                    </div>

                </div>

            </article>
            <!-- /Article -->

        </div>
    </div>	<!-- /container -->

    <?php include("footer.php") ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/headroom.min.js"></script>
    <script src="assets/js/jQuery.headroom.min.js"></script>
    <script src="assets/js/template.js"></script>
    </body>
    </html>
<?php
}
?>