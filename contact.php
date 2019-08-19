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
        <li class="active">Contact</li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-sm-9 maincontent">
            <header class="page-header">
                <h1 class="page-title">Contactez-nous</h1>
            </header>
            <br>
            <form>
                <div class="row">
                    <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="Nom">
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="E-mail">
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" placeholder="Numéro de téléphone">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <textarea placeholder="Ecrivez votre message ici ..." class="form-control" rows="9"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6 text-right">
                        <input class="btn btn-action" type="submit" value="Envoyer">
                    </div>
                </div>
            </form>

        </article>
        <!-- /Article -->

        <!-- Sidebar -->
        <aside class="col-sm-3 sidebar sidebar-right">

            <div class="widget">
                <h4>Addresse</h4>
                <address>
                    Eglise de Froidmont 1330 Rixensart
                </address>
                <h4>Téléphone</h4>
                <address>
                    +32 478 56 77 43
                </address>
            </div>

        </aside>
        <!-- /Sidebar -->

    </div>
</div>	<!-- /container -->

<section class="container-full top-space">
    <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?q=%C3%A9glise%20saint%20etienne%20rixensart&t=k&z=17&ie=UTF8&iwloc=&output=embed"></iframe>
</section>

<?php include("footer.php") ?>


<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="assets/js/headroom.min.js"></script>
<script src="assets/js/jQuery.headroom.min.js"></script>
<script src="assets/js/template.js"></script>
</body>
</html>
