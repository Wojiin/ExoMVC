<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">                                     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="./public/css/style.css">      
    <title>Elan-Cinéma</title>                                            
</head>
<body>
    <!-- Conteneur principal de la navigation supérieure -->
    <nav class="topbarcontainer">
        <!-- ====================== PARTIE LOG IN / INSCRIPTION ====================== -->
        <div class="topbar">
            <!-- Logo du site -->
            <img class="logo" src="./public/img/clap32.png" alt="logo du site">
            
            <!-- Bloc des boutons de connexion -->
            <div class="log">
                <a href="#">log in</a>                             
                <a href="#">join free</a>                          
                <a href="#">join premium</a>                       
            </div>
        </div>

        <!-- ====================== PARTIE MENU PRINCIPAL ====================== -->
        <div class="topmenu">
            <!-- Navigation gauche avec effet animé (data-text) -->
            <div class="topnav">          
                <a class="menugenre" href="#" data-text="genres">genres<i class="fa-solid fa-caret-down" ></i></a>            
                    <ul class="deroulant">
                        <?php
                        require "view/listGenres.php";
                        ?>
                    </ul>
                <a href="#" data-text="réalisateurs">réalisateurs</a>
                <a href="#" data-text="acteurs">acteurs</a>
                
            </div>

            <!-- Logo central + nom du site -->
            <div class="menunom">
                <img src="./public/img/clap50.png" alt="logo du site"> 
                <h2>elan-cinéma</h2>                                   
            </div>

            <!-- Navigation droite avec effet animé (data-text) + recherche -->
            <div class="topnav">
                <a href="#" data-text="Année de sortie">Année de sortie</a>
                <div class="searchcontainer">
                    <input class="search" type="text" placeholder="Entrez votre recherche ici">
                    <button class="glass">
                        <img src="./public/img/search100.png" alt="loupe">
                    </button>
                </div>
            </div>
        </div>            
    </nav>

    <!-- Conteneur principal du contenu -->
    <div id="wrapper">
        <!-- Le contenu principal viendra ici -->
    </div>

    <!-- Zone principale du site (contenu dynamique) -->
    <main>
        <!-- Sections, films, grilles, etc. -->
    </main>
</body>
</html>