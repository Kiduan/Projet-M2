<?php
/* ------------------------------------------------------- */
/* ISEN   Baron Corentin   2016                            */
/* Site : demasquer le sucre                               */
/*                                                         */ 
/* Description du fichier : fichier appli mobile           */
/*                                                         */
/* @Ce fichier fait la liaison entre l'appli et le site    */
/* ------------------------------------------------------- */
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
{
    require_once("../includes/fct.php");
    require_once("../includes/pdo.php");
    header("Content-Type: text/plain"); // Utilisation d'un header pour spécifier le type de contenu de la page. Ici, il s'agit juste de texte brut (text/plain). 
    $pdoExetud = new PdoBDD("localhost", "test", "isen29", "bdd_sucre");
    $email = (isset($_POST["email"])) ? $_POST["email"] : NULL;
    $mdp = (isset($_POST["mdp"])) ? $_POST["mdp"] : NULL;
    if ($email && $mdp) {
        $mdp=$mdp."FarineEtudiantDomestiqueTours";
        $verif = verifUser_client($pdoExetud, $email, $mdp);
        $actif = $pdoExetud->recupUtilisateur_client_email("actif", "client", $email);
        if($actif==1) {
            echo "TRUE";
        }else echo "FALSE";
    } else {
        echo "FALSE";
    }
}

?>