<?php
    /* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2019                    */
    /* Site : Démasquer le Sucre                               */
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
    $tabNom = $pdoExetud->recupBdd_admin("nom", "admin");
    $tabMdp = $pdoExetud->recupBdd_admin("mdp", "admin");
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
?>