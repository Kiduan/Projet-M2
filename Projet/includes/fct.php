<?php
    /* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : Frogi-secure distributeur                        */
    /*                                                         */ 
    /* Description du fichier : Fichier de fonction php        */
    /*                                                         */
    /* @Ce fichier contient toute les fonction php utilisé par */
    /* les pages du site.                                      */
    /* ------------------------------------------------------- */

/** 
 * Fournit la valeur d'une donnée transmise par la méthode get (url).                    
 * 
 * Retourne la valeur de la donnée portant le nom $nomDonnee reçue dans l'url, 
 * $valDefaut si aucune donnée de nom $nomDonnee dans l'url 
 * @param string nom de la donnée
 * @param string valeur par défaut 
 * @return string valeur de la donnée
 */     
function lireDonneeUrl($nomDonnee, $valDefaut="") {
    if (isset($_GET[$nomDonnee])) {
        $val = $_GET[$nomDonnee];
    }
    else {
        $val = $valDefaut;
    }
    return $val;
}

/** 
 * Indique sur quel onglet du menu on se trouve                    
 * 
 * Retourne active si le li que le regarde correspond à la position actuel de l'utilisateur 
 * @param string position la position que l'on test
 * @return string active si la position actuel correspond à celle que l'on test "" sinon
 */
function activeMenu($position) {
    $uc = lireDonneeUrl('uc');//position de l'utilisateur
    if ($uc == "" && $position == "acceuil")
        return "active";
    else if ($uc == $position) {
        return "active";
    }else return "";
}

/** 
 * Fournit la valeur d'une donnée transmise par la méthode post 
 *  (corps de la requête HTTP).                    
 * 
 * Retourne la valeur de la donnée portant le nom $nomDonnee reçue dans le corps de la requête http, 
 * $valDefaut si aucune donnée de nom $nomDonnee dans le corps de requête
 * @param string nom de la donnée
 * @param string valeur par défaut 
 * @return string valeur de la donnée
 */ 
function lireDonneePost($nomDonnee, $valDefaut="") {
    if ( isset($_POST[$nomDonnee]) ) {
        $val = $_POST[$nomDonnee];
    }
    else {
        $val = $valDefaut;
    }
    return $val;
}

/** 
 * Vérifie si les données saisies par l'utilisateur admin correspondent à un compte connu
 *
 * Retourne 0 si oui 1 sinon 
 * @param PdoBDD l'instance de PDO qui est sollicitée par toutes les méthodes de la classe PdoBDD
 * @param string nom donné par l'utilisateur
 * @param string mdp valeur du mot de passe rentré par l'utilisateur 
 * @return 1 si le compte n'ai pas connu 0 sinon
 */ 
function verifUser($pdoExetud, $user, $mdp) {
    $tabNom = $pdoExetud->recupBdd("nom", "admin");
    $tabMdp = $pdoExetud->recupBdd("mdp", "admin");
    $i=0;
    foreach($tabNom as $verifNom)   {
        if ($verifNom[0]==$user)    {
                if (checkPassword($pdoExetud,$mdp,$tabMdp[$i]['mdp']))
                    return 0;//True
                else return 1;//False
        }
        $i++;
    }
    return 1;//False
}

/** 
 * Vérifie si les données saisies par l'utilisateur client correspondent à un compte connu
 *
 * Retourne 0 si oui 1 sinon 
 * @param PdoBDD l'instance de PDO qui est sollicitée par toutes les méthodes de la classe PdoBDD
 * @param string nom donné par l'utilisateur
 * @param string mdp valeur du mot de passe rentré par l'utilisateur 
 * @return 1 si le compte n'ai pas connu 0 sinon
 */ 
function verifUser_client($pdoExetud, $user, $mdp) {
    $tabNom = $pdoExetud->recupBdd("email", "client");
    $tabMdp = $pdoExetud->recupBdd("mdp", "client");
    $i=0;
    foreach($tabNom as $verifNom)   {
        if ($verifNom[0]==$user)    {
                if (checkPassword($pdoExetud,$mdp,$tabMdp[$i]['mdp']))
                    return 0;//True
                else return 1;//False
        }
        $i++;
    }
    return 1;//False
}

