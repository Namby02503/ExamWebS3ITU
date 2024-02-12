<?php
include "connexion.php"; 

function insertElement($nomTable, $colonnes, $valeurs)
{
    $connexion = get_connexion();
    try {
       

        // Paramétrer PDO pour afficher les erreurs
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Construire la partie SET de la requête SQL en utilisant les colonnes et les valeurs
        $setClause = "";
        foreach ($colonnes as $index => $colonne) {
            $setClause .= "$colonne = :valeur$index, ";
        }
        $setClause = rtrim($setClause, ', ');

        // Requête SQL pour effectuer la mise à jour
        $requete = "INSERT INTO $nomTable SET $setClause ";

        // Préparation de la requête
        $statement = $connexion->prepare($requete);

        // Remplacement des paramètres de la requête
        foreach ($colonnes as $index => $colonne) {
            $statement->bindParam(":valeur$index", $valeurs[$index]);
        }

        // Exécution de la requête
        $statement->execute();

        // Fermeture de la connexion
        $connexion = null;

        // Retourner vrai si la mise à jour a réussi
        return true;

    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur : " . $e->getMessage();
        return false; // Retourner faux si la mise à jour a échoué
    }
}

function updateElement($nomTable, $idElement, $colonnes, $valeurs)
{
    $connexion = get_connexion();
    try {
       

        // Paramétrer PDO pour afficher les erreurs
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Construire la partie SET de la requête SQL en utilisant les colonnes et les valeurs
        $setClause = "";
        foreach ($colonnes as $index => $colonne) {
            $setClause .= "$colonne = :valeur$index, ";
        }
        $setClause = rtrim($setClause, ', ');

        // Requête SQL pour effectuer la mise à jour
        $requete = "UPDATE $nomTable SET $setClause WHERE id = :id";

        // Préparation de la requête
        $statement = $connexion->prepare($requete);

        // Remplacement des paramètres de la requête
        foreach ($colonnes as $index => $colonne) {
            $statement->bindParam(":valeur$index", $valeurs[$index]);
        }
        $statement->bindParam(':id', $idElement);

        // Exécution de la requête
        $statement->execute();

        // Fermeture de la connexion
        $connexion = null;

        // Retourner vrai si la mise à jour a réussi
        return true;

    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur : " . $e->getMessage();
        return false; // Retourner faux si la mise à jour a échoué
    }
}

// Utilisation de la fonction avec des paramètres spécifiques
$nomTable = "personne"; // Remplacez cela par le nom de votre table
$idElement = 2; // Remplacez cela par l'ID de l'élément à mettre à jour
$colonnes = array("email", "mdp", "type"); // Remplacez cela par les noms des colonnes à mettre à jour
$valeurs = array("haha2.com", "nouvelle_valeur2", "A"); // Remplacez cela par les nouvelles valeurs

if (insertElement($nomTable, $colonnes, $valeurs)) {
    echo "L'élément avec l'ID $idElement a été mis à jour avec succès.";
} else {
    echo "Une erreur s'est produite lors de la mise à jour de l'élément.";
}


function recupererDonneesTable($nomTable,$id)
{
    $connexion = get_connexion();

    try {
        
        // Paramétrer PDO pour afficher les erreurs
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Requête SQL pour récupérer les données de la table
        if ($id==null) {
            $requete = "SELECT * FROM $nomTable";
         }else {
            if ($nomTable!="parcelle") {
                $requete = "SELECT * FROM $nomTable where id=$id";
            }else {
                $requete = "SELECT * FROM $nomTable where numParcelle=$id";
            }

        }

        // Préparation de la requête
        $statement = $connexion->prepare($requete);

        // Exécution de la requête
        $statement->execute();

        // Récupération de toutes les lignes
        $resultat = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Fermeture de la connexion
        $connexion = null;

        // Retourner les données sous forme de tableau
        return $resultat;

    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur : " . $e->getMessage();
        return null; // Retourner null en cas d'erreur
    }
}

// Utilisation de la fonction avec le nom de la table spécifique
// $nomTable = "cueilleur"; // Remplacez cela par le nom de votre table
// $id = null;
// $resultat = recupererDonneesTable($nomTable,$id);

// // Affichage du résultat (à des fins de démonstration, vous pouvez adapter selon vos besoins)
// if ($resultat !== null) {
//     echo "<pre>";
//     print_r($resultat);
//     echo "</pre>";
// } else {
//     echo "Une erreur s'est produite lors de la récupération des données de la table.";
// }


