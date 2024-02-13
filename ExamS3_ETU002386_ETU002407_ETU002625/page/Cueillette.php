<?php 
include "../inc/fonction.php"; 
$donnees1=recupererDonneesTable("cueilleur",null);
$donnees2=recupererDonneesTable("parcelle",null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title></title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Ajout de Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<form id="cueilletteForm" method="post">
</head>
<body>
  <form id="cueilletteForm" method="post">
   <main>
      <div class="container">

        <div class="card mb-3">
          <div class="card-body">
            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Gestion des Parcelles</h5>
            </div>

            <form class="needs-validation" novalidate>
          
              <input type="hidden" name="page" value="Cueillette">

              <div class="form-group">
                <label for="">Parcelle</label>
                <select name="numParcelle" class="form-select" required>
                  <option value="">Sélectionner une parcelle</option>
                  <?php foreach ($donnees2 as $donnee): ?>
                    <option value="<?php echo $donnee['numParcelle']; ?>"><?php echo $donnee['numParcelle']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Veuillez sélectionner une parcelle</div>
              </div>
              <div class="form-group">
                <label for="">Ceuilleur</label>
                <select name="idCueilleur" class="form-select" required>
                  <option value="">Sélectionner une ceuilleur</option>
                  <?php foreach ($donnees1 as $donnee): ?>
                    <option value="<?php echo $donnee['id']; ?>"><?php echo $donnee['nomCueilleur']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Veuillez sélectionner une variété</div>
              </div>
              <div class="form-group">
                <label for="">Date</label>
                <input type="date" name="date" class="form-control" required>
                <div class="invalid-feedback">Entrer la date  s'il vous plait</div>
              </div>
              <div class="form-group">
                <label for="">Poids Cueillis</label>
                <input type="text" name="poidsCueilli" class="form-control" required>
                <div class="invalid-feedback">Entrer le poids Cueillis s'il vous plait</div>
              </div>

              <div class="form-group text-center">
                <button class="btn btn-success btn-lg" type="submit">Valider</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </main>
  </form>
  <script>
  $(document).ready(function() {
    $('#cueilletteForm').submit(function(event) {
      event.preventDefault(); // Empêche le comportement par défaut du formulaire
      
      // Récupération des données du formulaire
      var formData = $(this).serialize();
      
      // Envoi des données via AJAX
      $.ajax({
        type: 'POST',
        url: 'traitement.php',
        data: formData,
        success: function(response) {
          // Vérifie la réponse du serveur
          if (response === 'true') {
            // Si la réponse est true, affiche une alerte de succès
            alert('Insertion Cueillette réussie !');
          } else {
            // Si la réponse est false, affiche une alerte d'échec
            alert('Poids insuffisant,la parcelle ne contient  plus ces kg.');
          }
        }
      });
    });
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
