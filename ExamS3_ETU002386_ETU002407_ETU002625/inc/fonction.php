<?php
include "connexion.php"; 
function checkLogin($email,$mdp,$type) {
    $con = get_connexion();
    $sql = "select id from Personne where email = '$email' and mdp = '$mdp' and type = '$type'";
    $q = $con -> query($sql);
    $result = $q -> fetch(PDO::FETCH_ASSOC);
    $id = 0;
    if ($result) {
        $id = $result['id'];
    }   
    return $id;
}

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
        return "Insertion reusssi";

    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur : " . $e->getMessage();
        return "Echec d'insertion"; // Retourner faux si la mise à jour a échoué
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


function getMoisAvant($mois) {
    $connexion = get_connexion();
    try {
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT mois from regenerationConfig where mois<$mois order by mois desc limit 1";
        $statement = $connexion->prepare($query);

        // Exécution de la requête
        $statement->execute();

        // Récupération de toutes les lignes
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (count($row)==0) {
            $query1 = "SELECT mois from regenerationConfig where mois>$mois order by mois desc limit 1";
            $statement = $connexion->prepare($query1);

            // Exécution de la requête
            $statement->execute();

            // Récupération de toutes les lignes
            $row1 = $statement->fetchAll(PDO::FETCH_ASSOC);
            var_dump($row1);
            return $row1;
        }else {
            var_dump($row);
            return $row;
        }

    }catch (PDOException $e) {
    // Gestion des erreurs de la base de données
    echo "Erreur : " . $e->getMessage();
    return false; // Retourner faux si la mise à jour a échoué
    }
}

function getMoisApres($mois) {
    $connexion = get_connexion();
    try {
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($mois!=12) {
            $query="SELECT mois from regenerationConfig where mois>=$mois order by mois asc limit 1";
        } else {
            $query="SELECT mois from regenerationConfig where mois<=$mois order by mois desc limit 1";
        }
        $stmt = $pdo->query($query);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;

    }catch (PDOException $e) {
    // Gestion des erreurs de la base de données
    echo "Erreur : " . $e->getMessage();
    return false; // Retourner faux si la mise à jour a échoué
    }
}
function getDateAvant($date) {
    $mois = date("m", strtotime($date));
    $annee = date("Y", strtotime($date));
    $moisAvant = getMoisAvant($mois);
    if ($moisAvant<$mois) {
        // Utilisation de la fonction mktime pour créer une date
        $date = mktime(0, 0, 0, $moisAvant, 1, $annee);
        $dateFormatee = date("Y-m-d", $date);
    }else {
        $date = mktime(0, 0, 0, $moisAvant[0]["mois"], 1, $annee-1);
        $dateFormatee = date("Y-m-d", $date);
    }
    return $dateFormatee;
}

function getDateApres($date) {
    $mois = date("m", strtotime($date));
    $annee = date("Y", strtotime($date));
    $moisAvant['mois'] = getMoisApres($mois);
    if ($moisAvant<$mois) {
        // Utilisation de la fonction mktime pour créer une date
        $date = mktime(0, 0, 0, $moisAvant, 1, $annee+1);
        $dateFormatee = date("Y-m-d", $date);
    }else {
        $date = mktime(0, 0, 0, $moisAvant[0]["mois"], 1, $annee);
        $dateFormatee = date("Y-m-d", $date);
    }
    return $dateFormatee;
}



function getPoidsRestant( $datemax,$numParcelle)
{
// Paramètres de connexion à la base de données
$connexion = get_connexion();
try {
    // Connexion à la base de données

    // Paramétrer PDO pour afficher les erreurs
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Création d'un objet DateTime à partir de la date existante
    $dateObj = new DateTime($datemax);

    // Obtention de l'année et du mois de la date existante
    $mois = $dateObj->format('m');

    // Création d'une nouvelle date avec le jour '01', le mois et l'année de la date existante
    $datemin = getDateAvant($datemax);
    // $numParcelle=0;
    // var_dump($datemin);
    if($numParcelle==0){
        // Requête SQL
        $requete = "SELECT sum(totalFeuille) - (
            SELECT SUM(poidsCueilli)
            FROM cueillette
            WHERE dt >= :datemin AND dt <= :datemax
        ) AS feuilleRestant
        FROM v_poidstotalparparcelle";

    }else {
        $requete = "SELECT totalFeuille - (
            SELECT SUM(poidsCueilli)
            FROM cueillette
            WHERE dt >= :datemin AND dt <= :datemax
        ) AS feuilleRestant
        FROM v_poidstotalparparcelle where numParcelle = :numParcelle";
    }
    // var_dump($requete);

    // Préparation de la requête
    $statement = $connexion->prepare($requete);

    // Remplacement des paramètres de la requête
    $statement->bindParam(':datemin', $datemin);
    $statement->bindParam(':datemax', $datemax);
    if ($numParcelle!=0) {
        $statement->bindParam(':numParcelle', $numParcelle);
    }

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

// $numParcelle=0;
// var_dump(getPoidsRestant("2024-02-03",$numParcelle));

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
// // Exemple d'utilisation de la fonction
// $nomCueilleur = "1";
// $occupation = 12;
// // $rendement = 1;

// insertSalaire($nomCueilleur,$occupation);




?>