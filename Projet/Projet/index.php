
<?php
/* ------------------------------------------------------- */
/* Frogi-secure   Baron Corentin   2016                    */
/* Site : Frogi-secure distributeur                        */
/*                                                         */ 
/* Description du fichier : Fichier principal PHP          */
/*                                                         */
/* @Ce fichier fait la liaison entre les différentes pages */
/* du site web, il permet d'afficher les pages demandées   */
/* sans changer de position dans l'arborescence du site    */
/* ------------------------------------------------------- */
    session_start();
?>
<html class=" js no-touch backgroundsize csstransforms3d csstransitions csstransforms" lang="en">
    <head><title>Démasquer le sucre</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="scripts/script.js"></script>
    <script type="text/javascript" src="scripts/jquery.tools.min.js"></script>
    <script type="text/javascript" src="scripts/jquery-ui-1.8.21.custom.min.js"></script>
</head>
    <body>
    <div class="wrapper spHeight" id="wrapper">
      <header>
          <div style="padding:20px;margin-top:30px;"></div>  
    <?php
        if (isset($_SESSION['Nom']))//Si la session est activée
        {
            require_once("includes/fct.php");
            require_once("includes/pdo.php");
            $pdoExetud = new PdoBDD("localhost", "test", "isen29", "bdd_sucre");
            include("vues/v_menu.php");
            $uc = lireDonneeUrl('uc');
            switch($uc) {
                    case 'recherche' :
                        $_SESSION['Liste']=array(0);//met le tableau à 0 pour qu'il ne s'affiche pas si aucune recherche n'a été lancée
                        include("controleurs/c_recherche.php");
                        include("vues/v_recherche.php");
                        $_SESSION['Tri'] = "no";break;
                    case 'info':
                        rechercheNul();
                        include("vues/v_info.php");
                        break;
                    case 'compte':
                        include("vues/v_compte.php");
                        switch ($_SESSION['Erreur']) {
                            case 'oui': echo "<script>alert(\"Modification effectuée\")</script>";   break;
                            case 'Mdp!=': echo "<script>alert(\"Erreur, mot de passe différent\")</script>";   break;
                            case 'FalseMdp': echo "<script>alert(\"Mot de passe incorrect !\")</script>";   break;
                            default:break;
                        }
                        $_SESSION['Erreur']="no";
                        break;
                    case 'coupons':
                        include("controleurs/c_coupons.php");
                        include("vues/v_coupons.php");
                        $_SESSION['Tri'] = "no";break;
                    default :
                        rechercheNul();
                        include("controleurs/c_acceuil.php");
                        include("vues/v_acceuil.php");break;  
            }
        }else   {
            if (isset($_SESSION['Erreur'])) {
                switch($_SESSION['Erreur']) {
                    case 'mdp_erreur' : 
                        echo "<script>alert(\"Mot de passe ou nom d'utilisateur incorrect !\")</script>";   break;
                    case 'mdp_change' :
                        echo "<script>alert(\"Email envoyé!\")</script>";   break;
                    case 'email_erreur':
                        echo "<script>alert(\"Email incorrect\")</script>";   break;
                    default : break;
                }
            }
            include("vues/v_connection.php");
        }
    ?><div style="padding:20px;margin-bottom:5px;"></div>
</header>
</div></body></html>
    