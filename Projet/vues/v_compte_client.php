<!--
/* ------------------------------------------------------- */
/* Frogi-secure   Baron Corentin   2016                    */
/* Site : Frogi-secure distributeur                        */
/*                                                         */ 
/* Description du fichier : Vue de la page de modification */
/*                                    de compte            */
/*                                                         */
/* @Ce fichier gère l'affichage de la page de modification */
/* du compte de l'utilisateur connecté. Il peut changer:   */
/* Nom de compte, mot de passe et adresse email            */
/* ------------------------------------------------------- */-->

<div class="titrecentre" style="width: 28%;">Compte</div>
    <div class="fcentre" style="width: 28%;">
         <form  method="post" action="controleurs/c_compte_client.php" onsubmit="">
             <?php 
                //------------Nom--------------- 
                echo "<label for='Anom' class='param_libelleR'>Nom de compte : </label>";
                echo "<label for='Anom' class='param_valeurR'>", $_SESSION['Nom'] ,"</label>";
                echo"<div class='clear'></div>";
                echo "<label for='nom' class='param_libelleR'>Nouveau nom de compte : </label>";
                echo '<div class="param_valeurR"><input type="text" name="nom" id="indexnom" onblur="verif(this)"/></div>';
                echo"<div class='clear'></div>";echo"<div class='espace'></div>"; echo"<div class='clear'></div>";
                //------------email--------------- 
                echo "<label for='Aemail' class='param_libelleR'>Email : </label>";
                echo "<label for='Aemail' class='param_valeurR'>", $_SESSION['Email'],"</label>";
                echo"<div class='clear'></div>";
                echo "<label for='email' class='param_libelleR'>Nouvel email : </label>";
                echo '<div class="param_valeurR"><input type="text" name="email" id="indexemail" onblur="verif(this)"/></div>';
                echo"<div class='clear'></div>";echo"<div class='espace'></div>"; echo"<div class='clear'></div>";
                //------------mdp--------------- 
                echo "<label for='Amdp' class='param_libelleR'>Mot de passe : *</label>";
                echo '<div class="param_valeurR"><input name="Amdp" id="indexAmdp" onblur="verif(this)" type="password" required/></div>';
                echo"<div class='clear'></div>";
                echo "<label for='mdp' class='param_libelleR'>Nouveau mot de passe : </label>";
                echo '<div class="param_valeurR"><input name="mdp1" id="indexmdp" onblur="verif(this)" type="password"/></div>';
                echo"<div class='clear'></div>";
                echo "<label for='mdp' class='param_libelleR'>Nouveau mot de passe : </label>";
                echo '<div class="param_valeurR"><input name="mdp2" id="indexmdp" onblur="verif(this)" type="password"/></div>';
                echo"<div class='clear'></div>";
?>
<input type="submit" value="Modifier" class="boxcompte"/>
             <div class='clear'></div>
         </form>
</div>