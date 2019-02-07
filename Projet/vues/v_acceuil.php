<!--/* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : Frogi-secure distributeur                        */
    /*                                                         */ 
    /* Description du fichier : Vue de la page d'acceuil       */
    /*                                                         */
    /* @Ce fichier gère l'affichage de la page d'acceuil.      */
    /* La page d'accceuilest la page par défaut du site. On y  */
    /* arrive après que l'utilisateur est bien connecté.       */
    /* Cette page liste dans un tableau tout les clients liés à*/
    /* l'utilisateur connecté.                                 */
    /* ------------------------------------------------------- */-->
<div class="acceuil">   <form  method="post" action="index.php?uc=coupons"> <table class="table-fill">
<?php
            $ordre=lireDonneeUrl('ordre');
             echo"<tr class='hov'><thead>";
     /* tableau de l'acceuil que l'on tri de base par client en ASC en cliquant sur les liens dans le tr l'utilisateur peut changer l'ordre 
        et le mode de tri. Ainsi on n'affiche pas le même bouton client si on tri en client asc car il faut que si on reclique sur le bouton 
        client il ordonne alors en desc.
        On affiche donc le bouton [tri][ordre inverse] si il a tri en [tri][ordre].
        */
        if ($ordre != "")   {
            switch($_SESSION['Tri'])    {
                case 'nom': 
                    if ($ordre == "ASC"){
                        echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=DESC'>Nom</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=email&ordre=ASC'>Email</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=date_inscription&ordre=ASC'>Date d'inscription</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=vip&ordre=ASC'>VIP</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=temps&ordre=ASC'>Temps</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=DESC'>Mot de passe</a></th>";
                        echo "<th class='text-left' ><input type='submit' value='Coupons' class='boxRrecherche'/></th>";
                    }  
                    else {
                        echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Nom</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=email&ordre=ASC'>Email</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=date_inscription&ordre=ASC'>Date d'inscription</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=vip&ordre=ASC'>VIP</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=temps&ordre=ASC'>Temps</a></th>";
                        echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Mot de passe</a></th>";
                        echo "<th class='text-left' ><input type='submit' value='Coupons' class='boxRrecherche'/></th>";
                    }
                    break;
                case 'email':
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Nom</a></th>";
                    if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?tri=email&ordre=DESC'>Email</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=email&ordre=ASC'>Email</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_inscription&ordre=ASC'>Date d'inscription</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=vip&ordre=ASC'>VIP</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=temps&ordre=ASC'>Temps</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Mot de passe</a></th>";
                    echo "<th class='text-left' ><input type='submit' value='Coupons' class='boxRrecherche'/></th>";
                    break;
                case 'date_inscription':
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Nom</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=email&ordre=ASC'>Email</a></th>";
                    if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?tri=date_inscription&ordre=DESC'>Date d'inscription</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=date_inscription&ordre=ASC'>Date d'inscription</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=vip&ordre=ASC'>VIP</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=temps&ordre=ASC'>Temps</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Mot de passe</a></th>";
                    echo "<th class='text-left' ><input type='submit' value='Coupons' class='boxRrecherche'/></th>";
                    break;
                case 'vip':
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Nom</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=email&ordre=ASC'>Email</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_inscription&ordre=ASC'>Date d'inscription</a></th>";
                    if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?tri=vip&ordre=DESC'>VIP</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=vip&ordre=ASC'>VIP</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=temps&ordre=ASC'>Temps</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Mot de passe</a></th>";
                    echo "<th class='text-left' ><input type='submit' value='Coupons' class='boxRrecherche'/></th>";
                    break;
                case 'temps':
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Nom</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=email&ordre=ASC'>Email</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_inscription&ordre=ASC'>Date d'inscription</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=vip&ordre=ASC'>VIP</a></th>";
                    if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?tri=temps&ordre=DESC'>Temps</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=temps&ordre=ASC'>Temps</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Mot de passe</a></th>";
                    echo "<th class='text-left' ><input type='submit' value='Coupons' class='boxRrecherche'/></th>";
                    break;
                }
        }
            else {
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Nom</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=email&ordre=ASC'>Email</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_inscription&ordre=ASC'>Date d'inscription</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=vip&ordre=ASC'>VIP</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=temps&ordre=ASC'>Temps</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=nom&ordre=ASC'>Mot de passe</a></th>";
                    echo "<th class='text-left' ><input type='submit' value='Coupons' class='boxRrecherche'/></th>";
            }
            echo"</tr></thead>";
            echo'<tbody class="table-hover">';
            foreach ($_SESSION['Liste'] as $variable)
            {    
                echo"<tr class='hov'>";
                echo "<td class='text-left' >", $variable['nom'],"</td>";
                echo "<td class='text-left' >", $variable['email'],"</td>";
                echo "<td class='text-left' >", $variable['date_inscription'],"</td>";
                echo "<td class='text-left' >", $variable['vip'],"</td>";
                echo "<td class='text-left' >", $variable['temps'],"</td>";
                echo "<td class='text-left' style='min-width:10em;'><button onclick='renimdp()'>Réinitialiser</button></td>";
                echo "<td class='text-left' style='min-width:10em;'><input type='checkbox' name='email[]' value='", $variable['email'],"'></td>";
                echo"</tr>";
            }
            echo"</tbody>";
                     
?>
    </table></form></div>

<script>
function renimdp() {
  if (confirm("Vous désirez vraiment quitter?")) {
        <?php
    //appeler la fonction php pour envoyer un mail et modifier la bdd
        ?>
  }
  else {
    alert("non")
  }
}
</script>