<?php 
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

// assign posted variables to local variables
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$client_id = $_SESSION['client_id'];

if ( $payment_status == "Completed") {
    // On se connecte à la BDD
    try
    {
        $host = 'mysql:host=localhost;dbname=bdd_sucre'; 
        $utilisateur = 'test';
        $mdp = 'isen29';
        $connection = new PDO ( $host, $utilisateur, $mdp); 
    } catch ( Exception $e )
    {
        echo "Connection à MySQL impossible : ", $e->getMessage();
        die(); 
    }

    if($payment_amount == '12')
        $temps = '1';
    else if ($payment_amount == '30')
        $temps = '3';
    else if ($payment_amount == '120')
        $temps = '12';

    // Requête d'insertion
    $requete = $connection->prepare( '
        UPDATE client
        SET temps = :temps
        WHERE client_id = :client_id;' );
    $requete->execute( array(
        ':client_id' => $client_id,
        ':temps' => $temps
    ));
}
?>