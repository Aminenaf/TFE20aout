<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("dbConnect.php");

clearstatcache();


if (isset($_GET['id']) AND $_GET['id'] > 0)
{
    if (isset($_SESSION['id']) == null)
    {
        header("Location: connexion.php");
        die;
    }
$getid = intval($_GET['id']);
$requser = $bdd->prepare("SELECT * FROM membre WHERE id = ?");
$requser->execute(array($getid));
$userprofil = $requser->fetch();

    $reqsection = $bdd->prepare("call getSectionByUser(?)");
    $reqsection->execute(array($getid));
    $sectioninfo = $reqsection->fetch();

    if (isset($_SESSION['id']) AND isset($_GET['id']) AND $_GET['id'] == $_SESSION['id']) {

        ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"    content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author"      content="Amine">

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
			<li class="active">Profil</li>
            <li class="active"><?php echo $sectioninfo['nom_section']?></li>
            <li class="active"><?php echo $userprofil['prenom']?></li>
		</ol>

		<div class="row">

			<!-- Sidebar -->
			<aside class="col-md-4 sidebar sidebar-left">
				<div class="row widget">
					<div class="col-xs-12">
						<h4>Photo de profil</h4>
                        <?php
                        if (!empty($userprofil['avatar'])) {
                            ?>
                            <p><img src="membres/avatars/<?php echo $userprofil['avatar'];?>" width="inherit" height="inherit"></p>
                            <?php
                        } else {
                        ?>
                            <p><img src="assets/images/pp.png"></p>
                        <?php } ?>    
					</div>
				</div>

			</aside>
			<!-- /Sidebar -->

			<!-- Article main content -->
			<article class="col-md-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">Profil de <?php echo $userprofil['prenom']?> </h1>
				</header>
                <h3>Section : <span class="text-muted"><?php echo $sectioninfo['nom_section'] ?></span></h3><hr>
                <h4>Nom : <span class="text-muted"><?php echo $userprofil['nom']?></span></h4><hr>
                <h4>Prenom : <span class="text-muted"><?php echo $userprofil['prenom']?></span></h4><hr>
                <h4>Date de naissance : <span class="text-muted"><?php echo $userprofil['date_naissance']?></span></h4><hr>
                <h4>Numéro de téléphone : <span class="text-muted"><?php echo $userprofil['telephone']?></span></h4><hr>
                <h4>Totem : <span class="text-muted"><?php if (isset($userprofil['totem'])) {echo $userprofil['totem'];}?></span></h4><hr>
                <h4>Quali : <span class="text-muted"><?php if (isset($userprofil['quali'])) {echo $userprofil['quali'];}?></span></h4><hr>
                <h4>Adresse-mail : <span class="text-muted"><?php echo $userprofil['email']?></span></h4><hr>

                    <p><a href="editionprofil.php">Editer mon profil / Ajouter des informations</a></p><hr>
                    <p><a href="modifimdp.php">Modifier mon mot de passe</a></p><hr>
                    <p><a href="deconnexion.php">Se déconnecter</a></p>

			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->

<?php include("footer.php"); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="assets/js/headroom.min.js"></script>
<script src="assets/js/jQuery.headroom.min.js"></script>
<script src="assets/js/template.js"></script>
</body>
</html>
        <?php
    } else {
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
                                <h3 class="thin text-center">No Access</h3>
                                <p class="text-center text-muted">Vous ne pouvez pas accéder à cette page<br></p>
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
<?php } ?>
<?php
    }
?>