function supprimerElement($id,$nomTable)
{

    $connexion = get_connexion();

    try {

        // Paramétrer PDO pour afficher les erreurs
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour supprimer l'élément
        $requete = "DELETE FROM $nomTable WHERE id = :id";

        // Préparation de la requête
        $statement = $connexion->prepare($requete);

        // Remplacement du paramètre de la requête
        $statement->bindParam(':id', $id);

        // Exécution de la requête
        $statement->execute();

        // Fermeture de la connexion
        $connexion = null;

        // Retourner vrai si la suppression a réussi
        return true;

    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur : " . $e->getMessage();
        return false; // Retourner faux si la suppression a échoué
    }
}





function calculerFeuillesRestantes($datemin, $datemax)
{
    // Paramètres de connexion à la base de données
    $connexion = get_connexion();
    try {
        // Connexion à la base de données

        // Paramétrer PDO pour afficher les erreurs
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL
        $requete = "SELECT totalFeuille - (
            SELECT SUM(poidsCueilli)
            FROM cueillette
            WHERE dt >= :datemin AND dt <= :datemax
        ) AS feuilleRestant
        FROM v_feuilletotales";

        // Préparation de la requête
        $statement = $connexion->prepare($requete);

        // Remplacement des paramètres de la requête
        $statement->bindParam(':datemin', $datemin);
        $statement->bindParam(':datemax', $datemax);

        // Exécution de la requête
        $statement->execute();

        // Récupération du résultat
        $resultat = $statement->fetch(PDO::FETCH_ASSOC);

        // Utilisation du résultat
        $feuilleRestant = $resultat['feuilleRestant'];

        // Fermeture de la connexion
        $connexion = null;

        // Retourner le résultat
        return $feuilleRestant;

    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur : " . $e->getMessage();
        return null; // Vous pouvez choisir de gérer l'erreur de la manière qui vous convient
    }
}


function getPoidsTotalCueillette($dmin, $dmax)
{
    $connexion = get_connexion();
    try {
        

        // Paramétrer PDO pour afficher les erreurs
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL
        $requete = "SELECT SUM(poidsCueilli) AS totalPoidsCueilli
                    FROM cueillette
                    WHERE dt >= :dmin AND dt <= :dmax";

        // Préparation de la requête
        $statement = $connexion->prepare($requete);

        // Remplacement des paramètres de la requête
        $statement->bindParam(':dmin', $dmin);
        $statement->bindParam(':dmax', $dmax);

        // Exécution de la requête
        $statement->execute();

        // Récupération du résultat
        $resultat = $statement->fetch(PDO::FETCH_ASSOC);

        // Utilisation du résultat
        $totalPoidsCueilli = $resultat['totalPoidsCueilli'];

        // Fermeture de la connexion
        $connexion = null;

        // Retourner le résultat
        return $totalPoidsCueilli;

    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur : " . $e->getMessage();
        return null; // Vous pouvez choisir de gérer l'erreur de la manière qui vous convient
    }
}


function getCoutTotal($dmin, $dmax)
{
    $connexion = get_connexion();
    try {
        

        // Paramétrer PDO pour afficher les erreurs
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL
        $requete = "SELECT SUM(montant) AS coutTotal
                    FROM depense
                    WHERE dt >= :dmin AND dt <= :dmax";

        // Préparation de la requête
        $statement = $connexion->prepare($requete);

        // Remplacement des paramètres de la requête
        $statement->bindParam(':dmin', $dmin);
        $statement->bindParam(':dmax', $dmax);

        // Exécution de la requête
        $statement->execute();

        // Récupération du résultat
        $resultat = $statement->fetch(PDO::FETCH_ASSOC);

        // Utilisation du résultat
        $coutTotal = $resultat['coutTotal'];

        // Fermeture de la connexion
        $connexion = null;

        // Retourner le résultat
        return $coutTotal;

    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur : " . $e->getMessage();
        return null; // Vous pouvez choisir de gérer l'erreur de la manière qui vous convient
    }
}

function getCoutDeRevient($totalPoidsCueilli,$totalPoidRestant,$depense) {
    return $depense/($totalPoidRestant+$totalPoidsCueilli);
}

// Utilisation de la fonction avec des dates spécifiques
$dmin = '2024-02-01';
$dmax = '2024-02-03';
$resultat = getCoutTotal($dmin, $dmax);

// Affichage du résultat
if ($resultat !== null) {
    echo "Le total du poids cueilli entre $dmin et $dmax est : $resultat";
} else {
    echo "Une erreur s'est produite lors du calcul du total du poids cueilli.";
}



// // Exemple d'utilisation de la fonction
// $nomCueilleur = "1";
// $occupation = 12;
// // $rendement = 1;

// insertSalaire($nomCueilleur,$occupation);




?>