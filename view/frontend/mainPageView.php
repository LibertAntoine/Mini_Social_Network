<?php $title = 'Page d\acceuil';

ob_start(); ?>

<section  class="groupView">
<div id="contents" class="container">
<div id="main-page">

  <h2>Bienvenue <?php if (isset($_SESSION['pseudo'])) { echo $_SESSION['pseudo']; } ?> sur Teller !</h2>

<div id='presentation' class="jumbotron">
        <h3>Découvrez le réseau social Teller, orienté sur l'écriture de récit.</h3>
        <p> Saepissime igitur mihi de amicitia cogitanti maxime illud considerandum videri solet, utrum propter imbecillitatem atque inopiam desiderata sit amicitia, ut dandis recipiendisque meritis quod quisque minus per se ipse posset, id acciperet ab alio vicissimque redderet, an esset hoc quidem proprium amicitiae, sed antiquior et pulchrior et magis a natura ipsa profecta alia causa. Amor enim, ex quo amicitia nominata est, princeps est ad benevolentiam coniungendam. Nam utilitates quidem etiam ab iis percipiuntur saepe qui simulatione amicitiae coluntur et observantur temporis causa, in amicitia autem nihil fictum est, nihil simulatum et, quidquid est, id est verum et voluntarium.</p>
  </div>

  <h3>Retrouver les derniers groupes publiques de Teller : </h3>

    <div class="row">
        <div id="lastFivePublic" class="col-lg-8 col-md-7 col-xs-12">
            <?php foreach ($fiveGroup as $data) { ?>
                <div class="articleBox jumbotron">
                    <a href="index.php?action=group&amp;id=<?= $data->getId() ?>"><h3><?= $data->getTitle() ?></h3></a>
                    
                    <p id="postPreView">
                        <?= nl2br(htmlspecialchars_decode(substr($data->getDescription(), 0, 320).'...')) ?>
                        <a href="index.php?action=article&amp;id=<?= $data->getId() ?>"> lire la suite</a><br />

                    </p>
                                            <em><a class="postLink" href="index.php?action=article&amp;id=<?= $data->getId() ?>#commentSpace">Voir les publications</a></em>
                    <em class="creationDate">ajouté le <?= $data->getCreationDate() ?></em>
                </div>
            <?php } ?>
        </div>
     </div>

</div>
</div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>