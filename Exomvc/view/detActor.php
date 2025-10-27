<?php
 //Mise en mémoire tampon (buffer)
//  ob_start(); ?>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>PRENOM</th>
            <th>NOM</th>
            <th>GENRE</th>
            <th>DATE DE NAISSANCE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $actor) { ?>
                <tr>
                    <td><?= $actor["first_name"] ?></td>
                    <td><?= $actor["last_name"] ?></td>
                    <td><?= $actor["gender"] ?></td>
                    <td><?= $actor["birthday"] ?></td>
                </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$titre = "PDO CINEMA";
$titre_secondaire = "Détail de l'acteur";
//Fin de la mise en mémoire tampon + récupération du contenu tamponné dans la variable $contenu
// $contenu = ob_get_clean();
require "view/template.php";