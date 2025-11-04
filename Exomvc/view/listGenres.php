        <?php
            foreach($requete->fetchAll() as $genre) { ?>
                <br>
                <li class="genre"><a href="index.php?action=listFilmsByGenre&id=<?=$genre['id_genre']?>"><?=$genre["wording"]?></a></li>
                <li class="supprgenre"><a style = "color = 'red' "href="index.php?action=deleteGenre&id=<?= $genre['id_genre'] ?>">Supprimer</a></li>
        <?php } ?>
        