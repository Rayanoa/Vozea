<?php
session_start();
require_once "connexion.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['surname'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        try {
            $stmt = $path->prepare("SELECT * FROM users WHERE surname = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $user['surname'];

                    header("Location: index.php");
                    exit();
                } else {
                    $message = "Mot de passe incorrect.";
                }
            } else {
                $message = "Utilisateur introuvable.";
            }
        } catch (PDOException $e) {
            $message = "Erreur SQL : " . $e->getMessage();
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Login</title>
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
        .card { width: 100%; max-width: 400px; }
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
        <div class="card shadow-lg p-4">
            <h2 class="text-center mb-4">Connexion</h2>

            <?php if ($message): ?>
                <div class="alert alert-info">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group mb-3">
                    <input type="text" name="surname" class="form-control" placeholder="Nom" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
        </div>
    </div>

</div>

</body>
</html>