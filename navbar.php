<nav class="navbar">
    <div class="welcome-section">
        <div class="user-badge">
            <span class="firstname"><?= htmlspecialchars($_SESSION['name'] ?? 'Prénom') ?></span>
            <span class="surname"><?= htmlspecialchars($_SESSION['surname'] ?? 'Nom') ?></span>
        </div>
    </div>

    <div class="nav-links">
        <a href="index.php" class="nav-item">Accueil</a>
        <a href="table_tp.php" class="nav-item">Liste TP</a>
        <a href="#" class="nav-item">Graphiques</a>
            <a href="logout.php" class="nav-item logout">Déconnexion</a>

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
        background-color: #ffffffaa; /* blanc semi-transparent */
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
        font-weight: normal;
        color: #6b7abe;
        margin-top: 2px;
    }

    /* Liens de navigation */
    .sidebar .nav-links .nav-item.logout {
    background-color: #b32818;
}

.sidebar .nav-links .nav-item.logout:hover {
    background-color: #751309;
}
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
    
</style>