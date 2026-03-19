<?php
session_start();
require_once __DIR__ . "/connexion.php";

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $id_promotions = $_POST['id_promotions'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($name && $surname && $mail && $id_promotions && $password) {

        try {
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

// Récupération des promotions
$promos = $path->query("SELECT id_promotions, name FROM promotions ORDER BY name")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un utilisateur</title>
    <link href="css/styles.css" rel="stylesheet">
    <style>
        body, html { height: 100%; margin: 0; }
        .wrapper { display: flex; min-height: 100vh; }
        /* Sidebar */
        .sidebar { width: 220px; background-color: #343a40; color: white; }
        .sidebar a { display: block; padding: 15px; color: white; text-decoration: none; }
        .sidebar a:hover { background-color: #495057; }
        /* Contenu principal */
        .main-content { flex: 1; padding: 50px; background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; }
        .card { width: 100%; max-width: 500px; padding: 30px; box-shadow: 0 0 15px rgba(0,0,0,0.2); background: white; border-radius: 10px; }
        .card input, .card select { width: 100%; padding: 10px; margin-bottom: 15px; }
        .card button { width: 100%; padding: 10px; }
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

                <button type="submit">Ajouter l'utilisateur</button>
            </form>
        </div>
    </div>

</div>

</body>
</html>