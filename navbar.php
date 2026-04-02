<?php
// sécurité : s'assurer que la session est bien démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar">
    <div class="welcome-section">
        <?php if (isset($_SESSION['loggedin'])) { ?>
            <div class="user-badge">
                <span class="firstname"><?= htmlspecialchars($_SESSION['name']) ?></span>
                <span class="surname"><?= htmlspecialchars($_SESSION['surname']) ?></span>
            </div>
        <?php } ?>
    </div>

    <div class="nav-links">
        <?php if (isset($_SESSION['loggedin'])) { ?>
            <!-- Visible uniquement si connecté -->
            <a href="table_tp.php" class="nav-item">Liste TP</a>
            <a href="graphics.php" class="nav-item">Graphiques</a>
            <a href="logout.php" class="nav-item logout">Déconnexion</a>
        <?php } else { ?>
            <!-- Visible uniquement si NON connecté -->
            <a href="login_visu.php" class="nav-item">Connexion</a>
        <?php } ?>

    </div>
</nav>

<style>
    :root {
        --bg-color: #99acff;
        --btn-color: #6b7abe;
        --text-color: #ffffff;
    }

    .navbar {
        background-color: var(--bg-color);
        padding: 20px;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        gap: 40px;
        width: 100%;
        box-sizing: border-box;
    }

    /* Badge utilisateur */
    .welcome-section {
        display: flex;
        justify-content: center;
    }

    .user-badge {
        background-color: #ffffffaa;
        padding: 15px 25px;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        text-align: center;
        width: fit-content;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .user-badge:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }

    .user-badge .firstname {
        display: block;
        font-size: 1.8rem;
        font-weight: bold;
        font-family: 'Georgia', serif;
        color: #343a40;
    }

    .user-badge .surname {
        display: block;
        font-size: 1.2rem;
        color: #6b7abe;
        margin-top: 2px;
    }

    /* Liens */
    .nav-links {
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 100%;
    }

    .nav-item {
        background-color: var(--btn-color);
        color: var(--text-color);
        text-decoration: none;
        padding: 15px;
        border-radius: 12px;
        font-weight: bold;
        font-size: 1.1rem;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .nav-item:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    /* Bouton logout */
    .nav-item.logout {
        background-color: #b32818;
    }

    .nav-item.logout:hover {
        background-color: #751309;
    }
</style>