<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tableau Affichage Promotions</title>
    <link href="css/styles.css" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper">

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Promotion</h1>

<?php
include 'connexion.php';

$promotion = isset($_GET['promo']) ? $_GET['promo'] : null;

$sql = "
    SELECT 
        u.id_users,
        u.name,
        u.surname,
        u.mail,
        p.name AS promotion_name
    FROM users u
    JOIN promotions p ON u.id_promotions = p.id_promotions
";

if ($promotion) {
    $sql .= " WHERE u.id_promotions = ?";
    $requete = $path->prepare($sql);
    $requete->execute([$promotion]);
} else {
    $requete = $path->prepare($sql);
    $requete->execute();
}

$resultat = $requete->fetchAll();
?>

<!-- Dropdown -->
<div class="dropdown mb-3">
  <button class="btn btn-secondary dropdown-toggle" type="button"
          data-bs-toggle="dropdown" aria-expanded="false">
    Sélectionner la promotion

  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="?promo=2">SLAMTP1</a></li>
    <li><a class="dropdown-item" href="?promo=3">SLAMTP2</a></li>
    <li><a class="dropdown-item" href="?promo=4">SISRTP1</a></li>
    <li><a class="dropdown-item" href="?promo=5">SISRTP2</a></li>
    <li><a class="dropdown-item" href="?promo=6">SLAMALT1</a></li>
    <li><a class="dropdown-item" href="?promo=7">SLAMALT2</a></li>
    <li><a class="dropdown-item" href="?promo=8">SISRALT1</a></li>
    <li><a class="dropdown-item" href="?promo=9">SISRALT2</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="?">Toutes les promotions</a></li>
  </ul>
  </button>
</div>


<!-- Tableau -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des étudiants</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Courriel</th>
                        <th>Promotion</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($resultat as $eleves): ?>
                    <tr>
                        <td><?= $eleves['id_users'] ?></td>
                        <td><?= $eleves['name'] ?></td>
                        <td><?= $eleves['surname'] ?></td>
                        <td><?= $eleves['mail'] ?></td>
                        <td><?= $eleves['promotion_name'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

</div>
</div>

<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>

</body>
</html>
