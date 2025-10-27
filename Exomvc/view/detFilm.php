<?php
 //Mise en mémoire tampon (buffer)
//  ob_start(); ?>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
            <th>DUREE</th>
            <th>PRENOM REALISATEUR</th>
            <th>NOM REALISATEUR</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requeteFilm->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["title"] ?></td>
                    <td><?= $film["year_of_release"] ?></td>
                    <td><?= $film["duration"] ?></td>
                    <td><?= $film["first_name"] ?></td>
                    <td><?= $film["last_name"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>
            <p>Avec :</p>
            <?php
            foreach($requeteCasting->fetchAll() as $casting) { ?>
                    <p><?= $casting["first_name"] ?> <?=$casting["last_name"]  ?> dans le rôle de <?= $casting["character_first_name"] ?> <?= $casting["character_last_name"] ?>, </p>                
                <?php } ?>
<?php

