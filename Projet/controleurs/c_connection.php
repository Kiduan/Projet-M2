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
    //si il n'a pas oublié son mdp alors on regarde si il a rentré les bon mdp et nom
        $pdoExetud = new PdoBDD("localhost", "test", "isen29", "bdd_sucre");
        $nom=lireDonneePost('nom');
        $mdp=lireDonneePost('mdp');
        $verif = verifUser($pdoExetud, $nom, $mdp);
        if ($verif == 0) {//si true alors on initialise les variables de session
            $_SESSION['Admin']="yes";
            $_SESSION['Nom'] = $nom;
            $_SESSION['Erreur'] = "no";//pas d'erreur donc utilisateur connecté et on affiche alors la page d'acceuil
            $_SESSION['Id'] = $pdoExetud->recupId($nom);
            $_SESSION['Tri'] = "no";
            $_SESSION['Rnom']="";
            $_SESSION['Remail']="";
            $_SESSION['Rdate']="";
            $_SESSION['Rvip']="";
            $_SESSION['Rtemps']="";
            $_SESSION['Ritemps']="";
            $_SESSION['RdateI']="";
            $_SESSION['RdateS']="";
            $_SESSION['Mdp']= $pdoExetud->recupUtilisateur("mdp", "admin", $_SESSION['Id']);
            //$_SESSION['Email'] = $pdoExetud->recupUtilisateur("email", "admin", $_SESSION['Id']);
        }else $_SESSION['Erreur'] = "mdp_erreur";//erreur donc on affichera la page de connection avec un alert
    header("Location:../index.php");
?>