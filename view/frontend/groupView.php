<?php $title = 'Page d\acceuil';

ob_start(); ?>

  <h2>Bienvenue sur la page du groupe</h2>

  	<div class="row">
        <div class="col-lg-8 col-md-7">
            <?php foreach ($articles as $data) { ?>
                <div class="articleBox jumbotron">
                    <a href="index.php?action=article&amp;id=<?= $data->getId() ?>"><h3><?= htmlspecialchars($data->getTitle()) ?></h3></a>
                    <em class="creationDate">ajouté le <?= $data->getCreationDate() ?></em>
                    <p>
                        <?= nl2br($data->getContent()) ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>