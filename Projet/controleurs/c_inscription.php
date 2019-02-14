<?php
    /* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : Frogi-secure distributeur                        */
    /*                                                         */ 
    /* Description du fichier : Controleur de connection       */
    /*                                                         */
    /* @Ce fichier démarre la session de l'utilisateur demandé,*/
    /* initialise les variables de session et le renvoie vers  */
    /* la page d'acceuil.                                      */
    /* ------------------------------------------------------- */
    
    session_start();
    require_once("../includes/fct.php");
    require_once("../includes/pdo.php");
    $pdoExetud = new PdoBDD("localhost", "test", "isen29", "bdd_sucre");
    $email=lireDonneePost('email');
    $mdp1=lireDonneePost('mdp1');
    $mdp1=$mdp1."FarineEtudiantDomestiqueTours";
    $mdp2=lireDonneePost('mdp2');
    $mdp2=$mdp2."FarineEtudiantDomestiqueTours";
    $nom=lireDonneePost('nom');

    if($mdp1==$mdp2){
        $mdp=crypt($mdp1);
        if(verifMail($pdoExetud, $email)) {//verifie que l'email n'existe pas dans la bdd
            $pdoExetud->delete("client");
            $pdoExetud->insert($nom, $mdp, $email, date("Y-m-d H:i:s"), "client");
            //envoie un mail
            $_SESSION['Erreur'] = "creation_compte";
        }else $_SESSION['Erreur'] = "email_existe"; 
    }else {
        $_SESSION['Erreur'] = "mdp_erreur";//erreur donc on affichera la page de connection avec un alert 
    }
    header("Location:../index.php");
?>