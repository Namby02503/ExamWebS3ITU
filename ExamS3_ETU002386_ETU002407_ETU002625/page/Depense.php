<?php 
include "../inc/fonction.php"; 
$donnees=recupererDonneesTable("categorieDepense",null);
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
              <h5 class="card-title text-center pb-0 fs-4">Saisie de depense</h5>
            </div>
            <div class="form-group">
                <label for="">Categorie de depense</label>
                <select name="idCategorieDep" class="form-select" required>
                  <option value="">Sélectionner une categorie des depenses</option>
                  <?php foreach ($donnees as $donnee): ?>
                    <option value="<?php echo $donnee['id']; ?>"><?php echo $donnee['libelle']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Veuillez sélectionner une categorie de depense</div>
              </div>

            <form class="needs-validation" novalidate>
              <div class="form-group">
                <label for="">Montant</label>
                <input type="number" name="montant" class="form-control" required>
                <div class="invalid-feedback">Entrer le montant de ce depense s'il vous plait</div>
              </div>

              <input type="hidden" name="page" value="depense">

              <div class="form-group">
                <label for="">Date:</label>
                <input type="date" name="daty" class="form-control" required>
                <div class="invalid-feedback">Veillez entrer la date</div>
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
