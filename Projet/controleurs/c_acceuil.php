<?php
    /* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : Frogi-secure distributeur                        */
    /*                                                         */ 
    /* Description du fichier : Controleur de la page d'accueil*/
    /*                                                         */
    /* @Ce fichier permet de trier le tableau des clients en   */
    /* fonction de la demande de l'utilisateur.                */
    /* Un tri croissant par nom est effectué par défaut.       */
    /* ------------------------------------------------------- */

    $ordre = lireDonneeUrl('ordre');
    $tri = lireDonneeUrl('tri');
    if ($tri)
        $_SESSION['Tri'] = $tri;
    if ($_SESSION['Tri'] != "no")   {
        if ($ordre != "")  
           $_SESSION['Liste']=$pdoExetud->recupListe($_SESSION['Id'], $_SESSION['Tri'], $ordre);
        else  $_SESSION['Liste']=$pdoExetud->recupListe($_SESSION['Id'], $_SESSION['Tri'], "ASC");
    }else    $_SESSION['Liste']=$pdoExetud->recupListe($_SESSION['Id'], "client", "ASC");//pas de tri donc affichage par defaut
?>