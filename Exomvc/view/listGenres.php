        <?php
            foreach($requete->fetchAll() as $genre) { ?>
                <li class="genre"><a href="index.php?action=listFilmsByGenre&id=<?=$genre['id_genre']?>"><?=$genre["wording"]?></a></li>
        <?php } ?>