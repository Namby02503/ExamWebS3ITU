<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title></title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <style>
    /* Ajout de styles CSS personnalisés */
    .taille{
      width:100%;
      height:30%;
    }
  </style>
</head>

<body>
  <form action="traitement.php" method="post">
    <main>
      <div class="container" style="margin-rigth:300px;">

                <div class="card mb-12" style="margin-left: 40px;" >

                <div class="card-body" >
                <div class="taille">

                <div class="pt-4 pb-2" >
                      <h5 class="card-title text-center pb-0 fs-4">Gestion de Varieté de thé</h5>
                    </div>

                    <form class="row g-3 needs-validation" novalidate>

                      <div class="col-12 d-flex justify-content-center" style="margin-bottom: 30px;">
                        <label for="" class="form-label">Nom du varieté</label>
                        <div class="input-group has-validation">
                          <input type="text" name="nomVariete" class="form-control" id="" required>
                          <div class="invalid-feedback">Entrer le nom s'il vous plait</div>
                        </div>
                      </div>
                     <input type="hidden" name="page" value="variete">
                      <div class="col-12 d-flex justify-content-center" style="margin-bottom: 30px;">
                        <label for="" class="form-label">Son occupation </label>
                        <input type="text" name="occupation" class="form-control" id="" required>
                        <div class="invalid-feedback">Veillez entrer l'occupation</div>
                      </div>
                      <div class="col-12 d-flex justify-content-center" style="margin-bottom: 30px;">
                        <label for="" class="form-label">Rendement (kg)</label>
                        <input type="text" name="rendement" class="form-control" id="" required>
                        <div class="invalid-feedback">Veillez entrer le kg de Rendement</div>
                      </div>


                      <div class="col-12 d-flex justify-content-center" style="margin-bottom: 50px;">
                  <button class="btn btn-success btn-lg" type="submit" style="margin-top: 20px;">Valider</button>
                    </div>
  </form>

             
                  </div>
      
              </div>
           

              </div>      
      </div>
    </main>
  </form>
</body>

</html>
