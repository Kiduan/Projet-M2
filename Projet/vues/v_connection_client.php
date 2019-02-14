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
<form  method="post" action="controleurs/c_connection_client.php?mdp=normal">
<div style="margin: auto; text-align: center; width: 400px;">
    <div id="login">
		<div class="login_entreprise"><img src="image/logo_V5.png"></div>
		<div class="login_interface">
            <div class="administration">connexion</div>
            <div class="login_erreur"></div>
            <div class="login-box-name">email:</div>
            <div class="login-box-field"><input name="email" class="form-login-admin" title="utilisateur:" size="30" maxlength="30" required=""></div><br>
            <div class="login-box-name">mot de passe:</div>
            <div class="login-box-field"><input name="mdp" class="form-login-admin" title="mot de passe:" value="" size="30" required="" maxlength="30" type="password"></div>
            <div><input class="box_submit" name="submit" value="connexion" type="submit"></div><br><br>
            <span class="js-btn btn mdp_oublier">Mot de passe oublié ?</span><a href="index.php?uc=inscription">Nouveau client ?</a>
                </div>
            </div>
		</div>

<div id="footer">Isen Brest - 2019 - © Tous droits réservés - <a href="index.php?uc=admin">Administrateur</a></div>
</form>
<form method="post" action="controleurs/c_connection.php?mdp=oublie">
       <div class="js-fade is-hidden" style="opacity: -0.1; display: none;"><!--div cacher pour la réinitialisation du mpd-->
                    <div class="fenMdp" id="idcontact">
                            <div class="text_mdp"> Indiquer votre email pour recevoir votre nouveau mot de passe</div>
                            <input name="email" value="" title="email:" class ="inputmail" size="20" >
                            <input class="boutonmdp" name="submit" value="Nouveau mot de passe" type="submit">
                    </div>
        	</div>
    </form>
<script>
      // fade out

function fadeOut(el){
  el.style.opacity = 1;

  (function fade() {
    if ((el.style.opacity -= .1) < 0) {
      el.style.display = 'none';
      el.classList.add('is-hidden');
    } else {
      requestAnimationFrame(fade);
    }
  })();
}

// fade in

function fadeIn(el, display){
  if (el.classList.contains('is-hidden')){
    el.classList.remove('is-hidden');
  }
  el.style.opacity = 0;
  el.style.display = display || "block";

  (function fade() {
    var val = parseFloat(el.style.opacity);
    if (!((val += .1) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
}

var btn = document.querySelector('.js-btn');
var el = document.querySelector('.js-fade');

btn.addEventListener('click', function(e){
  if(el.classList.contains('is-hidden')){
    fadeIn(el);
  }
  else {
    fadeOut(el);
  }
});
      //# sourceURL=pen.js
    </script>

    
    <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>