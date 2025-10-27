<?php
 //Mise en mémoire tampon (buffer)
//  ob_start(); ?>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["title"] ?></td>
                    <td><?= $film["year_of_release"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
//Fin de la mise en mémoire tampon + récupération du contenu tamponné dans la variable $contenu
// $contenu = ob_get_clean();
require "view/template.php";