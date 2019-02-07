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
    $mdpperdu=lireDonneeUrl('mdp');
    if ($mdpperdu == "oublie")   {
        $pdoExetud = new PdoBDD("localhost", "test", "isen29", "bdd_sucre");
        $email=lireDonneePost('email');
        $mail_verif = verifMail($pdoExetud, $email);
        if ($mail_verif == 0) {//true
                $new_mdp = random(8);
                $new_mdp_c = crypt($new_mdp);
                // envoi du mail avec identifiant et mot de passe du user
                $subject = "Nouveau mot de passe";
                $retour_mail = envoi_email($email,"tech@frogi-secure.com",$subject,$new_mdp);
                $pdoExetud->update("Mdp", "Email", "utilisateur", $new_mdp_c, $email);
                $_SESSION['Erreur'] = "mdp_change";
        }else $_SESSION['Erreur'] = "email_erreur";
    }else {//si il n'a pas oublié son mdp alors on regarde si il a rentré les bon mdp et nom
        $pdoExetud = new PdoBDD("localhost", "test", "isen29", "bdd_sucre");
        $nom=lireDonneePost('nom');
        $mdp=lireDonneePost('mdp');
        $verif = verifUser($pdoExetud, $nom, $mdp);
        if ($verif == 0) {//si true alors on initialise les variables de session
            $_SESSION['Nom'] = $nom;
            $_SESSION['Erreur'] = "no";//pas d'erreur donc utilisateur connecté et on affiche alors la page d'acceuil
            $_SESSION['Id'] = $pdoExetud->recupId($nom);
            $_SESSION['Tri'] = "no";
            $_SESSION['Rnom']="";
            $_SESSION['Retab']="";
            $_SESSION['Rserial']="";
            $_SESSION['Retat']="all";
            $_SESSION['Rmodel']="all";
            $_SESSION['RdateI']="";
            $_SESSION['RdateS']="";
            $_SESSION['Mdp']= $pdoExetud->recupUtilisateur("mdp", "admin", $_SESSION['Id']);
            //$_SESSION['Email'] = $pdoExetud->recupUtilisateur("email", "admin", $_SESSION['Id']);
        }else $_SESSION['Erreur'] = "mdp_erreur";//erreur donc on affichera la page de connection avec un alert
    } 
    header("Location:../index.php");
?>