<?php

header('HTTP/1.1 200 OK');

$resp = 'cmd=_notify-validate';
foreach ($_POST as $parm => $var) 
	{
	$var = urlencode(stripslashes($var));
	$resp .= "&$parm=$var";
	}
	
$httphead = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$httphead .= "Content-Type: application/x-www-form-urlencoded\r\n";
$httphead .= "Content-Length: " . strlen($resp) . "\r\n\r\n";
 
$errno ='';
$errstr='';

$item_name        = $_POST['item_name'];
$item_number      = $_POST['item_number'];
$payment_status   = $_POST['payment_status'];
$payment_amount   = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id           = $_POST['txn_id'];
$receiver_email   = $_POST['receiver_email'];
$payer_email      = $_POST['payer_email'];
$custom 	 	  = $_POST['custom'];

//$fh = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
$fh = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
 
 if (!$fh) {
 
           } 
		   		   
else 	{
           fputs ($fh, $httphead . $resp);
		   while (!feof($fh))
				{
				$readresp = fgets ($fh, 1024);
				if (strcmp ($readresp, "VERIFIED") == 0) 
					{

					}
 
				else if (strcmp ($readresp, "INVALID") == 0) 
					{
  
					}
				}
fclose ($fh);
        }
    // transaction valide
    
        // vérifier que payment_status a la valeur Completed
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

            if($payment_amount == '12.00')
                $temps = '30';
            else if ($payment_amount == '30.00')
                $temps = '90';
            else if ($payment_amount == '120.00')
                $temps = '365';

            //$requete = $connection->query('UPDATE client SET temps = "12" WHERE client_id = 1');

            // Requête d'insertion
            $requete = $connection->prepare('UPDATE client SET temps = :temps  WHERE client_id = :custom');

            $requete->execute( array(
                ':custom' => $_POST['custom'],
                ':temps' => $temps));
        }
?>