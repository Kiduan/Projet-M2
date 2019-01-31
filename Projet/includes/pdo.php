<?php
    /* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : Frogi-secure distributeur                        */
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
        $req = "SELECT " . $valeur . " FROM  " . $bdd;
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
        $req = "SELECT  serial,client,admin_etablissement,etat,statut,date_fin_garantie_reelle FROM frogi_client_distri WHERE Id='" .$id. "' ORDER BY " .$tri. " " .$ordre;
        $cmd = $this->monPdo->query($req);
        $liste = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        return $liste;
    }
    
    /** 
     * recupère l'id de l'utilisateur connecté                    
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
    public function recupRecherche($id, $tri, $ordre ,$Rnom,$Retab,$Rserial,$RdateI,$RdateS,$Retat,$Rmodel) {
        if ($Rnom == "")
            $Nom='""';
        else $Nom="client";
        if ($Retab=="")
            $Etab='""';
        else $Etab="admin_etablissement";
        if ($Rserial == "")
            $Serial='""';
        else $Serial="serial";
        if ($RdateI == "")
            $DateI ='""';
        else $DateI = "date_fin_garantie";
        if ($RdateS == "")
            $DateS ='""';
        else $DateS = "date_fin_garantie";
        if ($Retat == "all"){
            $Etat='""';
            $Retat="";
        }else $Etat="etat";
        if ($Rmodel == "all"){
            $Model='""';
            $Rmodel="";
        }else $Model="serial";
        $req = "SELECT  serial,client,admin_etablissement,etat,statut,date_fin_garantie FROM frogi_client_distri 
        WHERE Id='".$id."' AND ".$Nom." LIKE '".$Rnom."%' AND ".$Etab." LIKE '".$Retab."%' AND ".$Serial." LIKE '%".$Rserial."%' ";
        if ($DateI!='""')
            $req .= "AND ".$DateI." >= '".$RdateI."' ";
        if ($DateS!='""')
            $req .="AND ".$DateI." <= '".$RdateS."' ";
        $req .= "AND ".$Etat." LIKE '".$Retat."%' AND ".$Model." LIKE '".$Rmodel."%' ORDER BY " .$tri. " ".$ordre;
        $cmd = $this->monPdo->query($req);
        $tab = $cmd->fetchAll();
        $cmd->closeCursor();
        return $tab;
    }
    
    /** 
     * recupère les info principal du boitier du client                   
     * 
     * @param string id l'utilisateur connecté
     * @param string serial numéro de serie du boitier
     * @return array liste obtenu
     */
    public function recupInfo($id, $serial)   {
        $req = "SELECT * FROM frogi_client_distri WHERE Id='".$id."' AND serial='".$serial."'";
        $cmd = $this->monPdo->query($req);
        $info = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        if($info)
            return $info[0];
    }
    
    /** 
     * recupère toutes les info du boitier du client                   
     * 
     * @param string num numéro du client dont on recherche les informations
     * @return array liste obtenu
     */
    public function recupInfoClient($num)   {
        $req = "SELECT * FROM client_info WHERE num='".$num."'";
        $cmd = $this->monPdo->query($req);
        $info = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        if($info)
            return $info[0];
    }
    
    /** 
     * recupère le numéro du client                  
     * 
     * @param string id l'utilisateur connecté
     * @param string serial numéro de serie du boitier
     * @return le numéro du client
     */
    public function recupNum($id, $serial)  {
        $req = "SELECT num FROM frogi_client_distri WHERE Id='".$id."'AND serial='".$serial."'";
        $cmd = $this->monPdo->query($req);
        $num = $cmd->fetchAll(PDO::FETCH_ASSOC);//ordonne le résultat en tableau associatif
        $cmd->closeCursor();
        if($num)
            return $num[0]['num'];
    }
    
    /** 
     * recupère une information d'un client ou d'un utilisateur                  
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
}

?>