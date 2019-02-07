<!--
/* ------------------------------------------------------- */
/* Frogi-secure   Baron Corentin   2016                    */
/* Site : Frogi-secure distributeur                        */
/*                                                         */ 
/* Description du fichier : Vue de la page de recherche    */
/*                                                         */
/* @Ce fichier gère l'affichage de la page de recherche.   */
/* Cette page permet de faire une recherche précise dans la*/
/* la liste de l'utilisateur connecté                      */
/* ------------------------------------------------------- */-->

<div class="titrecentre">Coupons</div>

    <div class="fcentre">
        <?php //--------------------------------------------------
            if (!empty($_POST['email'])) {
                $array = $_POST['email'];

                foreach ($array as $selectedval) {
                    echo 'checkbox de email = '.$selectedval.'</br>';
                }
            }//--------------------------------------------------
        ?>
                     
        <div class='clear'></div>
</div>