/** 
 * check si le password fourni correspond bien à celui que l'on a dans la bdd
 *
 * Retourne true si ok false sinon
 * @param PdoBDD l'instance de PDO qui est sollicitée par toutes les méthodes de la classe PdoBDD
 * @param string nv_mdp valeur du mot de passe rentré par l'utilisateur 
 * @param string interne valeur du mot de passe que l'on compare avec celui rentré par l'utilisateur
 * @return true s'ils correspondent false sinon
 */ 
function checkPassword($pdoExetud,$nv_mdp,$interne){
    if (empty($nv_mdp)) return FALSE;     //pas de mot de passe vide
    $crypt = crypt($nv_mdp, $interne); //on crypt le new PASS avec l'ancien comme valeur aleatoire
    return ($interne == $crypt); //on verifie la correspondance
}

/** 
 * Vérifie si le mail rentrer par l'utilisateur correspond à un mail dans notre bdd
 *
 * Retourne 0 si oui 1 sinon
 * @param PdoBDD l'instance de PDO qui est sollicitée par toutes les méthodes de la classe PdoBDD
 * @param string email valeur saisie par l'utilisateur 
 * @return 0 s'ils correspondent 1 sinon
 */ 
function verifMail($pdoExetud, $email) {
    $tabemail = $pdoExetud->recupBdd("Email", "client");
    foreach($tabemail as $verif)   {
        if ($verif[0]==$email)    
            return 0;//true
    }
    return 1;//False
}

/** 
 * Créer un nouveau mot de passe random
 *
 * Retourne la valeur du mot de passe crée
 * @param car la taille maximal du mot de passe crée
 * @return string valeur du mot de passe crée
 */ 
function random($car) {
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
    srand((double)microtime()*1000000);
    for($i=0; $i<$car; $i++)
        $string .= $chaine[rand()%strlen($chaine)];
    return $string;
}

/** 
 * envoie le nouveau mot de passe par mail à l'email indiqué
 *
 * @param string to email indiqué
 * @param string subject titre du mail à envoyer  
 * @param string message contenu du mail
 */ 
function envoi_email($to,$subject,$message) {
     $cmd = 'echo "'.$message.'" | sudo /usr/bin/mailx -s "'.$subject.'" '.$to.' ';
     // echo $cmd;
     exec($cmd);
}

/** 
 * Réinitialise toutes les variables session.
 *
 * Les variables de session réinitialisé sont les variable utiliser pour la recherche de client
 */ 
function rechercheNul(){
      $_SESSION['Rnom']="";
      $_SESSION['Retab']="";
      $_SESSION['Rserial']="";
      $_SESSION['Retat']="all";
      $_SESSION['Rmodel']="all";
      $_SESSION['RdateI']="";
      $_SESSION['RdateS']="";
}

/** 
 * check dans quel état est la valeur que l'on test et créer un carré d'une couleur qui dépend de sont état
 *
 * @param valeur variable que l'on regarde
 * @case vert->oui rouge->non orange->non active
 * @default affiche la variable
 */ 
function couleur($valeur) {
    switch($valeur) {
            case 'yes':echo"<div class='vert'></div>";break;
            case 'o':echo"<div class='vert'></div>";break;
            case '1':echo"<div class='vert'></div>";break;
            case '+':echo"<div class='vert'></div>";break;
            case 'no':echo"<div class='rouge'></div>";break;
            case 'n':echo"<div class='rouge'></div>";break;
            case '0':echo"<div class='rouge'></div>";break;
            case '-':echo"<div class='rouge'></div>";break;
            case 'f':echo"<div class='orange'></div>";break;
            case 'na':echo"<div class='orange'></div>";break;
        default: echo $valeur;
            
    }
}

