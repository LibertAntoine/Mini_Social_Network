<?php $title = 'Mes amis';

ob_start(); ?>

  <h2>Retrouvez sur cette page mes amis</h2>

    <p><?php  if ($this->getMessage() != NULL) {
        echo $this->getMessage();} ?></p>

    <div class="row">
        <div class="col-lg-8 col-md-7">
            <h3>Amis en attente d'acceptation</h3>
            <?php if ($requests !== NULL) { ?>
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                         <table class="table">
                            <tr>
                                <th>Nom</th>
                                <th>Membre depuis</th>
                                <th>Nombre de publication</th>

                            </tr>
                            <?php foreach ($requests as $friendId => $friend) { ?>   
                                <tr>
                                    <td><a href="#"><h4><?= htmlspecialchars($friend->getPseudo()) ?></h4></a></td>
                                    <td><?= htmlspecialchars($friend->getCreationProfil()) ?></td>
                                    <td><?= htmlspecialchars($friend->getNbPublication()) ?></td>
                                    <td><a href="index.php?action=addFriend&amp;id=<?= $friendId ?>">Accepter l'invitation</a><br/><a href="index.php?action=deleteFriend&amp;id=<?= $friendId ?>">Refuser</a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            <?php } ?>
            <br/><br/><br/>
            <h3>Mes amis</h3>
            <?php if ($friends !== NULL) { ?>
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                         <table class="table">
                            <tr>
                                <th>Nom</th>
                                <th>Membre depuis</th>
                                <th>Nombre de publication</th>
                            </tr>
                            <?php foreach ($friends as $friendId => $friend) { ?>   
                                <tr>
                                    <td><a href="#"><h4><?= htmlspecialchars($friend->getPseudo()) ?></h4></a></td>
                                    <td><?= htmlspecialchars($friend->getCreationProfil()) ?></td>
                                    <td><?= htmlspecialchars($friend->getNbPublication()) ?></td>
                                    <td><a href="index.php?action=deleteFriend&amp;id=<?= $friendId ?>">Retirer de mes amis</a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            <?php } ?>
            <br/><br/><br/>
            <h3>Ajouter de nouveaux amis</h3>
            <?php if ($allUsers !== NULL) { ?>
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                         <table class="table">
                            <tr>
                                <th>Nom</th>
                                <th>Membre depuis</th>
                                <th>Nombre de publication</th>
                                <th>Ajouter en ami</th>
                            </tr>
                            <?php foreach ($allUsers as $userId => $user) { ?>   
                                <tr>
                                    <td><a href="#"><h4><?= htmlspecialchars($user->getPseudo()) ?></h4></a></td>
                                    <td><?= htmlspecialchars($user->getCreationProfil()) ?></td>
                                    <td><?= htmlspecialchars($user->getNbPublication()) ?></td>
                                    <td><a href="index.php?action=addFriend&amp;id=<?= $userId ?>">Demander en ami</a></td>
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