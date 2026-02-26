<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        :root {
            --bg-color: #99acff;
            --btn-color: #6b7abe;
            --text-color: #ffffff;
        }

        body {
            margin: 0;
            font-family: 'Arial', sans-serif; /* Tu peux changer pour une police Serif si tu veux coller au titre */
            background-color: #f0f2f5; /* Couleur de fond de page neutre */
        }

        .navbar {
            background-color: var(--bg-color);
            padding: 20px;
            display: flex;
            flex-direction: column; /* Orientation verticale comme sur l'image */
            align-items: center;
            width: fit-content;
            min-height: 100vh;
            gap: 20px;
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
            font-size: 2.5rem;
            font-family: serif; /* Pour le style "NOM Prénom" */
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
            padding: 15px 40px;
            border-radius: 12px; /* Coins arrondis */
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            transition: transform 0.2s, background-color 0.2s;
        }

        .nav-item:hover {
            filter: brightness(1.1);
            transform: scale(1.02);
        }


    </style>
</head>
<body>

    <nav class="navbar">
        <div class="welcome-section">
            <h2>Bienvenue</h2>
            <div class="name">NOM<br>Prénom</div>
        </div>

        <div class="nav-links">
            <a href="#" class="nav-item">Accueil</a>
            <a href="#" class="nav-item">Liste TP</a>
            <a href="#" class="nav-item">Graphiques</a>
        </div>

        
    </nav>

</body>
</html>
