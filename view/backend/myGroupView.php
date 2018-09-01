<?php $title = 'Mes groupes';

$_SESSION['page'] = "index.php?action=myGroup";

ob_start(); ?>

  <h2>Liste de mes groupes.</h2>

  	<div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?php if (isset($groups)) { ?>
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                         <table id="list-group" class="table">
                            <tr>
                                <th>Titre</th>
                                <th>Status</th>
                                <th>Fonction</th>
                                <th id="link-leave">Quitter</th>
                                <th>Administration</th>
                            </tr>
                            <?php foreach ($groups as $groupId => $group) { ?>   
                                <tr>
                                    <td><a href="index.php?action=group&amp;id=<?= $groupId ?>"><h3><?= htmlspecialchars($group->getTitle()) ?></h3></a></td>
                                    <td><?= htmlspecialchars($group->getStatus()) ?></td>
                                    <td><?= $linkGroups[$groupId]->getStatus() ?></td>
                                    <td><a href="index.php?action=deleteLinkGroup&amp;userId=<?= $_SESSION['id'] ?>&amp;id=<?= $group->getId() ?>">Quitter le groupe</a></td>
                                    <td id="admin-option">
                                        <div>
                                            <?php if ($linkGroups[$groupId]->getStatus() === "admin") { ?>
                                                <a href="index.php?action=deleteGroup&amp;groupId=<?= $groupId ?>">Supprimer le groupe</a>
                                            <?php } ?>
                                        </div>
                                        <div id='link-group-gestion'>
                                            <?php if ($linkGroups[$groupId]->getStatus() === "admin") { ?>
                                                <a href="index.php?action=adminGroup&amp;id=<?= $groupId ?>">Gérer le groupe</a>
                                            <?php } ?>
                                        </div>

                                    </td>

                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            <?php } else { ?>
                <p>Vous ne faites encore partie d'aucun groupe <a href="index.php?action=newGroup">créez en un !</a></p>
            <?php } ?>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>