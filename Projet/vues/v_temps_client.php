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

<div class="titrecentre">Ajout de temps</div>
    <div class="fcentre">

    <form align="center" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="Z4U3X4DR6529C">
        <input type="hidden" name="return" value="http://172.31.7.30/index.php?uc=temps">
        <input type="hidden" name="notify_url" value="http://172.31.7.30/vues/v_validation_paiement.php">
        <table align="center">
        <tr><td><input type="hidden" name="on0" value="Achat temps">Achat de temps</td></tr><tr><td><select name="os0">
            <option value="1 mois -">1 mois - €10,00 EUR</option>
            <option value="3 mois -">3 mois - €25,00 EUR</option>
            <option value="1 an -">1 an - €100,00 EUR</option>
        </select> </td></tr>
        </table>
        <input type="hidden" name="currency_code" value="EUR">
        <input type="image" src="https://www.sandbox.paypal.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
        <img alt="" border="0" src="https://www.sandbox.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
    </form>
    
    <div class='clear'></div>
</div>