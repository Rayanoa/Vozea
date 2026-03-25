<?php
include 'connexion.php';

// Requête pour récupérer les TP
$sql = "SELECT id_tp, name, description FROM tp";
$requete = $path->prepare($sql);
$requete->execute();

$resultat = $requete->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des TP</title>
    <link href="css/styles.css" rel="stylesheet">

    <style>
        body, html { margin: 0; padding: 0; height: 100%; font-family: Arial, sans-serif; }
        .wrapper { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            margin: 0;
            padding: 0;
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

        /* Card */
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
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

        th {
            background-color: #6B7ABE;
            color: white;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <?php include __DIR__ . '/navbar.php'; ?>
    </div>

    <!-- Contenu -->
    <div class="main-content">
        <h1>Liste des TP</h1>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du TP</th>
                        <th>Description</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($resultat as $tp): ?>
                    <tr>
                        <td><?= htmlspecialchars($tp['id_tp']) ?></td>
                        <td><?= htmlspecialchars($tp['name']) ?></td>
                        <td><?= htmlspecialchars($tp['description']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>

</div>

</body>
</html>