/** 
 * li la variable dans un fichier
 *
 * Ouvre un fichier et récupère ce qu'il contient
 * @param string chemin_fichier chemin vers le fichier 
 * @return la variable recupérée
 */ 
function lire_variable_fic ($chemin_fichier)    {
    $fp = fopen ($chemin_fichier, "r");
    $variable = fgets ($fp);
    $variable= preg_replace("(\r\n|\n|\r)",'',$variable);
    fclose ($fp);
    return $variable;
}

/** 
 * li la variable dans un fichier
 *
 * Ouvre un fichier et récupère ce qu'il contient
 * @param string chemin_fichier chemin vers le fichier 
 * @return un tableau de donnée
 */ 
function fic_to_tableau ($Chemin_Fichier)   {
    $fileLines=file($Chemin_Fichier);
    $nb = count($fileLines);
    $message = "";
    $info_fichier=array();
    if (($monfichier = fopen($Chemin_Fichier, 'r+')) !== FALSE) {
        for ($ligne = 1 ; $ligne <= $nb ; $ligne++) {
            $scan_fin_de_ligne= preg_replace("(\r\n|\n|\r)",'',fgets($monfichier));
            if (preg_match("#^\##",$scan_fin_de_ligne,$content_addr2) !=1)
                $info_fichier[$ligne] = $scan_fin_de_ligne;    // enregistrement de chaque ligne en tab
        }
    }
    fclose($monfichier);
    return array ($info_fichier,$nb,$message);
}

/** 
 * Lecture du libelle selon l'etiquette et la langue
 *
 * mode prod affiche le libelle, dev affiche auusi l'etiquette devant le libelle
 * @param string mode le mode d'affichage
 * @param string tableau le tableau d'étiquette
 * @param string etiquette l'étiquette que l'on veut traduire
 * @return le résultat de l'étiquette
 */ 
function lire_libelle($mode,$tableau,$etiquette)    {
    foreach($tableau as $info_ligne)    {
        if (preg_match_all("/^$etiquette\|\|/",$info_ligne,$matches))   {
                $tab_ligne = explode("||",$info_ligne);
                if ($tab_ligne[1] != '')    {
                    if ($mode!='prod')  {
                        if (isset($_SESSION['aff_etiquette']) && $_SESSION['aff_etiquette']==1)
                                $libelle = "[$etiquette] ".$tab_ligne[1];
                        else $libelle = $tab_ligne[1];
                    }else $libelle = $tab_ligne[1];
                }else $libelle = "[".$etiquette."]";
                break;               
            }else $libelle = "[".$etiquette."]";
    }
    return $libelle;   
}

/** 
 * affichage simple (mode et b_dhcp)
 *
 * @param arrey mode tableau contenant l'etiquette mode et la valeur
 * @param arrey dhcp tableau contenant l'etiquette dhcp et la valeur
 */ 
function affichage_simple($mode, $dhcp) {
    echo"<div class='param_libelleI'>",$mode[0]," : </div><div class='param_valeurI'>",couleur($mode[1]),"</div><div class='clear'></div>";
    echo"<div class='param_libelleI'>",$dhcp[0]," : </div><div class='param_valeurI'>",couleur($dhcp[1]),"</div><div class='clear'></div>";
}

/** 
 * affichage supérieur
 *
 * affichage ou non des dl et des ds
 * @param string dl_start si oui ou non le client a activé le mode dl
 * @param string ds_start si oui ou non le client a activé le mode ds
 * @param array network tableau contenant toute les variables à afficher dans le bloc network
 * @param arrey info_client tableau contenant toute les variables de la table info_client
 */ 
