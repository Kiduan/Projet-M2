<?php
/* ------------------------------------------------------- */
/* ISEN   Baron Corentin   2016                            */
/* Site : demasquer le sucre                               */
/*                                                         */
/* Description du fichier : fichier appli mobile           */
/*                                                         */
/* @Ce fichier fait la liaison entre l'appli et le site    */
/* il re  oit unn code barre et renvoie un json             */
/* ------------------------------------------------------- */
    header('Access-Control-Allow-Origin: *');
    header('X-Frame-Options: DENY');
    header("Content-Type: text/plain");
    header('X-Content-Type-Options: nosniff');
    header("X-XSS-Protection: 1");
    $code = (isset($_GET["code"])) ? $_GET["code"] : NULL;
    if ($code) {
        $str = file_get_contents('https://fr.openfoodfacts.org/api/v0/produit/'.$code.'.json');
        $json = json_decode($str, true); // decode the JSON into an associative array
        $morceaux = $json['product']['product_quantity'] * $json['product']['nutriments']['sugars_100g']/500;
		$url=$json['product']['image_url'] ;
		$myObj->morceaux=$morceaux;
		$myObj->url=$url;
		$variable = json_encode($myObj);
        echo  $variable;
    } else {
        echo "False";
    }


?>





