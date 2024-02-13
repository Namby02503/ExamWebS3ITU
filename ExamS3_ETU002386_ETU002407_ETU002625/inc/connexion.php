<?php 
function get_connexion(){
    $hostname = '172.20.0.167'; // Remplacez par le nom d'hôte de votre serveur MySQL
    $database = 'db_p16_ETU002625'; // Remplacez par le nom de votre base de données
    $username = 'ETU002625'; // Remplacez par le nom d'utilisateur de votre base de données
    $password = 'lGdasqAFZ6nT'; // Remplacez par le mot de passe de votre base de données
    $connexion = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    return $connexion;
}

$dateExistante = "2024-02-12"; // Format : Y-m-d

// Création d'un objet DateTime à partir de la date existante
$dateObj = new DateTime($dateExistante);

// Obtention de l'année et du mois de la date existante
$annee = $dateObj->format('Y');
$mois = $dateObj->format('m');

// Création d'une nouvelle date avec le jour '01', le mois et l'année de la date existante
$nouvelleDate = new DateTime("$annee-$mois-01");

?>