<?php
// Inclure le fichier contenant les fonctions nécessaires
include "../inc/fonction.php"; 

// Récupérer les valeurs passées par la requête GET
if(isset($_POST['dmin']) && isset($_POST['dmax'])) {
    $dmin = $_POST['dmin'];
    $dmax = $_POST['dmax'];

    // Appeler les fonctions pour obtenir les données nécessaires
    $poidtotalCueillette = getPoidsTotalCueillette($dmin, $dmax);
    $poidrestant = getPoidsRestant($dmax, 0); // Assurez-vous de remplacer les paramètres en fonction de vos besoins
    $depense = getCoutTotal($dmin, $dmax);
    $coutRevient = getCoutDeRevient($poidtotalCueillette, $poidrestant, $depense);

    // Créer un tableau associatif avec les données à retourner
    $data = array(
        'poidtotalCueillette' => $poidtotalCueillette,
        'poidrestant' => $poidrestant,
        'coutRevient' => $coutRevient
    );

    // Retourner les données au format JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // Si les paramètres nécessaires ne sont pas passés, retourner une erreur
    echo json_encode(array("error" => "Missing parameters"));
}
?>
