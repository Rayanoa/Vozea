<?php
session_start();
require_once __DIR__ . "/connexion.php";

$success = "";
$error = "";

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $surname = trim($_POST['surname'] ?? '');
    $mail = trim($_POST['mail'] ?? '');
    $id_promotions = $_POST['id_promotions'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($name && $surname && $mail && $id_promotions && $password) {
        try {
            // Hash du mot de passe pour la sécurité
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $path->prepare("
                INSERT INTO users (name, surname, mail, id_promotions, password) 
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $name,
                $surname,
                $mail,
                $id_promotions,
                $hashedPassword
            ]);

            $success = "Utilisateur ajouté avec succès !";

        } catch (PDOException $e) {
            $error = "Erreur SQL : " . $e->getMessage();
        }

    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

// Récupérer toutes les promotions pour le dropdown
$promos = $path->query("SELECT id_promotions, name FROM promotions ORDER BY name")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un utilisateur</title>
    <link href="css/styles.css" rel="stylesheet">

    <style>
        body, html { height: 100%; margin: 0; font-family: Arial; }
        .wrapper { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar { width: 220px; background-color: #343a40; color: white; }
        .sidebar a { display: block; padding: 15px; color: white; text-decoration: none; }
        .sidebar a:hover { background-color: #495057; }

        /* Contenu principal */
        .main-content {
            flex: 1;
            padding: 50px;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card */
        .card {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        /* Inputs */
        .card input, .card select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* BOUTON */
        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #6B7ABE;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-primary:hover {
            background-color: #5a68a8;
            transform: translateY(-2px);
        }
    </style>
</head>
</head>
<body>

<div class="wrapper">

    <!-- Sidebar gauche -->
    <div class="sidebar">
        <?php include __DIR__ . '/navbar.php'; ?>
    </div>

    <!-- Contenu principal -->
    <div class="main-content">
        <div class="card">
            <h2 class="text-center mb-4">Ajouter un utilisateur</h2>

            <?php if ($success): ?>
                <p style="color:green;"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <?php if ($error): ?>
                <p style="color:red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="name" placeholder="Prénom" required>
                <input type="text" name="surname" placeholder="Nom" required>
                <input type="email" name="mail" placeholder="Email" required>

                <select name="id_promotions" required>
                    <option value="">-- Choisir une promotion --</option>
                    <?php foreach ($promos as $promo): ?>
                        <option value="<?= htmlspecialchars($promo['id_promotions']) ?>">
                            <?= htmlspecialchars($promo['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <input type="password" name="password" placeholder="Mot de passe" required>

                <button type="submit" class="btn-primary">Ajouter l'utilisateur</button>
            </form>
        </div>
    </div>

</div>

</body>
</html>