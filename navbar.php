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
        gap: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .welcome-section {
        text-align: left;
        width: 100%;
        margin-bottom: 20px;
        color: #000;
    }

    .welcome-section h2 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .welcome-section .name {
        font-size: 2rem;
        font-family: serif;
        line-height: 1;
        margin-top: 5px;
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
        transition: transform 0.2s;
    }

    .nav-item:hover {
        transform: scale(1.02);
    }
</style>

<nav class="navbar">
    <div class="welcome-section">
        <h2>Bienvenue</h2>
        <div class="name">NOM<br>Prénom</div>
    </div>

    <div class="nav-links">
        <a href="#" class="nav-item">Accueil</a>
        <a href="table_tp.php" class="nav-item">Liste TP</a>
        <a href="#" class="nav-item">Graphiques</a>
    </div>
</nav>