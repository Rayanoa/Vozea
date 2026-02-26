<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    die("Accès refusé. Veuillez vous connecter.");
}

echo "Bienvenue " . htmlspecialchars($_SESSION['surname']) . " sur la page protégée !";