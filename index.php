<?php
session_start();
include 'connexion.php';

// Comptage des données
$nbUsers = $path->query("SELECT COUNT(*) FROM users")->fetchColumn();
$nbTP = $path->query("SELECT COUNT(*) FROM tp")->fetchColumn();
$nbTasks = $path->query("SELECT COUNT(*) FROM tasks")->fetchColumn();

// Infos utilisateur
$nom = $_SESSION['surname'] ?? 'Nom';
$prenom = $_SESSION['name'] ?? 'Prénom';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="css/styles.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fc;
        }

        .wrapper {
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: #6B7ABE;
            min-height: 100vh;
            color: white;
            box-sizing: border-box;
        }

        /* Navbar incluant le badge prénom/nom */
        .sidebar .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar .user-badge {
            background-color: #ffffffaa;
            padding: 15px 20px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .sidebar .user-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        }

        .sidebar .user-badge .firstname {
            display: block;
            font-size: 1.6rem;
            font-weight: bold;
            color: #343a40;
            font-family: 'Georgia', serif;
        }

        .sidebar .user-badge .surname {
            display: block;
            font-size: 1.2rem;
            color: #6b7abe;
            margin-top: 2px;
        }

        /* Liens de navigation */
        .sidebar .nav-links {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .sidebar .nav-links .nav-item {
            display: block;
            background-color: #6B7ABE;
            color: #fff;
            text-decoration: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: bold;
            font-size: 1.1rem;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .sidebar .nav-links .nav-item:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        /* Contenu principal */
        .main {
            flex: 1;
            padding: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* Cartes */
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        /* Tableau */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #6B7ABE;
            color: white;
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
      
    <div class="sidebar">
        <?php include __DIR__ . '/navbar.php'; ?>
    </div>

    <!-- CONTENU PRINCIPAL -->
    <div class="main">

        <div class="topbar">
            <h2>Tableau de bord</h2>
            <div>
                <?= htmlspecialchars($prenom) ?> <?= htmlspecialchars($nom) ?>
            </div>
        </div>

        <!-- Cartes -->
        <div class="cards">
            <div class="card">
                <h3>Utilisateurs</h3>
                <p><?= $nbUsers ?></p>
            </div>

            <div class="card">
                <h3>TP</h3>
                <p><?= $nbTP ?></p>
            </div>

            <div class="card">
                <h3>Tâches</h3>
                <p><?= $nbTasks ?></p>
            </div>
        </div>

        <!-- Tableau -->
        <div class="card">
            <h3>Derniers TP</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                </tr>

                <?php
                $tps = $path->query("SELECT * FROM tp ORDER BY id_tp DESC LIMIT 5")->fetchAll();
                foreach ($tps as $tp):
                ?>
                <tr>
                    <td><?= $tp['id_tp'] ?></td>
                    <td><?= htmlspecialchars($tp['name']) ?></td>
                    <td><?= htmlspecialchars($tp['description']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

    </div>
</div>

</body>
</html>