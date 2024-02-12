<?php
include "connexion.php"; 



function insertCueillette($dt, $idCueilleur, $numParcelle,$poidsCueilli) {
    $connexion = get_connexion();

    try {
        // Préparation de la requête d'insertion
        $requete = $connexion->prepare("INSERT INTO cueillette (dt, idCueilleur, numParcelle,poidsCueilli) VALUES (:dt, :idCueilleur, :numParcelle, :poidsCueilli)");

        // Liaison des paramètres
        $requete->bindParam(':dt', $dt);
        $requete->bindParam(':idCueilleur', $idCueilleur);
        $requete->bindParam(':numParcelle', $numParcelle);
        $requete->bindParam(':poidsCueilli', $poidsCueilli);

        // Exécution de la requête
        $requete->execute();

        echo "Insertion réussie !";
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion : " . $e->getMessage();
    }

    // Fermeture de la connexion
    $connexion = null;
}

// Exemple d'utilisation de la fonction
$nomCueilleur = "2023-12-08";
$occupation = 1;
$rendement = 1;
$poidsCueilli = 12;

insertCueillette($nomCueilleur,$occupation,$rendement,$poidsCueilli);

?>