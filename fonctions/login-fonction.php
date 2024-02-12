<?php
include "connexion.php"; 
    function checkLogin($email,$mdp,$type) {
        $con = get_connexion();
        $sql = "select id from personne where email = '$email' and mdp = '$mdp' and type = '$type'";
        $q = $con -> query($sql);
        $result = $q -> fetch(PDO::FETCH_ASSOC);
        $id = 0;
        if ($result) {
            $id = $result['id'];
        }   
        return $id;
    }

    var_dump(checkLogin("alice.smith@example.com","motdepasse","A"));

?>

