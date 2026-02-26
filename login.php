<?php
session_start();

require_once "connexion.php";

$username = $_POST['surname'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    try {
        $stmt = $path->prepare("SELECT * FROM users WHERE surname = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['surname'];
            echo "Connexion réussie !";
        } else {
            echo "Mot de passe incorrect.";
        }

    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
} else {
    echo "Veuillez fournir un mail et un mot de passe.";
}