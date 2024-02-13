<?php
// Inclure le fichier fonction.php
include "../inc/fonction.php"; 

// Vérifier si les données du formulaire ont été envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si la page est définie
    if (isset($_POST['page'])) {
        $page = $_POST['page'];

        // Ajout ou modification d'un cueilleur
        if ($page === "cueilleur") {
            if (isset($_POST['nomCueilleur'])) {
                $nomCueilleur = $_POST['nomCueilleur'];

                // Vérifier si le nom du cueilleur n'est pas vide
                if (!empty($nomCueilleur)) {
                    // Si l'ID du cueilleur est défini, alors c'est une modification, sinon c'est un ajout
                    if (isset($_POST['idCueilleur'])) {
                        $idCueilleur = $_POST['idCueilleur'];
                        // Modifier le cueilleur dans la base de données
                        $result = updateElement("cueilleur", ["nomCueilleur"], [$nomCueilleur], "id", $idCueilleur);
                    } else {
                        // Insérer le cueilleur dans la base de données
                        $result = insertElement("cueilleur", ["nomCueilleur"], [$nomCueilleur]);
                    }

                    // Vérifier si l'opération a réussi
                    if ($result) {
                        // Si l'opération a réussi, renvoyer un message de succès
                        echo 'true';
                    } else {
                        // Si l'opération a échoué, renvoyer un message d'erreur
                        echo 'false';
                    }
                } else {
                    // Si le nom du cueilleur est vide, renvoyer un message d'erreur
                    echo 'false';
                }
            } else {
                // Si le nom du cueilleur n'est pas défini, renvoyer un message d'erreur
                echo 'false';
            }
        } else {
            // Si la page n'est pas cueilleur, renvoyer un message d'erreur
            echo 'false';
        }
    } else {
        // Si la page n'est pas définie, renvoyer un message d'erreur
        echo 'false';
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Si la méthode de requête est GET
    if (isset($_GET['idCueilleur'])) {
        // Vérifier si l'ID du cueilleur est défini
        $idCueilleur = $_GET['idCueilleur'];
        
        // Récupérer les données du cueilleur
        $cueilleur = recupererElementParID("cueilleur", $idCueilleur);
        
        // Vérifier si le cueilleur existe
        if ($cueilleur) {
            // Retourner les données du cueilleur au format JSON
            echo json_encode($cueilleur);
        } else {
            // Si le cueilleur n'existe pas, renvoyer une réponse vide
            echo json_encode([]);
        }
    } else {
        // Si l'ID du cueilleur n'est pas défini, renvoyer une réponse vide
        echo json_encode([]);
    }
}
?>
