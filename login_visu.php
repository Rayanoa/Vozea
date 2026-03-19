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
</head>

<body class="bg-gradient-primary">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-9">

            <div class="card shadow-lg my-5">
                <div class="card-body p-5">

                    <div class="text-center">
                        <h1 class="h4 mb-4">Connexion</h1>
                    </div>

                    <?php if ($message): ?>
                        <div class="alert alert-info">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="form-group">
                            <input type="text" name="surname"
                                   class="form-control"
                                   placeholder="Nom" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="password"
                                   class="form-control"
                                   placeholder="Mot de passe" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            Se connecter
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>