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
  <style>
    /* Ajout de styles CSS personnalisés */
  </style>
</head>
<body>
<script>
      console.log("lasa");
  </script>
<form id="formCueilleur" method="post">
    <main>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Gestion de Cueilleur</h5>
                </div>
                <form class="needs-validation" novalidate>
                  <div class="form-group">
                    <label for="nomCueilleur">Nom du cueilleur</label>
                    <input type="text" name="nomCueilleur" class="form-control" id="nomCueilleur" required>
                    <div class="invalid-feedback">Entrez le nom s'il vous plaît</div>
                  </div>
                  <input type="hidden" name="page" value="cueilleur">
                  <div class="text-center">
                    <input type="submit" id="btnValider" class="btn btn-success btn-lg" value="Valider">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </form>

  <section class="p-2">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom du cueilleur</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="tbodydata">
      </tbody>
    </table>
  </section>

  <script>
    
    document.addEventListener('DOMContentLoaded', function() {
      actualiser(); // Charger les données initiales
      
      document.getElementById('btnValider').addEventListener('click', function() {
        var nomCueilleur = document.getElementById('nomCueilleur').value;
        var form = new FormData();
        form.append('nomCueilleur', nomCueilleur);
        form.append('page', 'cueilleur');

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              console.log('Données insérées avec succès.');
              actualiser(); // Actualiser les données après l'insertion
            } else {
              console.error('Une erreur est survenue lors de l\'insertion : ' + xhr.status);
            }
          }
        };
        xhr.open('POST', 'traitementCeilleur.php', true);
        xhr.send(form);
      });
    });

    function actualiser() {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var cueilleurs = JSON.parse(xhr.responseText);
            afficherCueilleurs(cueilleurs);
          } else {
            console.error('Une erreur est survenue lors de la récupération des données : ' + xhr.status);
          }
        }
      };
      xhr.open('GET', 'traitementCeilleur.php', true);
      xhr.send();
    }

    function afficherCueilleurs(cueilleurs) {
      var tableBody = document.getElementById('tbodydata');
      tableBody.innerHTML = '';
      cueilleurs.forEach(function(cueilleur) {
        var row = tableBody.insertRow(-1);
        var cellId = row.insertCell(0);
        var cellNomCueilleur = row.insertCell(1);
        var cellAction = row.insertCell(2);
        cellId.textContent = cueilleur.id;
        cellNomCueilleur.textContent = cueilleur.nomCueilleur;
        var btnSupprimer = document.createElement('button');
        btnSupprimer.textContent = 'Supprimer';
        btnSupprimer.addEventListener('click', function() {
          supprimerCueilleur(cueilleur.id);
        });
        cellAction.appendChild(btnSupprimer);
        var btnModifier = document.createElement('button');
        btnModifier.textContent = 'Modifier';
        btnModifier.addEventListener('click', function() {
          modifierCueilleur(cueilleur.id);
        });
        cellAction.appendChild(btnModifier);
      });
    }

    function supprimerCueilleur(idCueilleur) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log('Cueilleur supprimé avec succès.');
            actualiser(); // Actualiser les données après la suppression
          } else {
            console.error('Une erreur est survenue lors de la suppression du cueilleur : ' + xhr.status);
          }
        }
      };
      xhr.open('POST', 'traitementCeilleur.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('idCueilleur=' + idCueilleur);
    }

    function modifierCueilleur(idCueilleur) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var donnee = JSON.parse(xhr.responseText);
            modifierFormulaire(donnee); // Afficher le formulaire de modification
            console.log(donnee);
            actualiser(); // Actualiser les données après la modification
          } else {
            console.error('Une erreur est survenue lors de la récupération des données pour la modification : ' + xhr.status);
          }
        }
      };
      xhr.open('GET', 'traitementCeilleur.php?idCueilleur=' + idCueilleur, true);
      xhr.send();
    }

   
</script>