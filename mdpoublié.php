<?php

include("dbConnect.php");

if (isset($_POST['formmdp']))
{
    $mailmdpoublié = htmlspecialchars($_POST['mailmdpoublié']);

    if (!empty($mailmdpoublié))
    {
        $requser = $bdd->prepare("SELECT * FROM membre WHERE email = ?");
        $requser->execute(array($mailmdpoublié));
        $userexist = $requser->rowCount();
        if ($userexist == 1)
        {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $userinfoid = $userinfo['id'];
            //$_SESSION['nom'] = $userinfo['nom'];
            //$_SESSION['prenom'] = $userinfo['prenom'];
            //$_SESSION['telephone'] = $userinfo['telephone'];
            //$_SESSION['email'] = $userinfo['email'];
            //$_SESSION['section'] = $userinfo['section'];

            //header("Location: profil.php?id=".$_SESSION['id']);
            //$error = "Ce mail existe";
            $token = bin2hex(random_bytes(9));
            $newtoken = $bdd->prepare("INSERT INTO token(token_mdp, token_mdp_exp) VALUE (?,now() + INTERVAL 24 HOUR)");
            $newtoken->execute(array($token));
            $error = "Vous avez demandé une réinitialisation du mot de passe <br>
                            Voici votre token : <a href='http://localhost/tfe/resetAction.php?token=$token'>Clickez ici</a> <br>
                            Le lien ci-dessus n'est plus valide après 24h à partir du moment ou vous avez fait une demande de nouveau mot de passe <br>
                            Merci ";
        }
        else
        {
            $error = "Ce mail n'existe pas";
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
                <h1 class="page-title">Mot de passe oublié</h1>
            </header>

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Mot de passe oublié</h3>
                        <p class="text-center text-muted">Un mail vous sera envoyé sur votre boite mail</p>
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
                                <input type="text" class="form-control" name="mailmdpoublié">
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-action" type="submit" name="formmdp">Envoyer nouveau mot de passe</button>
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

