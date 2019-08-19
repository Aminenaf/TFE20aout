<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("dbConnect.php");

if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
    $supprime = (int) $_GET['supprime'];
    $req = $bdd->prepare('DELETE FROM membres WHERE id = ?');
    $req->execute(array($supprime));
}

if (!isset($_SESSION['id'])){
    header('Location: connexion.php');
    exit;
}
$requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$useradmin = $requser->fetch();

$membres = $bdd->query('SELECT * FROM membres ORDER BY id DESC');

$_SESSION['id_role'] = $useradmin['id_role'];
if ($useradmin['id_role'] > 2) {
    $err = "Vous n'avez pas accès à cette page";
}


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
                <h1 class="page-title">Page Administration</h1>
            </header>
            <br>
            <br>
            <div class="col-md-10 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-left">Utilisateurs</h3>
                        <p class="text-left text-muted"><?php if (isset($err)) {echo $err;} ?><br>
                            <?php while ($m = $membres->fetch()) { ?>
                        <p class="text-left text-justify"><?= $m['nom'] ?>  <?= $m['prenom'] ?><br>
                        <p class="text-left text-justify">Adresse e-mail : <?= $m['email'] ?><br>
                        <p><a class="btn-danger" href="admin.php?supprime=<?= $m['id'] ?>">Supprimer</a></p><hr>
                            <?php } ?>
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