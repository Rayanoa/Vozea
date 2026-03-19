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

$promos = $path->query("SELECT id_promotions, name FROM promotions ORDER BY name")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un utilisateur</title>
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>

<h2>Ajouter un utilisateur</h2>

<?php if ($success): ?>
    <p style="color:green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">

    <label>Prénom :</label><br>
    <input type="text" name="name" required><br><br>

    <label>Nom :</label><br>
    <input type="text" name="surname" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="mail" required><br><br>

    <label>Promotion :</label><br>
    <select name="id_promotions" required>
        <option value="">-- Choisir une promotion --</option>
        <?php foreach ($promos as $promo): ?>
            <option value="<?= htmlspecialchars($promo['id_promotions']) ?>">
                <?= htmlspecialchars($promo['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Ajouter l'utilisateur</button>

</form>

</body>
</html>