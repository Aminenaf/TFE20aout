<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("dbConnect.php");

if (isset($_POST['formconnexion']))
{
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = $_POST['mdpconnect'];

    if (!empty($mailconnect) AND !empty($mdpconnect))
    {
        $requser = $bdd->prepare("SELECT * FROM membre WHERE email = ?");
        $requser->execute(array($mailconnect));
        $userexist = $requser->rowCount();
        if ($userexist == 1)
        {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['nom'] = $userinfo['nom'];
            $_SESSION['prenom'] = $userinfo['prenom'];
            $_SESSION['telephone'] = $userinfo['telephone'];
            $_SESSION['email'] = $userinfo['email'];
            //$_SESSION['section'] = $userinfo['section'];
            $_SESSION['mdp'] = $userinfo['mdp'];

            if (password_verify($mdpconnect, $userinfo['mdp'])) {
                header("Location: profil.php?id=".$_SESSION['id']);
            }
            else {$error = "Password incorrect";}

        }
        else
        {
            $error = "Adresse mail non trouvé";
        }
    }
    else
    {
        $error = "Tout les champs doivent être rempli";
    }
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

    <ol class="breadcrumb">
        <li><a href="index.php">Acceuil</a></li>
        <li class="active">Accès utilisateur</li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-xs-12 maincontent">
            <header class="page-header">
                <h1 class="page-title">Connexion</h1>
            </header>

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Connexion à mon compte</h3>
                        <p class="text-center text-muted">Vous n'avez pas encore de compte et vous faite partie de l'unité ou vos enfants en font partie ? Alors <a href="inscription.php">inscrivez-vous</a> ! </p>
                        <hr>
                        <?php
                        if (isset($error))
                        {
                            echo '<span style="color: red; ">' . $error . '</span>';
                        }
                        ?>
                        <form method="post" action="">
                            <div class="top-margin">
                                <label>Adresse e-mail <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mailconnect">
                            </div>
                            <div class="top-margin">
                                <label>Mot de passe <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="mdpconnect">
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-8">
                                    <b><a href="mdpoublié.php">Mot de passe oublié ?</a></b>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-action" type="submit" name="formconnexion">Connexion</button>
                                </div>
                            </div>
                        </form>
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
