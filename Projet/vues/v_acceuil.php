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
<div class="acceuil">    <table class="table-fill">
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
                case 'client': 
                    if ($ordre == "ASC")
                        echo "<th class='text-left' ><a href='index.php?tri=client&ordre=DESC'>Client</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=client&ordre=ASC'>Client</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=serial&ordre=ASC'>Serial</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=etat&ordre=ASC'>Etat</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=statut&ordre=ASC'>Statut</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                    break;
                case 'serial':
                    echo "<th class='text-left' ><a href='index.php?tri=client&ordre=ASC'>Client</a></th>";
                    if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?tri=serial&ordre=DESC'>Serial</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=serial&ordre=ASC'>Serial</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=etat&ordre=ASC'>Etat</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=statut&ordre=ASC'>Statut</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                    break;
                case 'admin_etablissement':
                    echo "<th class='text-left' ><a href='index.php?tri=client&ordre=ASC'>Client</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=serial&ordre=ASC'>Serial</a></th>";
                    if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?tri=admin_etablissement&ordre=DESC'>Etablissement</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=etat&ordre=ASC'>Etat</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=statut&ordre=ASC'>Statut</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                    break;
                case 'etat':
                    echo "<th class='text-left' ><a href='index.php?tri=client&ordre=ASC'>Client</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=serial&ordre=ASC'>Serial</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                    if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?tri=etat&ordre=DESC'>Etat</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=etat&ordre=ASC'>Etat</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=statut&ordre=ASC'>Statut</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                    break;
                case 'statut':
                    echo "<th class='text-left' ><a href='index.php?tri=client&ordre=ASC'>Client</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=serial&ordre=ASC'>Serial</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=etat&ordre=ASC'>Etat</a></th>";
                    if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?tri=statut&ordre=DESC'>Statut</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=statut&ordre=ASC'>Statut</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                    break;
                case 'date_fin_garantie_reelle':
                    echo "<th class='text-left' ><a href='index.php?tri=client&ordre=ASC'>Client</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=serial&ordre=ASC'>Serial</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=etat&ordre=ASC'>Etat</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=statut&ordre=ASC'>Statut</a></th>";
                    if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?tri=date_fin_garantie_reelle&ordre=DESC'>Date de fin de garantie</a></th>";
                    else echo "<th class='text-left' ><a href='index.php?tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                }
        }
            else {
                    echo "<th class='text-left' ><a href='index.php?tri=client&ordre=DESC'>Client</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=serial&ordre=ASC'>Serial</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=etat&ordre=ASC'>Etat</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=statut&ordre=ASC'>Statut</a></th>";
                    echo "<th class='text-left' ><a href='index.php?tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
            }
            echo"</tr></thead>";
            echo'<tbody class="table-hover">';
            foreach ($_SESSION['Liste'] as $variable)
            {    
                echo"<tr class='hov'>";
                echo "<td class='text-left' >", $variable['client'],"</td>";
                echo "<td class='text-left' style='min-width:10em;'><a href='index.php?uc=info&serial=", $variable['serial'],"'>", $variable['serial'], "</a></td>";
                echo "<td class='text-left' >", $variable['admin_etablissement'],"</td>";
                echo "<td class='text-left' >", $variable['etat'],"</td>";
                echo "<td class='text-left' >", $variable['statut'],"</td>";
                echo "<td class='text-left' >", $variable['date_fin_garantie_reelle'],"</td>";
                echo"</tr>";
            }
            echo"</tbody>";
                     
?>
    </table></div>