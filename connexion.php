<?php

try {
    $path = new PDO(
        'mysql:host=localhost;dbname=vozea;charset=utf8',
        'user_vozea',
        'Vozea_tp'
    );
    $path->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    $_SESSION['erreur_type'] = "connexion";
    $_SESSION['erreur_message'] = $e->getMessage();
    header("Location: erreur.php");
    exit;
}
?>