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
    $pdoExetud = new PdoBDD("localhost", "test", "isen29", "bdd_sucre");
    $nom=lireDonneePost('nom');
    $Amdp=lireDonneePost('Amdp');
    $Amdp=$Amdp."FarineEtudiantDomestiqueTours";
    $MDPbasse=$pdoExetud->recupUtilisateur_client("mdp", "client",$_SESSION['Id']);
    $AmdpCrypte=crypt($Amdp, $MDPbasse);
    $mdp1=lireDonneePost('mdp1');
    $mdp1=$mdp1."FarineEtudiantDomestiqueTours";
    $mdp1Crypte= crypt($mdp1, $MDPbasse);
    $mdp2=lireDonneePost('mdp2');
    $mdp2=$mdp2."FarineEtudiantDomestiqueTours";
    $mdp2Crypte= crypt($mdp2, $MDPbasse);
    $email=lireDonneePost('email');
    if ($AmdpCrypte== $pdoExetud->recupUtilisateur_client("mdp", "client",$_SESSION['Id'])) {//si il a rentré le bon mdp
        if($nom!="") {
            $pdoExetud->update("nom", "client_id", "client", $nom, $_SESSION['Id']);
            $_SESSION['Nom']=$nom;
        }
        if($mdp1==$mdp2 && $mdp1!="") {
            $pdoExetud->update("mdp", "client_id", "client", $mdp1Crypte, $_SESSION['Id']);
            $_SESSION['Mdp']=$mdp1Crypte;
            $verif=0;
        }else if($mdp1!=$mdp2) 
                $verif=1;
        if($email!="") {
           $pdoExetud->update("email", "client_id", "client", $email, $_SESSION['Id']);
           $_SESSION['Email']=$email;
        }
        if ($verif==1)
            $_SESSION['Erreur'] = "Mdp!=";
        else $_SESSION['Erreur'] = "oui";
    }else $_SESSION['Erreur'] = "FalseMdp";//sinon alert 
    header("Location:../index.php?uc=compte");
?>