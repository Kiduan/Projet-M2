<?php
    /* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : Frogi-secure distributeur                        */
    /*                                                         */ 
    /* Description du fichier : Controleur de déconnection     */
    /*                                                         */
    /* @Ce fichier déconnecte l'utilisateur actuel et le revoie*/
    /* vers la page de connexion.                              */
    /* ------------------------------------------------------- */
    session_start();
    session_destroy();
    header("Location:../index.php");
?>