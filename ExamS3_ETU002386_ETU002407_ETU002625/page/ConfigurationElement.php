
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
                <label for="">Poids minimale journalier pour un cueilleur</label>
                <input type="number" name="poidsMin" class="form-control" required>
                <div class="invalid-feedback">Entrer le Poids minimale journalier pour un cueilleur s'il vous plait</div>
              </div>
              <div class="form-group">
                <label for="">bonus pour le poids superieueur (en %)</label>
                <input type="number" name="poucentageBonus" class="form-control" required>
                <div class="invalid-feedback">Entrer le bonus pour le poids superieueur (en %) s'il vous plait</div>
              </div>
              <div class="form-group">
                <label for="">mallus pour le poids superieueur (en %)</label>
                <input type="number" name="pourcentageMalus" class="form-control" required>
                <div class="invalid-feedback">Entrer le mallus pour le poids superieueur (en %) s'il vous plait</div>
              </div>
              <div class="form-group">
                <label for="">Date</label>
                <input type="date" name="dt" class="form-control" required>
                <div class="invalid-feedback">Entrer le date s'il vous plait</div>
              </div>
              <input type="hidden" name="page" value="ConfigurationElement">

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
