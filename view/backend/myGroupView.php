<?php $title = 'Mes groupes';

ob_start(); ?>

  <h2>Retrouvez sur cette page mes groupes</h2>

  	<div class="row">
        <div class="col-lg-8 col-md-7">
            <?php if ($groups !== 'none') { ?>
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                         <table class="table">
                            <tr>
                                <th>Titre</th>
                                <th>Status</th>
                                <th>Fonction</th>
                            </tr>
                            <?php foreach ($groups as $groupId => $group) { ?>   
                                <tr>
                                    <td><a href="index.php?action=group&amp;id=<?= $groupId ?>"><h3><?= htmlspecialchars($group[0]->getTitle()) ?></h3></a></td>
                                    <td><?= htmlspecialchars($group[0]->getStatus()) ?></td>
                                    <td><?= $group[1] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>