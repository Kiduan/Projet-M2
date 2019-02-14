<?php
    /* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2019                    */
    /* Site : Démasquer le Sucre                               */
    /*                                                         */ 
    /* Description du fichier : Fichier fonction class Pdo     */
    /*                                                         */
    /* @Ce fichier contient toute les fonctions de récupération*/
    /* d'information dans la base de donnée (class PdoBDD)     */
    /* ------------------------------------------------------- */
class PdoBDD{        
    private $monPdo;
    
    /**
     * Crée l'instance de PDO qui sera sollicitée
     * par toutes les méthodes de la classe
     */             
    public function __construct($serveur, $user, $mdp, $bdd){
        // crée la chaîne de connexion mentionnant le type de sgbdr, l'hôte et la base
        $chaineConnexion = 'mysql:host=' . $serveur . ';dbname=' . $bdd;
        // crée une instance de PDO (connexion avec le serveur MySql) 
        try {
        $this->monPdo = new PDO($chaineConnexion, $user, $mdp); 
            }   catch (Exception $e)    {   die('Erreur : ' . $e->getMessage());    }
        // indique que le dialogue se fera en utilisant l'encodage utf-8
        $this->monPdo->query("SET CHARACTER SET utf8");
    }
    
    /** 
     * Détruit l'instance de PDO qui sera sollicitée 
     * par toute les méthodes de la class                  
     */
    public function _destruct() {
        $this->monPdo = null;
    }
    
    /** 
     * recupère dans la bdd la colonne de la valeur demander                    
     * 
     * envoie une requete sql pour recupérer les informations de la colonne demandé
     * @param string valeur colonne que l'on cherche dans la table
     * @param string bdd nom de la table dans la bdd
     * @return array liste de la colonne que l'on recherche
     */
    public function recupBdd($valeur, $bdd) {
        $req = "SELECT " . $valeur . " FROM  " . $bdd . " ORDER BY email ASC";
        $cmd = $this->monPdo->query($req);
        $tab = $cmd->fetchAll();
        $cmd->closeCursor();
        return $tab;
    }
    
    /** 
     * recupère dans la bdd la colonne de la valeur demander pour l'admin                   
     * 
     * envoie une requete sql pour recupérer les informations de la colonne demandé
     * @param string valeur colonne que l'on cherche dans la table
     * @param string bdd nom de la table dans la bdd
     * @return array liste de la colonne que l'on recherche
     */
    public function recupBdd_admin($valeur, $bdd) {
        $req = "SELECT " . $valeur . " FROM  " . $bdd . " ORDER BY nom ASC";
        $cmd = $this->monPdo->query($req);
        $tab = $cmd->fetchAll();
        $cmd->closeCursor();
        return $tab;
    }
    
    /** 
     * recupère dans la bdd les information que l'on a besoin                     
     * 
     * envoie une requete sql pour recupérer les informations pour le tableau de la page 
     * d'acceuil et le tri en fonction de la demande de l'utilisateur
     * @param string id numéro de l'utilisateur connecté
     * @param string tri mode de tri 
     * @param string ordre ordre croissant ou décroissant
     * @return array liste obtenue
     */
    public function recupListe($id, $tri, $ordre) {//recup all avec where id=$id
        $req = "SELECT  nom,email,date_inscription,vip,temps FROM client WHERE actif IS TRUE ORDER BY " . $tri . " " .  $ordre;
        $cmd = $this->monPdo->query($req);
        $liste = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        return $liste;
    }
    
    /** 
     * recupère l'id de l'utilisateur admin connecté                    
     * 
     * envoie une requete sql pour recupérer l'id de l'utilisateur connecté (on vérifie par rapport au nom)
     * @param string nom nom de compte de l'utilisateur connecté
     * @return string id de l'utilisateur connecté
     */
    public function recupId($nom)   {
        $req = "SELECT admin_id FROM admin WHERE nom='" .$nom. "'";
        $cmd = $this->monPdo->query($req);
        $id = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        return $id[0]['admin_id'];
    }
    
        
    /** 
     * recupère l'id de l'utilisateur client connecté                    
     * 
     * envoie une requete sql pour recupérer l'id de l'utilisateur connecté (on vérifie par rapport au nom)
     * @param string nom nom de compte de l'utilisateur connecté
     * @return string id de l'utilisateur connecté
     */
    public function recupId_client($email)   {
        $req = "SELECT client_id FROM client WHERE email='" .$email. "'";
        $cmd = $this->monPdo->query($req);
        $id = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        return $id[0]['client_id'];
    }
    
