<?php
include './admin/lib/php/adm_liste_include.php';
include './admin/lib/php/fonctions_panier.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>

        <!--balises meta-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--liens css-->
        <link href="admin/lib/css/bootstrap.min.css" rel="stylesheet">
        <link href="admin/lib/css/font-awesome.min.css" rel="stylesheet">
        <link href="admin/lib/css/animate.css" rel="stylesheet">
        <link href="admin/lib/css/main.css" rel="stylesheet">
        <link href="admin/lib/css/responsive.css" rel="stylesheet">

        <!--appel des scripts js-->
        <script src="admin/lib/js/jquery.js"></script>
        <script src="admin/lib/js/bootstrap.min.js"></script>
        <script src="admin/lib/js/jquery.scrollUp.min.js"></script>
        <script src="admin/lib/js/main.js"></script>
        <script src="admin/lib/js/kt_function.js"></script>

        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

        <title>K-town | Le paradis de la K-pop</title>       

    </head><!--/head-->

    <body>
        <header id="header">
            <?php
            if (file_exists("./lib/php/header.php")) {
                include("./lib/php/header.php");
            }
            ?>
        </header>

        <section>
            <?php
            /* le contenu change en fonction de la navigation */
            if (!isset($_SESSION['page'])) {
                $_SESSION['page'] = "./pages/accueil.php";
            } else {

                if (isset($_GET['page'])) {
                    //print $_GET['page'];
                    $_SESSION['page'] = "./pages/".$_GET['page'];
                }
            }
          
            if (file_exists($_SESSION['page'])) {
                include $_SESSION['page'];
            } else {
                include("./lib/php/erreur.php");
            }
            ?>	
        </section>

        <footer id="footer"><!--Footer-->
            <?php
            if (file_exists("./lib/php/footer.php")) {
                include("./lib/php/footer.php");
            }
            ?>
        </footer><!--/Footer-->




    </body>
</html>