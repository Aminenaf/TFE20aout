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
        <li class="active">Demande d'inscription</li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-sm-12 maincontent">
            <header class="page-header">
                <h1 class="page-title text-center">Demande d'inscription pour mon enfant</h1>
            </header>
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class="thin text-center">Demande Inscription</h3>
                    <p class="text-center text-muted">Un mail sera envoyé aux staffs, nous vous répondrons dans les plus brefs délais</p>
            <form>
                <div class="row top-margin">
                    <div class="col-sm-4">
                        <label>Nom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nom" value="" required>
                    </div>
                    <div class="col-sm-4">
                        <label>Prénom <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="prenom" value="" required>
                    </div>
                    <div class="col-sm-4">
                        <label>Date de Naissance<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="dateNaiss" value="" required>
                    </div>
                </div>
                <br>
                <div class="row top-margin">
                    <div class="col-sm-4">
                        <label>Année scolaire <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="anneescol" value="(Ex: 3ème primaire)" required>
                    </div>
                    <div class="col-sm-4">
                        <label>Commune <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="commune" value="(Ex: Rixensart)" required>
                    </div>
                    <div class="col-sm-4">
                        <label>Telephone 1 <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" name="tel1" value="" required>
                    </div>
                </div>
                <br>
                <div class="row top-margin">
                    <div class="col-sm-4">
                        <label>Telephone 2 (Si Tel 1 non-joignable) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tel2" value="" required>
                    </div>
                    <div class="col-sm-4">
                        <label>Adresse email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="email" value="" required>
                    </div>
                    <div class="col-sm-4">
                        <label>Section <span class="text-danger">*</span></label><br>
                        <select name="section" class="form-control">
                            <option value="1">Baladins</option>
                            <option value="2">Louveteaux</option>
                            <option value="3">Eclaireurs</option>
                            <option value="4">Pionniers</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row top-margin">
                    <div class="col-sm-10">
                        <label>Commentaire :</label>
                        <textarea placeholder="Ecrivez votre message ici ..." class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <input class="btn btn-action" type="submit" value="Envoyer">
                    </div>
                </div>
            </form>
                </div>
            </div>

        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->

<?php include("footer.php") ?>


<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="assets/js/headroom.min.js"></script>
<script src="assets/js/jQuery.headroom.min.js"></script>
<script src="assets/js/template.js"></script>
</body>
</html>