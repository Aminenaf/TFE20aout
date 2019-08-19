<?php

include("dbConnect.php");

if(isset($_POST['forminscription']))
{
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $idsection = $_POST['section'];
    $mdp = $_POST['mdp'];
    $mdpHash = password_hash($mdp, PASSWORD_BCRYPT);
    $mdp2 = $_POST['mdp2'];
    $mdpHash2 = password_hash($mdp2, PASSWORD_BCRYPT);
    $dateNaiss = $_POST['dateNaiss'];

    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['telephone']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {
        $nomlenght = strlen($nom);
        $prenomlenght = strlen($prenom);
        $telephonelenght = strlen($telephone);

        if ($nomlenght <= 45)
        {
            if ($prenomlenght <= 45)
            {
                if ($telephonelenght <= 15)
                {
                    if ($mail == $mail2) {
                        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                            $reqmail = $bdd->prepare("SELECT * FROM membre WHERE email = ?");
                            $reqmail->execute(array($mail));
                            $mailexist = $reqmail->rowCount();
                            if ($mailexist == 0) {
                                if ($mdp == $mdp2) {
                                   if (strlen($mdp) > 6) {
                                       if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $mdp)) {
                                           session_start();
                                           $_SESSION['nom'] = $nom;
                                           $_SESSION['prenom'] = $prenom;
                                           $_SESSION['dateNaiss'] = $dateNaiss;
                                           $_SESSION['telephone'] = $telephone;
                                           $_SESSION['mail'] = $mail;
                                           $_SESSION['mdp'] = $mdpHash;
                                           $_SESSION['idsection'] = $idsection;
                                           $tokenmail = bin2hex(random_bytes(9));
                                           $newtokenmail = $bdd->prepare("INSERT INTO token(token_mail, token_mail_exp) VALUE (?,now() + INTERVAL 24 HOUR)");
                                           $newtokenmail->execute(array($tokenmail));
                                           $error = "Votre compte à bien été créé, un mail d'activation vous sera envoyé<br>
                                                          Vous pouvez clicker sur le lien suivant pour activer votre compte<br>
                                                          Liens d'activation -> <a href='http://localhost/tfeAmine/tfe/confirmAction.php?token=$tokenmail'>Clickez ici</a> <br>
                                                          Le lien n'est plus valide après 24h";
                                           //header("Location: connexion.php");
                                       } else {$error = "Votre mot de passe doit comporter des minuscules, des majuscules et des chiffres";}
                                   } else {$error = 'Le mot de passe doit contenir minimum 6 caractère';}
                                } else { $error = "Les mots de passe ne correspondent pas"; }
                            } else {
                                $error = "Adresse mail déjà utilisée";
                            }
                        } else {
                            $error = "Votre adresse mail n'est pas valide";
                        }
                    } else {
                        $error = "Les mails ne correspondent pas";
                    }
                }
                else {
                    $error = "Le numéro de téléphone n'est pas conforme";
                }
            }
            else {
                $error = "Le prénom ne peut pas dépasser 45 caractères";
            }
        }
        else
        {
            $error = "Le nom ne peut pas dépasser 45 caractères";
        }
    }
    else
    {
        $error = 'Tous les champs doivent être completé';
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
        <li class="active">Inscription</li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-xs-12 maincontent">
            <header class="page-header">
                <h1 class="page-title">Inscription</h1>
            </header>

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Enregistrer un nouveau compte</h3>
                        <p class="text-center text-muted">Si vous avez déjà un compte vous pouvez directement vous <a href="connexion.php">connecter</a> ! </p>
                        <hr>
                        <?php
                        if (isset($error))
                        {
                            echo '<span style="color: red; ">' . $error . '</span>';
                        }
                        ?>

                        <form method="post" action="">
                            <div class="top-margin">
                                <label>Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nom" value="<?php if(isset($nom)) {echo $nom;} ?>" required>
                            </div>
                            <div class="top-margin">
                                <label>Prenom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>" required>
                            </div>
                            <div class="top-margin">
                                <label>Date de naissance <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="dateNaiss" value="<?php if(isset($dateNaiss)) {echo $dateNaiss;} ?>" required>
                            </div>
                            <div class="top-margin">
                                <label>Numéro de telephone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="telephone" value="<?php if(isset($telephone)) {echo $telephone;} ?>" required>
                            </div>
                            <div class="top-margin">
                                <label>Adresse e-mail <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mail" value="<?php if(isset($mail)) {echo $mail;} ?>" required>
                            </div>
                            <div class="top-margin">
                                <label>Confirmer mon adresse mail <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mail2" value="<?php if(isset($mail2)) {echo $mail2;} ?>" required>
                            </div>
                            <div class="row top-margin">
                                <div class="col-sm-6">
                                    <label>Mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="mdp" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Confirmer mot de passe <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="mdp2" required>
                                </div>
                            </div>
                            <div class="top-margin">
                                <label>Section <span class="text-danger">*</span></label><br>
                                <select name="section" class="form-control">
                                    <option value="1">Baladins</option>
                                    <option value="2">Louveteaux</option>
                                    <option value="3">Eclaireurs</option>
                                    <option value="4">Pionniers</option>
                                    <option value="5">La Tribu</option>
                                    <option value="6">Staff d'unité</option>
                                    <option value="7">Parent</option>
                                    <option value="8">Ancien</option>
                                </select>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-action" type="submit" name="forminscription">Je m'inscris ! </button>
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
<script src="https://www.google.com/recaptcha/api.js?render=6Le6FbIUAAAAACTlQSXxa0Xt20MlAx77-XfgNFMO"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6Le6FbIUAAAAACTlQSXxa0Xt20MlAx77-XfgNFMO', {action: 'homepage'}).then(function(token) {
            console.log(token);
        });
    });
</script>
<?php include("footer.php") ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="assets/js/headroom.min.js"></script>
<script src="assets/js/jQuery.headroom.min.js"></script>
<script src="assets/js/template.js"></script>
</body>
</html>

