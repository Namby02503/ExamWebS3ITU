<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min-1.css">

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <link href="../assets/css/index_principal.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                       
       <form action="traitement.php" method="post">
            <div class="mois">
                <h4 style="color: green; text-align: center;">Regénération du thé</h4>
                <div class="row">
                    <div class="col-md-4">
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="janvier" name="mois[]" value="janvier">
                <label class="form-check-label" for="janvier">Janvier</label>
                </div>
            </div>
            <div class="col-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="fevrier" name="mois[]" value="fevrier">
                <label class="form-check-label" for="fevrier">Février</label>
            </div>
        </div>
            <div class="col-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="mars" name="mois[]" value="mars">
                <label class="form-check-label" for="mars">Mars</label>
            </div>
        </div>
    </div>
    <br>
</br>

<div class="row">
    <div class="col-md-4">

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="avril" name="mois[]" value="avril">
                <label class="form-check-label" for="avril">Avril</label>
            </div>
        </div>
    <div class="col-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="mai" name="mois[]" value="mai">
                <label class="form-check-label" for="mai">Mai</label>
            </div>
        </div>
    <div class="col-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="juin" name="mois[]" value="juin">
                <label class="form-check-label" for="juin">Juin</label>
            </div>
        </div>
    </div>
    <br>
</br>

<div class="row">
    <div class="col-md-4">

      <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="juillet" name="mois[]" value="juillet">
                <label class="form-check-label" for="juillet">Juillet</label>
            </div>
        </div>
                <div class="col-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="aout" name="mois[]" value="aout">
                <label class="form-check-label" for="aout">Aout</label>
            </div>
        </div>
    <div class="col-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="septembre" name="mois[]" value="septembre">
                <label class="form-check-label" for="septembre">Septembre</label>
            </div>
        </div>
    </div>
    <br>
</br>
<input type="hidden" name="page" value="regenerThe">
    <div class="row">
        <div class="col-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="octobre" name="mois[]" value="octobre">
                <label class="form-check-label" for="octobre">Octobre</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="novembre" name="mois[]" value="novembre">
                <label class="form-check-label" for="novembre">Novembre</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="decembre" name="mois[]" value="decembre">
                <label class="form-check-label" for="decembre">Décembre</label>
            </div>
        </div>
    </div>
            <br/>
            <button class="btn btn-success btn-block" type="submit" style="width: 40%; text-align:center; margin-left: 25%;">Sauvegarder</button>
            </div>
        </form>
                   </div>
                </div>
            </div>
    </div>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>