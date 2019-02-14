<?php 
    // Si des données sont postées
    if( isset( $_POST['client_id'], $_POST['temps'] ) ) {
         
        // On se connecte à la BDD
        try
        {
            $host = 'mysql:host=localhost;dbname=bdd_sucre'; 
            $utilisateur = 'root';
            $mdp = '';
            $connection = new PDO ( $host, $utilisateur, $mdp); 
        } catch ( Exception $e )
        {
            echo "Connection à MySQL impossible : ", $e->getMessage();
            die(); 
        }

        // Requête d'insertion
        $requete = $pdo->prepare( '
            UPDATE client
            SET temps = :temps
            WHERE client_id = :client_id;' );
        $requete->execute( array(
            ':client_id' => $_POST['client_id'],
            ':temps' => $_POST['temps'],
        ));
    }
?>

