<?php $title = 'Mes amis';

ob_start(); ?>
<section id="myfriend-page"></section>
<div id="contents" class="container">
  <h2>Gestion de mes amis.</h2>

    <p><?php  if ($this->getMessage() != NULL) {
        echo $this->getMessage();} ?></p>

   
        <div class="row">
             <div id="add-friends-lists" class="col-lg-6 col-sm-10 col-xs-12">       
            <?php if (isset($requests)) { ?>
                <h3>Amis en attente d'acceptation</h3>
                         <table id="acceptation-list" class="table">
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
            <?php } ?>
                        <?php if (isset($allUsers)) { ?>
                                <h3>Ajouter de nouveaux amis</h3>
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
                        <?php } ?>
                    </div>
                    <div id="friend-list" class="col-lg-6 col-sm-10 col-xs-12">
            <?php if (isset($friends)) { ?>  
                    <h3>Mes amis</h3>                
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
            <?php } else { ?>
                <p>Vous n'avez pas encore d'amis, ajoutez en-vite !</p>
            <?php } ?>
            </div>
            </div>
  </div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>