function affichage_sup($dl_start,$ds_start, $network, $info_client) {
    $iproute = explode ("\n", $info_client);
    if ($dl_start[1]=="yes") {//dl active?
        for($i=10;$i<18;$i++) {
            $variable=explode("=", $network[$i]);
            echo"<div class='param_libelleI'>",$variable[0]," : </div><div class='param_valeurI'>",couleur($variable[1]),"</div><div class='clear'></div>";
        }
    }
    if ($ds_start[1]=="yes"){//ds active?
        for($i=19;$i<=26;$i++) {
            $variable=explode("=", $network[$i]);
            echo"<div class='param_libelleI'>",$variable[0]," : </div><div class='param_valeurI'>",couleur($variable[1]),"</div><div class='clear'></div>";
        }
    }
    echo"<table class='tab_info' style='margin-bottom:1.5em;'><thead><tr class='tr_info'>";
    echo"<th class='th_info'>Ip route</th>";
    echo"</tr></thead>";
    echo"<tbody class='tbody_info'><tr class='tr_info'>";
    foreach($iproute as $ip) 
        echo"<td class='td_info'>",$ip,"</td>";
    echo"</tr></tbody></table>";
}

/** 
 * affichage des information dans le cas où le boitier est en mode routeur  
 *
 * explode d'abord chaque information que l'on veut afficher puis les affiches avec la couleur correspondante 
 * @param array network tableau contenant toute les variables à afficher dans le bloc network
 */ 
function routeur($network){
    $r_ip_lan=explode("=",$network[4]);
    $r_mask_lan=explode("=",$network[5]);
    $r_ip_wan=explode("=", $network[6]);
    $r_nat=explode("=",$network[8]);
    echo"<div class='param_libelleI'>",$r_ip_lan[0]," : </div><div class='param_valeurI'>",couleur($r_ip_lan[1]),"</div><div class='clear'></div>";
    echo"<div class='param_libelleI'>",$r_mask_lan[0]," : </div><div class='param_valeurI'>",couleur($r_mask_lan[1]),"</div><div class='clear'></div>";
    echo"<div class='param_libelleI'>",$r_ip_wan[0]," : </div><div class='param_valeurI'>",couleur($r_ip_wan[1]),"</div><div class='clear'></div>";
    echo"<div class='param_libelleI'>",$r_nat[0]," : </div><div class='param_valeurI'>",couleur($r_nat[1]),"</div><div class='clear'></div>";
}

/** 
 * affichage dynamique du bloc network
 *
 * affiche les informations  en fonction du mode du boitier 
 * @param array network tableau contenant toute les variables à afficher dans le bloc network
 * @param arrey info_client tableau contenant toute les variables de la table info_client
 */ 
function network($network, $info_client) {
    $mode = explode("=", $network[0]);
    $dhcp=explode("=", $network[1]);
    $r_ip_wan=explode("=", $network[6]);
    $dl_start=explode("=", $network[10]);
    $ds_start=explode("=", $network[19]);
    switch($mode[1]) {
        case 'bridge':
            switch($dhcp[1]) {
                case 'yes':
                    affichage_simple($mode, $dhcp);
                    break;
                case 'no':
                    affichage_simple($mode, $dhcp);
                    $b_ip=explode("=", $network[2]);
                    $b_mask=explode("=", $network[3]);
                    echo"<div class='param_libelleI'>",$b_ip[0]," : </div><div class='param_valeurI'>",$b_ip[1],"</div><div class='clear'></div>";
                    echo"<div class='param_libelleI'>",$b_mask[0]," : </div><div class='param_valeurI'>",$b_mask[1],"</div><div class='clear'></div>";
                    affichage_sup($dl_start, $ds_start,$network, $info_client);
                    break;
            }break;
            
        case 'routeur':
            switch($r_ip_wan[1]) {
                case 'dhcp':
                    affichage_simple($mode, $dhcp);
                    routeur($network);
                    affichage_sup($dl_start, $ds_start,$network, $info_client);
                    break;
                default:
                    $r_mask_wan=explode("=", $network[7]);
                    affichage_simple($mode, $dhcp);
                    routeur($network);
                    echo"<div class='param_libelleI'>",$r_mask_wan[0]," : </div><div class='param_valeurI'>",couleur($r_mask_wan[1]),"</div><div class='clear'></div>";
                    affichage_sup($dl_start, $ds_start,$network, $info_client);
            }break;
    }
}
?>