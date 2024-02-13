<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
    .sidebar {
      position: fixed;
      top: 60px;
      left: 0;
      bottom: 0;
      width: 350px;
      z-index: 996;
      transition: all 0.3s;
      padding: 20px;
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: #aab7cf transparent;
      box-shadow: 0px 0px 20px rgba(1, 41, 112, 0.1);
      background-color: #fff;
      background-image: url('../assets/images/test1.jpg');
      background-size: cover;
      background-position: center;
    }
    .sidebar-nav .nav-link {
  display: block;
  color: #333; /* Couleur du texte */
  text-decoration: none; /* Supprimer la décoration du texte */
  transition: background-color 0.3s ease; /* Transition pour l'effet de survol */
  /* border: 1px solid #006400; */ /* Retirer le cadre autour du lien */
  border-radius: 5px; /* Ajouter une bordure arrondie */
  margin-bottom: 10px; /* Espacement entre chaque lien */
}
.adminbtn {
  display: block;
  color: #006400; /* Couleur du texte verte */
  text-decoration: none; /* Supprimer la décoration du texte */
  transition: color 0.3s ease; /* Transition pour l'effet de survol */
  margin-bottom: 30px; /* Espacement entre chaque lien */
  margin-right:30px;
  font-size: 20px; /* Alignement du texte à droite */
}
.adminbtn:hover {
  color: #004d00; /* Couleur du texte verte plus foncée au survol */
}

  </style>
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="adminbtn" href="#" data-page="variete_the.php">
          <i class="bi bi-grid"></i>
          <span>Gestion de Variete de the</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="adminbtn" href="#" data-page="parcelle.php">
          <i class="bi bi-type"></i>
          <span>Gestion des parcelles</span>
        </a>
      </li><!-- End Fonts Nav -->
      <li class="nav-item">
        <a class="adminbtn" href="#" data-page="cueilleur.php">
          <i class="bi bi-type"></i>
          <span>Gestion des cueilleurs</span>
        </a>
      </li><!-- End Fonts Nav -->
      <li class="nav-item">
        <a class="adminbtn" href="#" data-page="CategorieDepense.php">
          <i class="bi bi-type"></i>
          <span>Depense</span>
        </a>
      </li><!-- End Fonts Nav -->
      <li class="nav-item">
        <a class="adminbtn" href="#" data-page="ConfigurationSalaire.php">
          <i class="bi bi-type"></i>
          <span>Salaire des cueilleurs</span>
        </a>
      </li><!-- End Fonts Nav -->
      <li class="nav-item">
        <a class="adminbtn" href="#" data-page="ConfigurationMois.php">
          <i class="bi bi-type"></i>
          <span>Configuration Mois</span>
        </a>
      </li><!-- End Fonts Nav -->
      <li class="nav-item">
        <a class="adminbtn" href="#" data-page="ConfigurationElement.php">
          <i class="bi bi-type"></i>
          <span>Configuration Element</span>
        </a>
      </li><!-- End Fonts Nav -->
      <li class="nav-item">
        <a class="adminbtn" href="#" data-page="PrixDeVente.php">
          <i class="bi bi-type"></i>
          <span>Prix de Vente</span>
        </a>
      </li><!-- End Fonts Nav -->
    
    </ul>
  </aside><!-- End Sidebar -->

  <!-- ======= Main Content ======= -->
  <main id="main">
    <div id="pageContent" class="container">
      <!-- Contenu de la page chargé dynamiquement -->
      <?php
if (isset($_GET["repvariete"])) {
  echo "<script>alert('" . $_GET["repvariete"] . "');</script>";
  if (isset($_GET["page"]) &&$_GET["page"]!="") {
    $page = htmlspecialchars($_GET["page"], ENT_QUOTES);
    include_once("$page.php");
}
}
?>
    </div>
  </main>

  <!-- Scripts -->
  <script>
    // Récupération de tous les liens de la barre de navigation
    var navLinks = document.querySelectorAll('.adminbtn');

    // Ajout d'un écouteur d'événement à chaque lien
    navLinks.forEach(function(link) {
      link.addEventListener('click', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du lien

        // Obtenir le nom de la page à charger depuis l'attribut data-page
        var pageName = this.getAttribute('data-page');

        // Charger la page spécifiée dans la zone de contenu principale
        fetch(pageName)
          .then(response => response.text())
          .then(html => {
            document.getElementById('pageContent').innerHTML = html;
          })
          .catch(error => console.error('Error loading page:', error));
      });
    });
  </script>


</body>

</html>