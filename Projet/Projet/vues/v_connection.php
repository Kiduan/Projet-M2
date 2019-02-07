<!--/* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : sucre                        */
    /*                                                         */ 
    /* Description du fichier : Vue de la page de connection   */
    /*                                                         */
    /* @Ce fichier gère l'affichage de la page de connection.  */
    /* Pour pouvoir accéder au site, il faut ce connecter avec */
    /* un compte utilisateur. Le compte comporte un nom, un mot*/
    /* de passe et est lié au client qu'il administre.         */
    /* ------------------------------------------------------- */-->
<script>
  window.console = window.console || function(t) {};
</script>
<?php 
    session_destroy();
?>
<link href="css/login-box_admin.css" rel="stylesheet" type="text/css">
<form  method="post" action="controleurs/c_connection.php?mdp=normal">
<div style="margin: auto; text-align: center; width: 400px;">
    <div id="login">
		<div class="login_entreprise"><img src="image/logo_V5.png"></div>
		<div class="login_interface">
            <div class="administration">administration</div>
            <div class="login_erreur"></div>
            <div class="login-box-name">utilisateur:</div>
            <div class="login-box-field"><input name="nom" class="form-login-admin" title="utilisateur:" size="30" maxlength="30" required=""></div><br>
            <div class="login-box-name">mot de passe:</div>
            <div class="login-box-field"><input name="mdp" class="form-login-admin" title="mot de passe:" value="" size="30" required="" maxlength="30" type="password"></div>
            <div><input class="box_submit" name="submit" value="connexion" type="submit"></div><br><br>     
                </div>
            </div>
		</div>

<div id="footer">Isen Brest - 2019 - © Tous droits réservés</div>