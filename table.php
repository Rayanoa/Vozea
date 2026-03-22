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
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tableau Affichage Promotions</title>
    <link href="css/styles.css" rel="stylesheet">
    <style>
        body, html { margin: 0; height: 100%; font-family: Arial, sans-serif; }
        .wrapper { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }

        /* Contenu principal */
        .main-content {
            flex: 1;
            padding: 30px;
            background-color: #f8f9fa;
        }

        /* Card + table */
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .dropdown {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<div class="wrapper">

    <!-- Sidebar gauche -->
    <div class="sidebar">
        <?php include __DIR__ . '/navbar.php'; ?>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <h1 class="h3 mb-2 text-gray-800">Promotions</h1>

        <!-- Dropdown -->
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sélectionner la promotion
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="?promo=2">SLAMTP1</a>
            <a class="dropdown-item" href="?promo=3">SLAMTP2</a>
            <a class="dropdown-item" href="?promo=4">SISRTP1</a>
            <a class="dropdown-item" href="?promo=5">SISRTP2</a>
            <a class="dropdown-item" href="?promo=6">SLAMALT1</a>
            <a class="dropdown-item" href="?promo=7">SLAMALT2</a>
            <a class="dropdown-item" href="?promo=8">SISRALT1</a>
            <a class="dropdown-item" href="?promo=9">SISRALT2</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="?">Toutes les promotions</a>
          </div>
        </div>

        <!-- Tableau -->
        <div class="card">
            <h6 class="m-0 font-weight-bold text-primary mb-3">Liste des étudiants</h6>
            <div class="table-responsive">
                <table>
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
                            <td><?= htmlspecialchars($eleves['id_users']) ?></td>
                            <td><?= htmlspecialchars($eleves['name']) ?></td>
                            <td><?= htmlspecialchars($eleves['surname']) ?></td>
                            <td><?= htmlspecialchars($eleves['mail']) ?></td>
                            <td><?= htmlspecialchars($eleves['promotion_name']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<!-- Scripts Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>