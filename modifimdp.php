<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("dbConnect.php");


if (!isset($_SESSION['id'])){
    header('Location: connexion.php');
    exit;
}

$requser = $bdd->prepare("SELECT * FROM membre WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();

if (isset($_POST['retourprofil'])) {header('Location: profil.php?id='.$_SESSION['id']);}

if(!empty($_POST)) {
extract($_POST);
$valid = true;

    if (isset($_POST['formmdp']))
    {
        if (isset($_POST['oldmdp']) AND !empty($_POST['oldmdp']) AND isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
        {
            $oldmdp = sha1($_POST['oldmdp']);
            $newmdp = sha1($_POST['newmdp']);
            $newmdp2 = sha1($_POST['newmdp2']);

            if ($oldmdp == $user['mdp'])
            {
                if ($newmdp == $newmdp2) {
                    $insertmdp = $bdd->prepare("UPDATE membre SET mdp = ? WHERE id = ?");
                    $insertmdp->execute(array($newmdp, $_SESSION['id']));
                    header('Location: profil.php?id=' . $_SESSION['id']);
                } else {
                    $msg = "Les mdp ne correspondent pas";
                }
            }
            else
            {
                $msg = "L'ancien mot de passe ne correspond pas";
            }
        }
    }
}

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
                <h1 class="page-title">Modification du mot de passe</h1>
            </header>
            <br>
            <br>
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Vous pouvez modifier votre mot de passe ci-dessous</h3>
                        <hr>
                        <form method="post" action="">
                            <div class="row top-margin">
                                <div class="col-sm-4">
                                    <label>Ancien mot de passe</label>
                                    <input type="password" class="form-control" name="oldmdp">
                                </div>
                                <div class="col-sm-4">
                                    <label>Nouveau mot de passe</label>
                                    <input type="password" class="form-control" name="newmdp">
                                </div>
                                <div class="col-sm-4">
                                    <label>Confirmer mot de passe</label>
                                    <input type="password" class="form-control" name="newmdp2">
                                </div>
                            </div>
                            <hr>
                            <span class="text-danger"><?php if (isset($msg)) {echo $msg;}?></span>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4">
                                    <button class="btn btn-action2" type="submit" name="retourprofil">Profil</button>
                                </div>
                                <div class="col-lg-8 text-right">
                                    <button class="btn btn-action" type="submit" name="formmdp">Modifier</button>
                                </div>
                            </div>
                        </form>
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