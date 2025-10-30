<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

    <header>
        <div class="front_navbar">
            <div class="logo"><img src="public/img/logo_popcorn.svg" alt="un pot rouge et blanc avec du popcorn à l'intérieur"></div>
            <div class="search_bar">
                <input type="text" placeholder="Search..." aria-label="Rechercher">
                <button type="submit" aria-label="Bouton recherche">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M480 272C480 317.9 465.1 360.3 440 394.7L566.6 521.4C579.1 533.9 579.1 554.2 566.6 566.7C554.1 579.2 533.8 579.2 521.3 566.7L394.7 440C360.3 465.1 317.9 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272zM272 416C351.5 416 416 351.5 416 272C416 192.5 351.5 128 272 128C192.5 128 128 192.5 128 272C128 351.5 192.5 416 272 416z"/></svg>
                </button>
            </div>
        </div>
        <div class="back_navbar">
            <nav>
                <ul>
                    <li><a href="index.php?action=default">Accueil</a></li>
                    <li><a href="index.php?action=listFilms">Films</a></li>
                    <li><a href="index.php?action=listGenres">Genres</a></li>
                    <li class="dropdown"><p class="dropclick">Personnalités</p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M187.2 100.9C174.8 94.1 159.8 94.4 147.6 101.6C135.4 108.8 128 121.9 128 136L128 504C128 518.1 135.5 531.2 147.6 538.4C159.7 545.6 174.8 545.9 187.2 539.1L523.2 355.1C536 348.1 544 334.6 544 320C544 305.4 536 291.9 523.2 284.9L187.2 100.9z"/></svg>
                        <div class="dropdown-content"> <!-- On va créer une div pour le menu dropdown, qui affichera les onglets acteurs et réalisateurs -->
                        <a href="index.php?action=listRealisateurs">Réalisateurs</a>
                        <a href="index.php?action=listActeurs">Acteurs</a>
                        </div>
                    </li>
                </ul>
            </nav>
            <button class="connexion_navbar">Connexion</button>
        </div>
    </header>

    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id="contenu">
                <h1>Popcorn</h1>
                <h2><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </div>

    <footer>
    <div class="logo">
        <img src="public/img/logo_popcorn.svg" alt="un pot rouge et blanc avec du popcorn à l'intérieur">
        <h2>POPCORN</h2>
    </div>
    <div class="navbar_footer">
            <nav class="footer">
                <ul>
                    <li><a href="index.php?action=default">Accueil</a></li>
                    <li><a href="index.php?action=listFilms">Films</a></li>
                    <li><a href="index.php?action=listGenres">Genres</a></li> <!-- mettre un overlay avec les différents genres -->
                    <li class="dropdown"><p class="dropclick">Personnalités</p><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M187.2 100.9C174.8 94.1 159.8 94.4 147.6 101.6C135.4 108.8 128 121.9 128 136L128 504C128 518.1 135.5 531.2 147.6 538.4C159.7 545.6 174.8 545.9 187.2 539.1L523.2 355.1C536 348.1 544 334.6 544 320C544 305.4 536 291.9 523.2 284.9L187.2 100.9z"/></svg>
                        <div class="dropdown-content"> <!-- On va créer une div pour le menu dropdown, qui affichera les onglets acteurs et réalisateurs -->
                        <a href="index.php?action=listRealisateurs">Réalisateurs</a>
                        <a href="index.php?action=listActeurs">Acteurs</a>
                        </div>
                    </li>
                </ul>
            </nav>
            
    </div>
    <button>Connexion</button>
    </footer>

</body>
</html>