<?php
include "../inc/fonction.php"; 
$page=$_POST['page'];
if($page=="login"){
    $email=$_POST['email'];
    $mdp=$_POST['mdp'];
    $type=$_POST['type'];
    $id=checkLogin($email,$mdp,$type);
    if($id!=0){
        if($type=='A'){
            header("Location: side-bar-admin.php");
        }
        else if($type=='U'){
            header("Location: side-bar-Utilisateur.php");
        }
    }
    else{
        header("Location: login.php?eureur=Email ou mot de passe incorrect.");
    }
}
else if($page=="variete"){
    $nomVariete=$_POST['nomVariete'];
    $occupation=$_POST['occupation'];
    $rendement=$_POST['rendement'];
    $reponse=$resultat = insertElement("varieteThe",
        ["nomVariete", "occupation", "rendement"],
        [$nomVariete, $occupation, $rendement]);    
        header("Location: side-bar-admin.php?repvariete=" . urlencode($reponse) . "&page=variete_the");
      }
    else if($page=="parcelle"){
        $numParcelle=$_POST['numParcelle'];
        $surface=$_POST['surface'];
        $id=$_POST['idVariete'];
        $reponse=$resultat = insertElement("parcelle",
            ["numParcelle", "surface", "idVarieteThe"],
            [$numParcelle, $surface, $id]);    
            header("Location: side-bar-admin.php?repvariete=" . urlencode($reponse) . "&page=parcelle");
        }
        else if($page=="cueilleur"){
            $nomCueilleur=$_POST['nomCueilleur'];
            $reponse=$resultat = insertElement("cueilleur",
                ["nomCueilleur"],
                [$nomCueilleur]);    
                header("Location: side-bar-admin.php?repvariete=" . urlencode($reponse) . "&page=cueilleur");
            }
            else if($page=="categorieDepense"){
                $libelle=$_POST['libelle'];
                $reponse=$resultat = insertElement("categorieDepense",
                    ["libelle"],
                    [$libelle]);    
                    header("Location: side-bar-admin.php?repvariete=" . urlencode($reponse) . "&page=CategorieDepense");
                }
                else if($page=="ConfigurationSalaire"){
                    $salaire=$_POST['salaire'];
                    $idCueilleur=$_POST['idCueilleur'];
                    $reponse=$resultat = insertElement("salaireCueilleur",
                        ["salaire",  "idCueilleur"],
                        [$salaire, $idCueilleur]);    
                        header("Location: side-bar-admin.php?repvariete=" . urlencode($reponse) . "&page=ConfigurationSalaire");
                    } 
                    else if($page=="depense"){
                        $montant=$_POST['montant'];
                        $daty=$_POST['daty'];
                        $idCatDepense=$_POST['idCategorieDep'];
                        $reponse=$resultat = insertElement("depense",
                            ["montant",  "dt","idCatDepense"],
                            [$montant, $daty,$idCatDepense]);    
                            header("Location: side-bar-Utilisateur.php?repvariete=" . urlencode($reponse) . "&page=Depense");
                        }
                        else if($page=="Cueillette"){
                            $numParcelle=$_POST['numParcelle'];
                            $idCueilleur=$_POST['idCueilleur'];
                            $date=$_POST['date'];
                            $poidsCueilli=$_POST['poidsCueilli'];
                        
                            $poidsrestant=calculerFeuillesRestantes($date,$numParcelle);
                            $response = array();
                            if($poidsCueilli<$poidsrestant){
                            $reponse=$resultat = insertElement("cueillette",
                            ["numParcelle",  "idCueilleur","dt","poidsCueilli"],
                            [$numParcelle, $idCueilleur,$date,$poidsCueilli]);    
                            $response['success'] = true;
                        }
                         else {
                                // Si l'insertion a échoué, réponse "false"
                                $response['success'] = false;
                            }
                            
                            // Envoi de la réponse sous forme de JSON
                            header('Content-Type: application/json');
                            echo json_encode($response);    
                        }
                        else if($page=="ConfigurationElement"){
                            $poidsMin=$_POST['poidsMin'];
                            $poucentageBonus=$_POST['poucentageBonus'];
                            $pourcentageMalus=$_POST['pourcentageMalus'];
                            $dt=$_POST['dt'];
                            $reponse=$resultat = insertElement("proprietePaiement",
                            ["poidsMin",  "poucentageBonus","pourcentageMalus","dt"],
                            [$poidsMin, $poucentageBonus,$pourcentageMalus,$dt]);    
                            header("Location: side-bar-admin.php?repvariete=" . urlencode($reponse) . "&page=ConfigurationElement");
                        } else if($page=="PrixDeVente"){
                            $prixVente=$_POST['prixVente'];
                            $idVarieteThe=$_POST['idVarieteThe'];
                            $reponse=$resultat = insertElement("prixVenteParVarieteThe",
                            ["prixVente",  "idVarieteThe"],
                            [$prixVente, $idVarieteThe]);    
                            header("Location: side-bar-admin.php?repvariete=" . urlencode($reponse) . "&page=PrixDeVente");
                        } else if($page=="regenerThe"){
                            if (isset($_POST['mois'])) {
                                $moisSelectionnes = $_POST['mois'];
                            
                                // Faire quelque chose avec les valeurs sélectionnées, par exemple les afficher
                                foreach ($moisSelectionnes as $mois) {
                                    $moiss=$mois;
                                    $reponse=$resultat = insertElement("regenerationConfig",
                                    ["mois"],
                                    [$moiss]);    
                                    header("Location: side-bar-admin.php?repvariete=" . urlencode($reponse) . "&page=ConfigurationMois");
                                        }
                            } else {
                                echo "Aucune case à cocher sélectionnée.";
                            }
                        }
                            ?>
