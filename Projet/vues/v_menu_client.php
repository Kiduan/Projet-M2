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
    if (activeMenu("acceuil")==activeMenu("temps") && activeMenu("acceuil")==activeMenu("compte"))
        $active="active";
    else $active = activeMenu("acceuil"); 
    echo"$active";?>" href="index.php">Acceuil</a></li>
  <li class="li_menu"><a   class="<?php $active = activeMenu("temps"); echo"$active";?>"href="index.php?uc=temps">Ajouter du temps</a></li>
    <li class="deco"><a href="controleurs/c_deconnection.php">Déconnexion</a>
    <li class="deco" ><a class="<?php $active = activeMenu("compte"); echo"$active";?>" href="index.php?uc=compte">Compte</a>
    
</li>
</ul>          