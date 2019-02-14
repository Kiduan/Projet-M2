<?php
/* ------------------------------------------------------- */
/* ISEN   Baron Corentin   2016                            */
/* Site : demasquer le sucre                               */
/*                                                         */ 
/* Description du fichier : fichier appli mobile           */
/*                                                         */
/* @Ce fichier fait la liaison entre l'appli et le site    */
/* il reçoit unn code barre et renvoie un json             */
/* ------------------------------------------------------- */
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
{
    $code = (isset($_POST["code"])) ? $_POST["code"] : NULL;
    if ($code) {
        $str = file_get_contents('https://fr.openfoodfacts.org/api/v0/produit/'.$code.'.json');
        $json = json_decode($str, true); // decode the JSON into an associative array
        $variable = $json['product']['product_quantity'] * $json['product']['nutriments']['sugars_100g']/100;
        echo $variable;
    } else {
        echo "FALSE";
    }
}

?>