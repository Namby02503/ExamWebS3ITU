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
function filterData() {
    var dmin = document.getElementById("min").value;
    var dmax = document.getElementById("max").value;

    var formData = new FormData();
    formData.append('dmin', dmin);
    formData.append('dmax', dmax);

    var xhr;
    try {
        xhr = new XMLHttpRequest();
    } catch (e) {
        console.error("Erreur lors de la création de l'objet XMLHttpRequest : " + e.message);
        return;
    }
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                // Utilisez les données de la réponse pour mettre à jour votre page
                var poidtotalCueillette = response.poidtotalCueillette;
                var poidrestant = response.poidrestant;
                var coutRevient = response.coutRevient;

                var tbodydata = document.getElementById("tbodydata");
                tbodydata.innerHTML = '';

                var tr = document.createElement("tr");
                var td1 = document.createElement("td");
                td1.textContent = poidtotalCueillette;
                var td2 = document.createElement("td");
                td2.textContent = poidrestant;
                var td3 = document.createElement("td");
                td3.textContent = coutRevient;

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);

                tbodydata.appendChild(tr);
            } else {
                console.error("Erreur lors de la requête AJAX : " + xhr.status);
            }
        }
    };
    xhr.open("POST", "script.php", true);
    xhr.send(formData);
}
</script>

<div class="card col-12 p-0">
    <header class="d-flex flex-row justify-content-between align-items-center">
        <span style="font-size: 30px">Resultat global:</span>
        <span class="col-10 d-flex gap-2 justify-content-evenly align-items-center">
            <label for="min">Date Min:</label>
            <input type="date" id="min" name="datmin" class="form-control" >
            <label for="max">Date Max:</label>
            <input type="date" id="max" name="datmax" class="form-control" >
            <input type="button"  id="filtre" value="Filter" onclick="filterData()">
        </span>
    </header>
    <section class="p-2">
        <table class="table">
            <thead>
            <tr>
                <th>Poids total cueillette</th>
                <th>Poid total restant sur tous les parcelles</th>
                <th>Cout de revient /kg</th>
            </tr>
            </thead>
            <tbody id="tbodydata">
            </tbody>
        </table>
    </section>
</div>

</body>
</html>
