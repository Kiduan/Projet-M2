<!--
/* ------------------------------------------------------- */
/* Frogi-secure   Baron Corentin   2016                    */
/* Site : Frogi-secure distributeur                        */
/*                                                         */ 
/* Description du fichier : Menu du site web               */
/*                                                         */
/* @Ce fichier gér l'affichage du menu principale du       */
/* site web. Ce menu permet de naviguer de page en page.    */
/* ------------------------------------------------------- */-->
<script>
  window.console = window.console || function(t) {};
</script>

<!--menu start--> 
<ul class="menu">
<li class="li_menu"><a   class="<?php 
    if (activeMenu("acceuil")==activeMenu("recherche") && activeMenu("acceuil")==activeMenu("contact"))
        $active="active";
    else $active = activeMenu("acceuil"); 
    echo"$active";?>" href="index.php">Acceuil</a></li>
  <li class="li_menu"><a   class="<?php $active = activeMenu("recherche"); echo"$active";?>"href="index.php?uc=recherche">Recherche</a></li>
<li class="li_menu"><a href="controleurs/c_deconnection.php">Coupons</a></li>
    <li class="deco"><a href="controleurs/c_deconnection.php">Déconnexion</a>
    <li class="deco" ><a href="index.php?uc=compte">Compte</a>
    
</li>
</ul>
<script src="//assets.codepen.io/assets/common/stopExecutionOnTimeout-ddaa1eeb67d762ab8aad46508017908c.js"></script>

    
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
    <!--menu end-->

          