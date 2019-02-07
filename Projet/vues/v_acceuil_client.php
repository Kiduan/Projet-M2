<!--/* ------------------------------------------------------- */
    /* Frogi-secure   Baron Corentin   2016                    */
    /* Site : Frogi-secure distributeur                        */
    /*                                                         */ 
    /* Description du fichier : Vue de la page d'acceuil       */
    /*                                                         */
    /* @Ce fichier gère l'affichage de la page d'acceuil.      */
    /* La page d'accceuilest la page par défaut du site. On y  */
    /* arrive après que l'utilisateur est bien connecté.       */
    /* Cette page liste dans un tableau tout les clients liés à*/
    /* l'utilisateur connecté.                                 */
    /* ------------------------------------------------------- */-->
<div class="titrecentre">Info client</div>

    <div class="fcentre">
        <?php 
        echo "Admin=".$_SESSION['Admin']."</br>";
        echo "Nom=".$_SESSION['Nom']."</br>";
        echo "Email=".$_SESSION['Email']."</br>";
        echo "Mdp=".$_SESSION['Mdp']."</br>";
        echo "Date_inscription=".$_SESSION['Date_inscription']."</br>";
        echo "Vip=".$_SESSION['Vip']."</br>";
        echo "Temps=".$_SESSION['Temps']."</br>";
        echo "Id=".$_SESSION['Id']."</br>";
        echo "Erreur=".$_SESSION['Erreur']."</br>";
        ?>
                     
        <div class='clear'></div>
</div>  
                     