    /** 
     * Récupère les clients qui correspondent aux informations que l'on recherche                   
     * 
     * @param string id numéro de l'utilisateur connecté
     * @param string tri mode de tri 
     * @param string ordre ordre croissant ou décroissant
     * @param string Rnom nom que l'on recherche
     * @param string Retab nom de l'établissement que l'on recherche
     * @param string Rserial numéro serial que l'on recherche
     * @param string RdateI plage horraire des date de fin de garantie que l'on recherche
     * @param string RdateS plage horraire des date de fin de garantie que l'on recherche
     * @param string Retat etat du boitier du client que l'on recherche
     * @param string Rmodel model du boitier que l'on recherche
     * @return array tab liste obtenue
     */
    public function recupRecherche($tri, $ordre ,$Rnom,$Remail,$Rvip,$RdateI,$RdateS,$Rtemps,$Ritemps) {
        if ($Rnom == "")
            $Nom='""';
        else $Nom="nom";
        if ($Remail=="")
            $Email='""';
        else $Email="email";
        if ($Rvip == "")
            $Vip='""';
        else $Vip="vip";
        if ($RdateI == "")
            $DateI ='""';
        else $DateI = "date_inscription";
        if ($RdateS == "")
            $DateS ='""';
        else $DateS = "date_inscription";
        if ($Rtemps == ""){
            $Temps='""';
        }else $Temps="temps";
       
        $req = "SELECT  nom,email,date_inscription,vip,temps FROM client 
        WHERE actif IS TRUE AND ".$Nom." LIKE '%".$Rnom."%' AND ".$Email." LIKE '".$Remail."%' AND ".$Vip." LIKE '".$Rvip."' ";
        if ($DateI!='""')
            $req .= "AND ".$DateI." >= '".$RdateI."' ";
        if ($DateS!='""')
            $req .="AND ".$DateI." <= '".$RdateS."' ";
        if ($Rtemps != "" && $Ritemps==""){
            $req .= "AND ".$Temps."='".$Rtemps."' ORDER BY " .$tri. " ".$ordre;
        }else if ($Rtemps=="" && $Ritemps!="") {
            $req .= " ORDER BY " .$tri. " ".$ordre;
        }else if ($Rtemps=="" && $Ritemps=="") {
             $req .= " ORDER BY " .$tri. " ".$ordre;
        }else  $req .= "AND ".$Temps.$Ritemps."'".$Rtemps."' ORDER BY " .$tri. " ".$ordre;
        $cmd = $this->monPdo->query($req);
        //echo $req;
        $tab = $cmd->fetchAll();
        $cmd->closeCursor();
        return $tab;
    }
    
    /** 
     * recupère une information d'un admin              
     * 
     * @param string info information que l'on recherche
     * @param string bdd nom de la table où on recherche des informations
     * @param string id id de l'utilisateur dont on recherche des informations
     * @return array liste obtenu
     */
    public function recupUtilisateur($info, $bdd,$id) {
        $req = "SELECT ".$info." FROM ".$bdd." WHERE admin_id='".$id."'";
        $cmd = $this->monPdo->query($req);
        $recup = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        if($recup)
            return $recup[0][$info];
    }
    
        /** 
     * recupère une information d'un client                
     * 
     * @param string info information que l'on recherche
     * @param string bdd nom de la table où on recherche des informations
     * @param string id id de l'utilisateur dont on recherche des informations
     * @return array liste obtenu
     */
    public function recupUtilisateur_client($info, $bdd,$id) {
        $req = "SELECT ".$info." FROM ".$bdd." WHERE client_id='".$id."'";
        $cmd = $this->monPdo->query($req);
        $recup = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        if($recup)
            return $recup[0][$info];
    }
    
    /** 
     * recupère une information d'un client                
     * 
     * @param string info information que l'on recherche
     * @param string bdd nom de la table où on recherche des informations
     * @param string id id de l'utilisateur dont on recherche des informations
     * @return array liste obtenu
     */
    public function recupUtilisateur_client_email($info, $bdd,$email) {
        $req = "SELECT ".$info." FROM ".$bdd." WHERE email='".$email."'";
        $cmd = $this->monPdo->query($req);
        $recup = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        if($recup)
            return $recup[0][$info];
    }
    
    /** 
     * update les informations de l'utilisateur connecté                 
     * 
     * @param string champ champ que l'on veut update
     * @param string where variable pour choisir quel utilisateur/client update
     * @param string bdd nom de la table que l'on veut update
     * @param string nv information a mettre dans la bdd
     * @param string valeur valeur de where pour spécifier l'utilisateur/client à update
     */
    public function update($champ, $where, $bdd, $nv, $valeur) {
        $req = "UPDATE ".$bdd." SET ".$champ."='".$nv."' WHERE ".$where."='".$valeur."'";
        $this->monPdo->exec($req);
    }
    
    /** 
     * insert le nouvel utilisateur                 
     * 
     * @param string nom 
     * @param string mdp 
     * @param string email 
     * @param string dt date d'incription
     * @param string bdd nom de la table où l'on veut insert
     */
    public function insert($nom, $mdp, $email, $dt, $bdd) {
        $req = "INSERT INTO ".$bdd." (nom,mdp,email,date_inscription,vip,temps,mdp_modif_allow,actif) VALUES ('".$nom."','".$mdp."','".$email."','".$dt."','false',0,0,0)";
        $this->monPdo->exec($req);
    }

    /** 
     * Delete le nouvel utilisateur                 
     * 
     * @param string nom 
     * @param string mdp 
     * @param string email 
     * @param string dt date d'incription
     * @param string bdd nom de la table où l'on veut insert
     */
    public function delete($bdd) {
        $req = "DELETE FROM ".$bdd." WHERE TIMESTAMPDIFF(hour,date_inscription,now())>=4 AND actif IS FALSE";
        echo $req; 
        //$this->monPdo->exec($req);
    }
    
}

?>