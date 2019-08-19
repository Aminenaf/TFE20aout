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

    if (isset($_POST['modifierprofil'])) {
        $newnom = htmlspecialchars(trim($_POST['newnom']));
        $newprenom = htmlspecialchars(trim($_POST['newprenom']));
        $newtelephone = htmlspecialchars(trim($_POST['newtelephone']));
        $newtotem = htmlspecialchars(trim($_POST['newtotem']));
        $newquali = htmlspecialchars(trim($_POST['newquali']));
        $newmail = htmlspecialchars(trim($_POST['newmail']));
        $newsection = $_POST['newsection'];

        if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
            $tailleMax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if($_FILES['avatar']['size'] <= $tailleMax) {
                $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                if(in_array($extensionUpload, $extensionsValides)) {
                    $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                    if($resultat) {
                        $updateavatar = $bdd->prepare('UPDATE membre SET avatar = :avatar WHERE id = :id');
                        $updateavatar->execute(array(
                            'avatar' => $_SESSION['id'].".".$extensionUpload,
                            'id' => $_SESSION['id']
                        ));
                        header('Location: profil.php?id='.$_SESSION['id']);
                    } else {
                        $err_avatar = "Erreur durant l'importation de votre photo de profil";
                        $valid = false;
                    }
                } else {
                    $err_avatar = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                    $valid = false;
                }
            } else {
                $err_avatar = "Votre photo de profil ne doit pas dépasser 2Mo";
                $valid = false;
            }
        }

        if (empty($_POST['newnom'])) {
            $valid = false;
            $er_nom = "Il faut mettre un nom";
        }

        if (empty($_POST['newprenom'])) {
            $valid = false;
            $er_prenom = "Il faut mettre un prenom";
        }

        if (empty($_POST['newtelephone'])) {
            $valid = false;
            $er_tel = "Il faut mettre un numéro de telephone";
        }

        if (empty($_POST['newmail'])) {
            $valid = false;
            $er_mail = "Il faut mettre un mail";
        } elseif (!filter_var($newmail, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $er_mail = "Le mail n'est pas valide";
        } elseif ($newmail != $user['email']) {
            $reqmail = $bdd->prepare("SELECT * FROM membre WHERE email = ?");
            $reqmail->execute(array($newmail));
            $mailexist = $reqmail->rowCount();
            if ($mailexist >= 1) {
                $valid = false;
                $er_mail = "Ce mail existe déjà";
            }
        }
    }



        if ($valid){

            $modifprofil = $bdd->prepare("UPDATE membre SET nom = ?, prenom = ?, telephone = ?, totem = ?, quali = ?, email = ?, id_section = ? WHERE id = ?");
            $modifprofil->execute(array($newnom, $newprenom, $newtelephone, $newtotem, $newquali, $newmail, $newsection, $_SESSION['id']));
            clearstatcache();
            header('Location: profil.php?id='.$_SESSION['id']);
            exit;
        }
    }


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
            <li><a href="index.php">Home</a></li>
            <li class="active">Profil</li>
        </ol>

        <div class="row">

            <!-- Sidebar -->
            <aside class="col-md-4 sidebar sidebar-left">
                <div class="row widget">
                    <div class="col-xs-12">
                        <h4>Photo de profil</h4>
                        <?php
                        if (!empty($user['avatar'])) {
                        ?>
                        <p><img src="membres/avatars/<?php echo $user['avatar']; ?>" alt=""></p>
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
                <div class="col-md-14">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3 class="thin text-center">Modifier mon profil</h3>
                            <hr>
                            <span class="text-danger"><?php if (isset($er_nom)) {echo $er_nom;}
                                                            if (isset($er_prenom)) {echo $er_prenom;}
                                                            if (isset($er_mail)) {echo $er_mail;}
                                                            if (isset($err_avatar)) {echo $err_avatar;}?></span>
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="top-margin">
                                    <label>Nom</label>
                                    <input type="text" class="form-control" name="newnom" value="<?php echo $user['nom']; ?>">
                                </div>
                                <div class="top-margin">
                                    <label>Prenom</label>
                                    <input type="text" class="form-control" name="newprenom" value="<?php echo $user['prenom']; ?>">
                                </div>
                                <div class="top-margin">
                                    <label>Téléphone</label>
                                    <input type="text" class="form-control" name="newtelephone" value="<?php echo $user['telephone']; ?>">
                                </div>
                                <div class="top-margin">
                                    <label>Totem</label>
                                    <input type="text" class="form-control" name="newtotem" value="<?php if (isset($user['totem'])) {echo $user['totem'];} ?>">
                                </div>
                                <div class="top-margin">
                                    <label>Quali</label>
                                    <input type="text" class="form-control" name="newquali" value="<?php if (isset($user['quali'])) {echo $user['quali'];} ?>">
                                </div>
                                <div class="top-margin">
                                    <label>Adresse e-mail</label>
                                    <input type="text" class="form-control" name="newmail" value="<?php echo $user['email']; ?>">
                                </div>
                                <div class="top-margin">
                                    <label>Photo de profil</label>
                                    <input type="file" class="form-group" name="avatar">
                                </div>
                                <div class="top-margin">
                                    <label>Section</label>
                                    <select name="newsection" class="form-control">
                                        <option <?php if ($user['id_section'] == 1) echo 'selected'; ?> value="1">Baladins</option>
                                        <option <?php if ($user['id_section'] == 2) echo 'selected'; ?> value="2">Louveteaux</option>
                                        <option <?php if ($user['id_section'] == 3) echo 'selected'; ?> value="3">Eclaireurs</option>
                                        <option <?php if ($user['id_section'] == 4) echo 'selected'; ?> value="4">Pionniers</option>
                                        <option <?php if ($user['id_section'] == 5) echo 'selected'; ?> value="5">La Tribu</option>
                                        <option <?php if ($user['id_section'] == 6) echo 'selected'; ?> value="6">Staff d'unité</option>
                                        <option <?php if ($user['id_section'] == 7) echo 'selected'; ?> value="7">Parent</option>
                                        <option <?php if ($user['id_section'] == 8) echo 'selected'; ?> value="8">Ancien</option>
                                    </select>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <button class="btn btn-action2" type="submit" name="retourprofil">Profil</button>
                                    </div>
                                    <div class="col-lg-8 text-right">
                                        <button class="btn btn-action" type="submit" name="modifierprofil">Modifier</button>
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

    <?php include("footer.php"); ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/headroom.min.js"></script>
    <script src="assets/js/jQuery.headroom.min.js"></script>
    <script src="assets/js/template.js"></script>
    </body>
    </html>
