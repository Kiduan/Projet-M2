<?php
/* ------------------------------------------------------- */
/* Frogi-secure   Baron Corentin   2016                    */
/* Site : Frogi-secure distributeur                        */
/*                                                         */ 
/* Description du fichier : Vue de la page d'information   */
/*                                                         */
/* @Ce fichier gère l'affichage de la page d'information   */
/* d'un client. Affichage simple qui s'adapte selon les    */
/* paramètres du client.                                   */
/* ------------------------------------------------------- */

    $serial=lireDonneeUrl('serial');
        if ($serial != "")  {//si on a un numéro de série
            $liste=$pdoExetud->recupInfo($_SESSION['Id'], $serial);
            $num=$pdoExetud->recupNum($_SESSION['Id'], $serial);
            $info_client = $pdoExetud->recupInfoClient($num);
            if ($info_client=="")   {//si le numéro de serie est bidon
                    //echo '<script type="text/javascript">';
                //echo"alert('Numéro de Serie inconnu, Vous allez être redirigé');document.location.href = 'index.php';</script>";
               // exit();
            }
            $keyliste = array_keys($liste);
            $keyinfo = array_keys($info_client);
        }else { //echo '<script type="text/javascript">';//sinon renvoie vers la page d'acceuil avec une alert
                //echo"alert('Numéro de Serie inconnu, Vous allez être redirigé');document.location.href = 'index.php';</script>";
                //exit();
            }
    ?>
    <div class="box">
        <div id="idInfoG" class="left" name="infoG">
            <div class="titre">Information global</div>
                <?php
                echo"<div class='param_libelleI'>Nom du client : </div><div class='param_valeurI'>",$liste[$keyliste[2]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Ref_cmd_client : </div><div class='param_valeurI'>",$liste[$keyliste[13]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Etablissement : </div><div class='param_valeurI'>",$liste[$keyliste[3]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Adresse : </div><div class='param_valeurI'>",$liste[$keyliste[4]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Code postale : </div><div class='param_valeurI'>",$liste[$keyliste[5]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Ville : </div><div class='param_valeurI'>",$liste[$keyliste[6]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Pays : </div><div class='param_valeurI'>",$liste[$keyliste[7]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Serial : </div><div class='param_valeurI'>",$liste[$keyliste[1]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Email : </div><div class='param_valeurI'>",$liste[$keyliste[8]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Date de fin de garantie : </div><div class='param_valeurI'>",$liste[$keyliste[36]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Etat : </div><div class='param_valeurI'>",$liste[$keyliste[39]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Statut : </div><div class='param_valeurI'>",$liste[$keyliste[51]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Hostname : </div><div class='param_valeurI'>",$info_client[$keyinfo[6]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Ip : </div><div class='param_valeurI'>",$info_client[$keyinfo[37]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Facture : </div><div class='param_valeurI'>",$liste[$keyliste[14]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Auth : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[1]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Av : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[2]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Check_internet : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[3]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Option changement de mdp : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[15]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Pflogd : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[16]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Portail_auth : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[18]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Qos : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[20]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Rapport_email : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[21]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>R_dns : </div><div class='param_valeurI'>",$info_client[$keyinfo[22]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Tracabilite : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[35]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Ttl_r2 : </div><div class='param_valeurI'>",$info_client[$keyinfo[36]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>interface_WAN/LAN : </div><div class='param_valeurI'>",$info_client[$keyinfo[41]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Squidguard db : </div><div class='param_valeurI'>",$liste[$keyliste[42]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Etat squidguard : </div><div class='param_valeurI'>",$liste[$keyliste[50]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Mac address bypass : </div><div class='param_valeurI'>",$info_client[$keyinfo[13]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Version : </div><div class='param_valeurI'>",$liste[$keyliste[26]],"</div><div class='clear'></div>";
                $patch = explode("\n", $info_client[$keyinfo[12]]);
                echo"<table class='tab_info'><thead>";
                    echo"<tr class='tr_info'>";
                    echo"<th class='th_info'>Patchs applied</th>";
                echo"</thead>";
                echo"<tbody class='tbody_info'>";
                foreach($patch as  $variable){ 
                    if ($variable!=""){//si la variable existe on rajoute une case dans le tableau
                        echo"<tr class='tr_info'>";
                        echo"<td class='td_info'>", $variable,"</td>";echo"</tr>";
                    }
                }echo"</tbody></table>";
                ?>
            </div>
        
        <div id="idParamSvgFtp" class="right" name="paramSvgFtp">
            <div class="titre">Paramètre FTP</div>
        <?php
                echo"<div class='param_libelleI'>Format : </div><div class='param_valeurI'>",$info_client[$keyinfo[24]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Hostname : </div><div class='param_valeurI'>",$info_client[$keyinfo[25]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Status : </div><div class='param_valeurI'>",couleur($info_client[$keyinfo[27]]),"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Username : </div><div class='param_valeurI'>",$info_client[$keyinfo[28]],"</div><div class='clear'></div>";
                ?>
            
                </div>
        <div id="idSync" class="right" name="sync">
            <div class="titre">Paramètre Sync</div>
            <?php
                echo"<div class='param_libelleI'>Sync : </div><div class='param_valeurI'>",$info_client[$keyinfo[31]],"</div><div class='clear'></div>";
                echo"<div class='param_libelleI'>Date de dernière synchronisation : </div><div class='param_valeurI'>",date("d-m-Y",$info_client[$keyinfo[34]]),"</div><div class='clear'></div>";
                $param = explode("\n", $info_client[$keyinfo[32]]);
                $tableau_etiquette = fic_to_tableau ("messages/fr".'/'."fr"); // mise en tableau du fichier des etiquettes
                echo"<table class='tab_info' style='margin-bottom:1.5em;'><thead><tr class='tr_info'>";
                echo"<th class='th_info'>Paramètre transmis</th>";
                echo"<th class='th_info'style='margin: auto;'>Active</th>";
                echo"</tr>";
                echo"</thead><tbody class='tbody_info'>";
                foreach($param as  $variable)  {
                    $paramex = explode(":", $variable);
                    echo"<tr class='tr_info'>";
                    echo"<td class='td_info'>",lire_libelle("prod",$tableau_etiquette[0],$paramex[1]),"</td>";
                    echo"<td class='td_info' style='margin: auto;'>",couleur($paramex[3]),"</td>";
                    echo"</tr>";
                }echo"</tbody></table>";
            
                $serial = explode("\n", $info_client[$keyinfo[33]]);
                echo"<table class='tab_info'><thead>";
                echo"<tr class='tr_info'>";
                echo"<th class='th_info'>Serial</th>";
                echo"<th class='th_info'>Nom du boîtier</th>";
                echo"<th class='th_info'>Active</th>";
                echo"</tr>";
                echo"</thead><tbody class='tbody_info'>";
                foreach($serial as  $variable) { 
                    $serial_ex=explode(":", $variable);
                    echo"<tr class='tr_info'>";
                    echo"<td class='td_info'>",$serial_ex[0],"</td>";
                    echo"<td class='td_info'>",$serial_ex[1],"</td>";
                    echo"<td class='td_info' style='margin: auto;'>",couleur($serial_ex[2]),"</td>";
                    echo"</tr>";
                }echo"</tbody></table>";
                ?>
            
                </div>
        <div class="clear"></div>
    </div>

    <div class="box">
        <div id="idListeB" class="liste" name="listeB">
            <div class="titre">Liste blanche</div>
            <?php
                $listeB = explode(";", $info_client[$keyinfo[38]]);
                echo '<div style="overflow:auto; height:15em;">';
                echo"<table class='tab_info'>";
                echo"<tbody class='tbody_info'>";
                foreach($listeB as  $variable){ 
                    if ($variable!=""){
                        echo"<tr class='tr_info'>";
                        echo"<td class='td_info'>", $variable,"</td>";echo"</tr>";
                    }
                }echo"</tbody></table>";
                echo"</div>";
                ?>
            
        </div>
        <div id="idListeN" class="liste" name="listeN">
            <div class="titre">Liste noire</div>
            <?php
                $listeN = explode(";", $info_client[$keyinfo[39]]);
                echo '<div style="overflow:auto; height:15em;">';
                echo"<table class='tab_info'>";
                echo"<tbody class='tbody_info'>";
                foreach($listeN as  $variable)  {
                    if ($variable!=""){
                        echo"<tr class='tr_info'>";
                        echo"<td class='td_info'>", $variable,"</td>";echo"</tr>";
                    }
                }echo"</tbody></table>";echo"</div>";
                ?>
            
        </div>
        <div id="idSiteEexclu" class="liste" name="SiteExclu">
            <div class="titre">Site exclu</div>
            <?php
                $listeS = explode(";", $info_client[$keyinfo[30]]);
                echo '<div style="overflow:auto; height:15em;">';
                echo"<table class='tab_info'>";
                echo"<tbody class='tbody_info'>";
                foreach($listeS as  $variable){ 
                    if ($variable!=""){
                        echo"<tr class='tr_info'>";
                        echo"<td class='td_info'>", $variable,"</td>";echo"</tr>";
                    }
                }echo"</tbody></table>";
                echo"</div>";
                ?>
            
        </div>
        <div class="clear"></div>
    </div>
    <div class="box">
        <div id="idListeExclu" class="exclu" name="ListeExclu">
            <div class="titre">Liste d'exlusion</div>
            <?php
                echo '<div style="overflow:auto; height:15em;">';
                echo"<table class='tab_info'>";
                echo"<tbody class='tbody_info'>";
               $listeE = explode(";", $info_client[$keyinfo[11]]);
                foreach($listeE as  $variable){ 
                    if ($variable!=""){
                        echo"<tr class='tr_info'>";
                        echo"<td class='td_info'>", $variable,"</td>";echo"</tr>";
                    }
                }echo"</tbody></table>";echo"</div>";
                ?>
            
                </div>
        <div id="idIpExclu" class="exclu" name="ipExclu">
            <div class="titre">Ip exclu du filtrage</div>
            <?php
                $listeI = explode(";", $info_client[$keyinfo[7]]);
                echo '<div style="overflow:auto; height:15em;">';
                echo"<table class='tab_info'>";
                echo"<tbody class='tbody_info'>";
                foreach($listeI as  $variable){ 
                    if ($variable!=""){
                        echo"<tr class='tr_info'>";
                        echo"<td class='td_info'>", $variable,"</td>";echo"</tr>";
                    }
                }echo"</tbody></table>";echo"</div>";
                ?>
            
                </div>
            <div class="clear"></div>
    </div>
    <div class="box">
    <div  id="idNetwork" class="liste" name="network" style="width: 25%;">
        <div class="titre">Network</div>
        <?php
                echo '<div style="overflow:auto; height:20em;">';
                $network = explode("\n", $info_client[$keyinfo[14]]);
                network($network, $info_client[$keyinfo[8]]);//on appel la fonction qui gère l'affiche du contenu de la box
                echo"</div>";
                ?>
        </div>
    <div id="idListeExpression" class="liste" name="ListeExpression" style="width: 25%;">
        <div class="titre">Liste d'expression</div>
        <?php
                $listeExpression = explode(";", $info_client[$keyinfo[40]]);
                echo '<div style="overflow:auto; height:20em;">';
                echo"<table class='tab_info'>";
                echo"<tbody class='tbody_info'>";
                foreach($listeExpression as  $variable) { 
                    if ($variable!=""){
                        echo"<tr class='tr_info'>";
                        echo"<td class='td_info'>", $variable,"</td>";echo"</tr>";
                    }
                }echo"</tbody></table>";echo"</div>";
                ?>
    
        </div>
    
    <div  id="idRapport" class="liste" name="rapport" style="width: 40%;">
        <div class="titre">Contenu du rapport</div>
        <?php
                echo '<div style="overflow:auto; height:20em;">';
                $contenu = explode("/", $info_client[$keyinfo[4]]);
                $freq=explode("/", $info_client[$keyinfo[5]]);
                echo"<table class='tab_info' style='margin-bottom:1.5em;'><thead><tr class='tr_info'>";
                    echo"<th class='th_info'></th>";
                    echo"<th class='th_info'> Journalier</th>";
                    echo"<th class='th_info'> Hebdomadaire</th>";
                    echo"<th class='th_info'> Mensuel</th>";
                echo"</tr></thead>";
                echo"<tbody class='tbody_info'><tr class='tr_info'>";
                    echo"<td class='td_info'>Fréquence du rapport</td>";
                    echo"<td class='td_info'>",couleur($freq[0]) ,"</td>";
                    echo"<td class='td_info'>",couleur($freq[1]) ,"</td>";
                    echo"<td class='td_info'>",couleur($freq[2]) ,"</td>";
                echo"</tr></tbody></table>";
                echo"<table class='tab_info'><thead>";
                    echo"<tr class='tr_info'>";
                    echo"<th class='th_info'>Information du rapport</th>";echo"</tr>";
                echo"</thead>";
                echo"<tbody class='tbody_info'>";
                foreach($contenu as  $variable){ 
                    if ($variable!=""){
                        echo"<tr class='tr_info'>";
                        echo"<td class='td_info'>", $variable,"</td>";echo"</tr>";
                    }
                }echo"</tbody></table>";echo"</div>";
                ?>
        </div>
        <div class="clear"></div>
    </div>

    <div class="box">
    <div id="idhoraires" class="alone" name="horaire">
        <div class="titre">Plage horaires</div>
        <?php 
                echo '<div style="overflow:auto; height:15em;">';
                $compteur=0;
                echo"<table class='tab_info'><thead>";echo"<tr class='tr_info'>";
                echo"<th class='th_info'>Jours</th>";
                for ($compteur=0;$compteur<24;$compteur++)
                    echo"<th class='th_info' COLSPAN=2>",$compteur," h</th>";
                $compteur=0;
                echo"</tr>";echo"</thead>";echo"<tbody class='tbody_info'>";
                $horaire = explode("\n", $info_client[$keyinfo[17]]);
                foreach($horaire as $variable){
                     echo"<tr class='tr_info'>";
                     switch($compteur) {
                         case '0':echo"<td class='td_info' style='border-right: 1px solid #676767;'>Lundi</td>";$compteur++;break;
                         case '1':echo"<td class='td_info' style='border-right: 1px solid #676767;'>Mardi</td>";$compteur++;break;
                         case '2':echo"<td class='td_info' style='border-right: 1px solid #676767;'>Mercredi</td>";$compteur++;break;
                         case '3':echo"<td class='td_info' style='border-right: 1px solid #676767;'>Jeudi</td>";$compteur++;break;
                         case '4':echo"<td class='td_info' style='border-right: 1px solid #676767;'>Vendredi</td>";$compteur++;break;
                         case '5':echo"<td class='td_info' style='border-right: 1px solid #676767;'>Samedi</td>";$compteur++;break;
                         case '6':echo"<td class='td_info' style='border-right: 1px solid #676767;'>Dimanche</td>";$compteur++;break;
                     }
                    $bor=0;
                     $plage=explode("/", $variable);
                     foreach($plage as $heure){
                         if($heure!="") {
                             if($bor==0){   echo"<td>", couleur($heure),"</td>";$bor=1;  }
                             else {    echo"<td  style='border-right: 1px solid #676767;'>", couleur($heure),"</td>";$bor=0; }
                         }
                     }
                    echo"</tr>";
                }
                echo"</tbody></table>";
                echo"</div>";
                ?>
    
        </div><div class="clear"></div>
    </div>

    <div class="box">
    <div id="idSection_r2" class="alone" name="section_r2">
        <div class="titre">liste des profils</div>
        <?php
                echo'<div class="systeme_onglets"><div class="onglets">';
                $listeSection = explode(";",$info_client[$keyinfo[29]]);
                $i=0;
                $compteur=count($listeSection);//nombre de profil
                foreach($listeSection as $transfer) {
                    $transfer=preg_replace("(\r)","", $transfer);
                    $profilex = explode("|", $transfer);//nom des profils
                     echo'<span class="onglet_0 onglet" id="onglet_',$i,'" onclick="javascript:change_onglet(',$i,');">',$profilex[0],'</span>';
                    $Section_r2[$i] = explode("\n", $profilex[1]);//pour chaque profil on explode chaque information que l'on stocke dans 
                    //un tableau à 2 dimension [profil][information]
                    $i++;
                }
                echo"</div>";
                echo'<div class="contenu_onglets">';
                $i=0;
                foreach($Section_r2 as $coupe)  {
                        echo '<div class="contenu_onglet" id="contenu_onglet_',$i,'">';
                            echo"<table class='tab_info' style='margin-bottom:1.5em;'><thead><tr class='tr_info'>";
                            echo"<th class='th_info'style='margin: auto;'>Action</th>";        
                            echo"<th class='th_info'>Filtrage</th>";
                            echo"<th class='th_info'>Ouvré</th>";
                            echo"<th class='th_info'>Non-ouvré</th>";
                            echo"<th class='th_info'>Fermé</th>";
                        echo"</tr>";
                    echo"</thead><tbody class='tbody_info'>";
                    $tableau_etiquette = fic_to_tableau ("messages/fr".'/'."fr"); // mise en tableau du fichier des etiquettes
                    foreach($coupe as  $remp)  {
                        $variable=explode("/", $remp);
                        echo"<tr class='tr_info'>";
                        echo"<td class='td_info'>",couleur($variable[2]),"</td>";
                        echo"<td class='td_info'>",lire_libelle("prod",$tableau_etiquette[0],$variable[0]),"</td>";
                        echo"<td class='td_info' style='margin: auto;'>",couleur($variable[4]),"</td>";
                        echo"<td class='td_info' style='margin: auto;'>",couleur($variable[5]),"</td>";
                        echo"<td class='td_info' style='margin: auto;'>",couleur($variable[6]),"</td>";
                        echo"</tr>";
                    }echo"</tbody></table>";
                    echo"</div></div>";
                    $i++;
                }
    ?>
    <script type="text/javascript">
            //<!--
                    var anc_onglet = '0';
                    change_onglet(anc_onglet);
            //-->
    </script>
    </div><div class="clear"></div>
</div>
