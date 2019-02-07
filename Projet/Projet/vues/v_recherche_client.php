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
<?php //--------------------------------------------------
if (!empty($_POST['email'])) {
    $array = $_POST['email'];
 
    foreach ($array as $selectedval) {
        echo 'checkbox de email = '.$selectedval.'</br>';
    }
}//--------------------------------------------------
?>
    <div class="fcentre">
         <form  method="post" action="index.php?uc=recherche&en=envoie" onsubmit="return verifForm(this)">
             <?php 
                //------------Nom--------------- 
                echo '<label for="nom" class="param_libelleR">Nom du client : </label>';
                if ($_SESSION['Rnom'] != "")//si la recherche a déjà été effectuée alors on l'affiche
                    echo'<div class="param_valeurR"><input type="text" name="nom" id="indexnom" onblur="verif(this)" value="', $_SESSION['Rnom'],'"/></div>';
                else echo '<div class="param_valeurR"><input type="text" name="nom" id="indexnom" onblur="verif(this)"/></div>';
                echo"<div class='clear'></div>";
                //------------Etablissement------- 
                echo'<label for="etab" class="param_libelleR">Etablissement : </label>';
                if ( $_SESSION['Retab'] != "")//si la recherche a déjà été effectuée alors on l'affiche
                    echo'<div class="param_valeurR"><input type="text" name="etab" id="indexetab" onblur="verif(this)" value="',  $_SESSION['Retab'],'"/></div>';
                else echo '<div class="param_valeurR"><input type="text" name="etab" id="indexetab" onblur="verif(this)"/></div>';
                echo"<div class='clear'></div>";
                //------------Serial--------------- 
                echo'<label for="serial" class="param_libelleR">Serial : </label>';
                if ($_SESSION['Rserial'] != "")//si la recherche a déjà été effectuée alors on l'affiche
                    echo'<div class="param_valeurR"><input type="text" name="serial" id="indexserial" onblur="verif(this)" value="', $_SESSION['Rserial'],'"/></div>';
                else echo '<div class="param_valeurR"><input type="text" name="serial" id="indexserial" onblur="verif(this)"/></div>';
                echo"<div class='clear'></div>";
                //----Date de fin de garantie----
                 $_SESSION['start_date'] = 	'';//valeur initiale
                 $messageC = '<div class="param_libelleR"><label class="label_search_box">Date de fin de garantie : </label></div><div class="param_valeurR"><input id="datepicker_debut" name="start_date" onblur="verif(this)" value="';
                 if ($_SESSION['RdateS']!="")//si la recherche a déjà été effectuée alors on l'affiche
                    $messageC .=date("d-m-Y", strtotime($_SESSION['RdateS'])-3600*24*15); 
                 $messageC .='"></div>';
                 echo $messageC;
                echo"<div class='clear'></div>";
                //------------Etat---------------            
                $alle="";    $livraison="";  $migration="";  $online=""; $offline="";  $pret="";   $retour=""; $retard=""; $no_com="";
                switch($_SESSION['Retat']) {//si la recherche a déjà été effectuée alors on l'affiche
                    case 'all':$alle="selected";break;
                    case 'livraison':$livraison="selected";break;
                    case 'migration':$migration="selected";break;
                    case 'online':$online="selected";break;
                    case 'offline':$offline="selected";break;
                    case 'stock':$stock="selected";break;
                    case 'pret':$pret="selected";break;
                    case 'retour':$retour="selected";break;
                    case 'retard':$retard="selected";break;
                    case 'NO_COM':$no_com="selected";break;
                }
                echo' <label for="etat" class="param_libelleR">Etat : </label><select name="etat" id="indexetat" size="1" class="p">';
                echo'<option value="all"',$alle,'>All';
                echo'<option value="livraison"',$livraison,'>Livraison';
                echo'<option value="migration"',$migration,'>Migration';
                echo'<option value="online"',$online,'>Online';
                echo'<option value="offline"',$offline,'>Offline';
                echo'<option value="pret"',$pret,'>Prêt';
                echo'<option value="retour"',$retour,'>Retour';
                echo'<option value="retard"',$retard,'>Retard';
                echo'<option value="NO_COM"',$no_com,'>NO_COM';
                echo'</select>';
                echo"<div class='clear'></div>";; 
                //------------Modèle---------------        
                $allm="";    $r20="";  $r50="";  $r100=""; $r250="";
                switch($_SESSION['Rmodel']) {//si la recherche a déjà été effectuée alors on l'affiche
                    case 'all':$all="selected";break;
                    case 'R20':$r20="selected";break;
                    case 'R50':$r50="selected";break;
                    case 'R100':$r100="selected";break;
                    case 'R250':$r250="selected";break;
                }
                echo'<label for="model" class="param_libelleR">Modèle : </label><select name="model" id="indexmodel" size="1" class="p">';
                echo'<option value="all"',$allm,'>All';
                echo'<option value="R20"',$r20,'>Frogi 20';
                echo'<option value="R50"',$r50,'>Frogi 50';
                echo'<option value="R100"',$r100,'>Frogi 100 ';
                echo'<option value="R250"',$r250,'>Frogi 250';
                echo'</select>';
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
            if ($ordre != "")   {
                //On n'affiche pas les même boutons d'entète de tableau si on tri ASC ou DESC
                switch($_SESSION['Tri'])    {
                    case 'client': 
                        if ($ordre == "ASC")
                            echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=client&ordre=DESC'>Client</a></th>";
                        else echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=client&ordre=ASC'>Client</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=serial&ordre=ASC'>Serial</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=etat&ordre=ASC'>Etat</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=statut&ordre=ASC'>Statut</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                        break;
                    case 'serial':
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=client&ordre=ASC'>Client</a></th>";
                        if ($ordre == "ASC")
                                echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=serial&ordre=DESC'>Serial</a></th>";
                        else echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=serial&ordre=ASC'>Serial</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=etat&ordre=ASC'>Etat</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=statut&ordre=ASC'>Statut</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                        break;
                    case 'admin_etablissement':
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=client&ordre=ASC'>Client</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=serial&ordre=ASC'>Serial</a></th>";
                        if ($ordre == "ASC")
                                echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=admin_etablissement&ordre=DESC'>Etablissement</a></th>";
                        else echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=etat&ordre=ASC'>Etat</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=statut&ordre=ASC'>Statut</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                        break;
                    case 'etat':
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=client&ordre=ASC'>Client</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=serial&ordre=ASC'>Serial</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                        if ($ordre == "ASC")
                                echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=etat&ordre=DESC'>Etat</a></th>";
                        else echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=etat&ordre=ASC'>Etat</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=statut&ordre=ASC'>Statut</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                        break;
                    case 'statut':
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=client&ordre=ASC'>Client</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=serial&ordre=ASC'>Serial</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=etat&ordre=ASC'>Etat</a></th>";
                        if ($ordre == "ASC")
                                echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=statut&ordre=DESC'>Statut</a></th>";
                        else echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=statut&ordre=ASC'>Statut</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                        break;
                    case 'date_fin_garantie_reelle':
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=client&ordre=ASC'>Client</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=serial&ordre=ASC'>Serial</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=etat&ordre=ASC'>Etat</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=statut&ordre=ASC'>Statut</a></th>";
                        if ($ordre == "ASC")
                                echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=date_fin_garantie_reelle&ordre=DESC'>Date de fin de garantie</a></th>";
                        else echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                        break;
                    }
            }
                else {//cas par défaut
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=client&ordre=DESC'>Client</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=serial&ordre=ASC'>Serial</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=admin_etablissement&ordre=ASC'>Etablissement</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=etat&ordre=ASC'>Etat</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=statut&ordre=ASC'>Statut</a></th>";
                        echo "<th class='text-left' ><a href='index.php?uc=recherche&tri=date_fin_garantie_reelle&ordre=ASC'>Date de fin de garantie</a></th>";
                }
                echo"</tr></thead>";
                echo'<tbody class="table-hover">';
                foreach ($_SESSION['Liste'] as $variable)
                {    
                    echo"<tr class='hov'>";
                    echo "<td class='text-left' >", $variable['client'],"</td>";
                    echo "<td class='text-left'  style='min-width:10em;'><a href='index.php?uc=info&serial=", $variable['serial'],"'>", $variable['serial'], "</a></td>";
                    echo "<td class='text-left' >", $variable['admin_etablissement'],"</td>";
                    echo "<td class='text-left' >", $variable['etat'],"</td>";
                    echo "<td class='text-left' >", $variable['statut'],"</td>";
                    echo "<td class='text-left' >", $variable['date_fin_garantie'],"</td>";
                    echo"</tr>";
            }
            echo"</tbody>";
        }
?>
            </table>
    
