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
    if (activeMenu("acceuil")==activeMenu("recherche"))
        $active="active";
    else $active = activeMenu("acceuil"); 
    echo"$active";?>" href="index.php">Acceuil</a></li>
  <li class="li_menu"><a   class="<?php $active = activeMenu("recherche"); echo"$active";?>"href="index.php?uc=recherche">Recherche</a></li>
    <li class="deco"><a href="controleurs/c_deconnection.php">Déconnexion</a>
    
</li>
</ul>          