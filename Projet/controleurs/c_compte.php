<?php 
    /* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : Frogi-secure distributeur                        */
    /*                                                         */ 
    /* Description du fichier : Fichier controleur de la page  */
    /*                            de modification de compte    */
    /* @Ce fichier permet en fonction de la saisie de          */
    /*  l'utilisateur, de modifier ses informations de compte  */
    /*  dans la bdd (mdp, mail, nom de compte).                */
    /* ------------------------------------------------------- */
    session_start();
    require_once("../includes/fct.php");
    require_once("../includes/pdo.php");
    $pdoExetud = new PdoBDD("localhost", "test", "isen29", "frogi_client");
    $nom=lireDonneePost('nom');
    $Amdp=lireDonneePost('Amdp');
    $AmdpCrypte=crypt($Amdp, $_SESSION['Mdp']);
    $mdp1=lireDonneePost('mdp1');
    $mdp1Crypte= crypt($mdp1, $_SESSION['Mdp']);
    $mdp2=lireDonneePost('mdp2');
    $mdp2Crypte= crypt($mdp2, $_SESSION['Mdp']);
    $email=lireDonneePost('email');
    if ($AmdpCrypte==$_SESSION['Mdp']) {//si il a rentré le bon mdp
        if($nom!="") {
            $pdoExetud->update("Nom", "Id", "utilisateur", $nom, $_SESSION['Id']);
            $_SESSION['Nom']=$nom;
        }
        if($mdp1==$mdp2 && $mdp1!="") {
            $pdoExetud->update("Mdp", "Id", "utilisateur", $mdp1Crypte, $_SESSION['Mdp']);
            $_SESSION['Mdp']=$mdp1Crypte;
            $verif=0;
        }else if($mdp1!=$mdp2) 
                $verif=1;
        if($email!="") {
           $pdoExetud->update("Email", "Id", "utilisateur", $email, $_SESSION['Id']);
           $_SESSION['Email']=$email;
        }
        if ($verif==1)
            $_SESSION['Erreur'] = "Mdp!=";
        else $_SESSION['Erreur'] = "oui";
    }else $_SESSION['Erreur'] = "FalseMdp";//sinon alert 
    header("Location:../index.php?uc=compte");
?>