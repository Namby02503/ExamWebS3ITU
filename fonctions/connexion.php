<?php 
function get_connexion(){
    $hostname = 'localhost'; // Remplacez par le nom d'hôte de votre serveur MySQL
    $database = 'the'; // Remplacez par le nom de votre base de données
    $username = 'root'; // Remplacez par le nom d'utilisateur de votre base de données
    $password = ''; // Remplacez par le mot de passe de votre base de données
    $connexion = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    return $connexion;
}
?>