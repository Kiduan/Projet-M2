<?php
echo "True";
header('Access-Control-Allow-Origin: *');
header('X-Frame-Options: DENY');
header("Content-Type: text/plain");
header('X-Content-Type-Options: nosniff');
header("X-XSS-Protection: 1");


try
{
        $host = 'mysql:host=localhost;dbname=bdd_sucre';
        $utilisateur = 'root';
        $mdp = 'MyErpCip';
        $db = new PDO ( $host, $utilisateur, $mdp);
} catch ( Exception $e )
{
        echo "Connection    MySQL impossible : ", $e->getMessage();
        die();
}

if(!isset($_GET['mail']) && !isset($_GET['motDePasse']))
{
    echo "1";
}
else
{

        $email = $_GET['mail'];
        $mdp = $_GET['motDePasse'];

        $requete = "SELECT * FROM client WHERE email= :email AND mdp= :mdp ";
        $result= $db->prepare($requete);




        $result->bindParam(':email', $email);
        $result->bindParam(':mdp', $mdp);

        $result->execute();

                if( $result->fetch() !=null)
                        echo "True";
                else
                        echo "2";
}

?>

