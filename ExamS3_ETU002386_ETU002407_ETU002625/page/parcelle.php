<?php 
include "../inc/fonction.php"; 
$donnees=recupererDonneesTable("varieteThe",null);
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
</head>
<body>
  <form action="traitement.php" method="post">
    <main>
      <div class="container">

        <div class="card mb-3">
          <div class="card-body">
            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Gestion des Parcelles</h5>
            </div>

            <form class="needs-validation" novalidate>
              <div class="form-group">
                <label for="">Numero du Parcelle (exemple:parcelle 1)</label>
                <input type="text" name="numParcelle" class="form-control" required>
                <div class="invalid-feedback">Entrer le numero de parcelle s'il vous plait</div>
              </div>

              <input type="hidden" name="page" value="parcelle">

              <div class="form-group">
                <label for="">Surface de parcelle en hectare</label>

                <input type="text" name="surface" class="form-control" required>
                <div class="invalid-feedback">Veillez entrer la surface</div>
              </div>

              <div class="form-group">
                <label for="">Variété du thé</label>
                <select name="idVariete" class="form-select" required>
                  <option value="">Sélectionner une variété</option>
                  <?php foreach ($donnees as $donnee): ?>
                    <option value="<?php echo $donnee['id']; ?>"><?php echo $donnee['nomVariete']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Veuillez sélectionner une variété</div>
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
</body>
</html>
