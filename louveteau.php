<?php

$bdd = new PDO('mysql:host=localhost;dbname=scout;charset=utf8','root', '');
$userinfo =  array();
$userinfo['id'] = -1;
if (isset($_SESSION['id'])) {


    $userinfo['id'] = $_SESSION['id'];

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
        <li class="active">Louveteaux</li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-sm-8 maincontent">
            <header class="page-header">
                <h1 class="page-title">Louveteaux</h1>
            </header>
            <h3>Lorem ipsum</h3>
            <p><img src="assets/images/louveteaux.jpg" alt="" class="img-rounded pull-right" height="252" width="260"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, consequuntur eius repellendus eos aliquid molestiae ea laborum ex quibusdam laudantium voluptates placeat consectetur quam aliquam beatae soluta accusantium iusto nihil nesciunt unde veniam magnam repudiandae sapiente.</p>
            <p>Quos, aliquam nam velit impedit minus tenetur beatae voluptas facere sint pariatur! Voluptatibus, quisquam, error, est assumenda corporis inventore illo nesciunt iure aut dolor possimus repellat minima veniam alias eius!</p>
            <h3>Necessitatibus</h3>
            <p>Velit, odit, eius, libero unde impedit quaerat dolorem assumenda alias consequuntur optio quae maiores ratione tempore sit aliquid architecto eligendi pariatur ab soluta doloremque dicta aspernatur labore quibusdam dolore corrupti quod inventore. Maiores, repellat, consequuntur eius repellendus eos aliquid molestiae ea laborum ex quibusdam laudantium voluptates placeat consectetur quam aliquam!</p>
            <h3>Fugit, laboriosam</h3>
            <p>Eum, quasi, est, vitae, ipsam nobis consectetur ea aspernatur ad eos voluptatibus fugiat nisi perferendis impedit. Quam, nulla, excepturi, voluptate minus illo tenetur sint ab in culpa cumque impedit quibusdam. Saepe, molestias quia voluptatem natus velit fugiat omnis rem eos sapiente quasi quaerat aspernatur quisquam deleniti accusantium laboriosam odio id?</p>
            <h3>Doloribus, illo ipsum</h3>
            <p>Velit, odit, eius, libero unde impedit quaerat dolorem assumenda alias consequuntur optio quae maiores ratione tempore sit aliquid architecto eligendi pariatur ab soluta doloremque dicta aspernatur labore quibusdam dolore corrupti quod inventore. Maiores, repellat, consequuntur eius repellendus eos aliquid molestiae ea laborum ex quibusdam laudantium voluptates placeat consectetur quam aliquam!</p>
            <p>Eum, quasi, est, vitae, ipsam nobis consectetur ea aspernatur ad eos voluptatibus fugiat nisi perferendis impedit. Quam, nulla, excepturi, voluptate minus illo tenetur sint ab in culpa cumque impedit quibusdam. Saepe, molestias quia voluptatem natus velit fugiat omnis rem eos sapiente quasi quaerat aspernatur quisquam deleniti accusantium laboriosam odio id?</p>

        </article>
        <!-- /Article -->

        <!-- Sidebar -->
        <aside class="col-sm-4 sidebar sidebar-right">
            <?php
            if (isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
            {
                ?>
                <div class="widget">
                    <h2>Le Staff Louveteau</h2>
                    <div class="ok">
                        <div class="col-md-12 col-sm-6 highlight">
                            <div class="h-caption"><img src="assets/images/photoprofil.jpg" alt="Nico" height="max-height" width="max-width"></div>
                            <div class="h-body text-center">
                                <br>
                                <h4>Nom : Petit</h4>
                                <h4>Prenom : Nicolas </h4>
                                <h4>Age : 24 ans </h4>
                                <h4>Telephone : 0475123456 </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-6 col-lg-12 highlight">
                    <div class="h-caption"><img src="assets/images/photoprofil.jpg" alt="Nico" height="max-height" width="max-width"></div>
                    <div class="h-body text-center">
                        <br>
                        <h4>Nom : Petit</h4>
                        <h4>Prenom : Nicolas </h4>
                        <h4>Age : 24 ans </h4>
                        <h4>Telephone : 0475123456 </h4>
                    </div>
                </div>
                <div class="col-md-12 col-sm-6 col-lg-12 highlight">
                    <div class="h-caption"><img src="assets/images/photoprofil.jpg" alt="Nico" height="max-height" width="max-width"></div>
                    <div class="h-body text-center">
                        <br>
                        <h4>Nom : Petit</h4>
                        <h4>Prenom : Nicolas </h4>
                        <h4>Age : 24 ans </h4>
                        <h4>Telephone : 0475123456 </h4>
                    </div>
                </div>
                <div class="col-md-12 col-sm-6 col-lg-12 highlight">
                    <div class="h-caption"><img src="assets/images/photoprofil.jpg" alt="Nico" height="max-height" width="max-width"></div>
                    <div class="h-body text-center">
                        <br>
                        <h4>Nom : Petit</h4>
                        <h4>Prenom : Nicolas </h4>
                        <h4>Age : 24 ans </h4>
                        <h4>Telephone : 0475123456 </h4>
                    </div>
                </div>


                <?php
            }
            else { ?>
                <div class="widget">
                    <h2>Le Staff Louveteau</h2>
                    <div class="col-md-10 col-sm-6 highlight">
                        <div class="h-caption"><h3><i class="fa fa-ban"></i><span class="text-danger">Accès limité</span></h3></div>
                        <div class="h-body text-center">
                            <p>Vous devez être connecté pour pouvoir voir les membres du staff<br><a href="connexion.php">Se connecter</a></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </aside>
        <!-- /Sidebar -->

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
