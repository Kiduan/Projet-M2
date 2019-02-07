<!--
/* ------------------------------------------------------- */
/* Frogi-secure   Baron Corentin   2016                    */
/* Site : Frogi-secure distributeur                        */
/*                                                         */ 
/* Description du fichier : Vue de la page de recherche    */
/*                                                         */
/* @Ce fichier gère l'affichage de la page de recherche.   */
/* Cette page permet de faire une recherche précise dans la*/
/* la liste de l'utilisateur connecté                      */
/* ------------------------------------------------------- */-->

<div class="titrecentre">Recherche</div>
    <div class="fcentre">
         <form  method="post" action="index.php?uc=recherche&en=envoie" onsubmit="return verifForm(this)">
             <?php 
                //------------Nom--------------- 
                echo '<label for="nom" class="param_libelleR">Nom du client : </label>';
                if ($_SESSION['Rnom'] != "")//si la recherche a déjà été effectuée alors on l'affiche
                    echo'<div class="param_valeurR"><input type="text" name="nom" id="indexnom" onblur="verif(this)" value="', $_SESSION['Rnom'],'"/></div>';
                else echo '<div class="param_valeurR"><input type="text" name="nom" id="indexnom" onblur="verif(this)"/></div>';
                echo"<div class='clear'></div>";
                //------------Email------- 
                echo'<label for="email" class="param_libelleR">Email : </label>';
                if ( $_SESSION['Remail'] != "")//si la recherche a déjà été effectuée alors on l'affiche
                    echo'<div class="param_valeurR"><input type="text" name="email" id="indexemail" onblur="verif(this)" value="',  $_SESSION['Remail'],'"/></div>';
                else echo '<div class="param_valeurR"><input type="text" name="email" id="indexemail" onblur="verif(this)"/></div>';
                echo"<div class='clear'></div>";
                //------------Date d'inscription--------------- 
                echo"<label for='date' class='param_libelleR'>Date d'inscription : jj/mm/aaaa</label>";
                if ($_SESSION['Rdate'] != "")//si la recherche a déjà été effectuée alors on l'affiche
                    echo'<div class="param_valeurR"><input type="text" name="start_date" id="indexdate" onblur="verif(this)" value="', $_SESSION['Rdate'],'"/></div>';
                else echo '<div class="param_valeurR"><input type="text" name="start_date" id="indexdate" onblur="verif(this)"/></div>';
                echo"<div class='clear'></div>";
                //------------VIP---------------            
                $alle="";    $vrais="";  $faux="";
                switch($_SESSION['Rvip']) {//si la recherche a déjà été effectuée alors on l'affiche
                    case 'all':$alle="selected";break;
                    case 'true':$vrais="selected";break;
                    case 'false':$faux="selected";break;
                }
                echo' <label for="vip" class="param_libelleR">VIP : </label><select name="vip" id="indexvip" size="1" class="p">';
                echo'<option value=""',$alle,'>';
                echo'<option value="true"',$vrais,'>True';
                echo'<option value="false"',$faux,'>False';
                echo'</select>';
                echo"<div class='clear'></div>";; 
                //------------Temps--------------- 
                echo"<label for='temps' class='param_libelleR'>Temps restant : </label>";
                echo"<div class='clear'></div>";
                echo"<div class='param_libelleR'><input type='radio' name='itemps' value='>='> >= <input type='radio' name='itemps' value='<='> <= <input type='radio' name='itemps' value='='> = </div>";
                if ($_SESSION['Rtemps'] != "")//si la recherche a déjà été effectuée alors on l'affiche
                    echo'<div class="param_valeurR"><input type="text" name="temps" id="indextemps" onblur="verif(this)" value="', $_SESSION['Rtemps'],'"/></div>';
                else echo '<div class="param_valeurR"><input type="text" name="temps" id="indextemps" onblur="verif(this)"/></div>';
                echo"<div class='clear'></div>";
                //---------------------------------------
        
?>
<input type="submit" value="Recherche" class="boxRrecherche"/>
    <input type="button" onclick="effacer()" value="Effacer" class="boxRrecherche">
             <div class='clear'></div>
         </form>
</div>
    <table class="table-fill" style="margin-top:2em;">
<?php
        if($_SESSION['Liste']!=array(0))    {
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
            $_SESSION['Liste']=array(0);
        }
?>
            </table>
    
