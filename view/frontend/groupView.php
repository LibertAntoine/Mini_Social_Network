<?php $title = $group->getTitle();

ob_start(); ?>

  <h2>Bienvenue sur la page du groupe <?= $group->getTitle()?></h2>

  	<div class="row">
        <div class="col-lg-8 col-md-7">
            <?php if ($posts !== 'none') { 
                foreach ($posts as $data) { ?>
                    <div class="postBox jumbotron">
                        <h3><?= htmlspecialchars($data->getTitle()) ?></h3><br/>
                        <em class="creationDate">ajouté le <?= $data->getCreationDate() ?></em><br/>
                        <p><?= nl2br($data->getContent()) ?></p>
                    </div>
                    <?php if ($comments[$data->getId()] !== 'none') {
                        foreach ($comments[$data->getId()] as $comment) { ?>
                            <div class="postBox jumbotron">
                                <em class="creationDate">ajouté le <?= $comment->getCreationDate() ?></em><br/>
                                <p><?= nl2br($comment->getContent()) ?></p>
                            </div>
                        <?php }

                    } else { ?>
                        <p>Le post ne compte aucun commentaire. Lancez-vous !</p> 

                    <?php } ?>
                    <div class="jumbotron">
                        <h3>Ajouter un commentaire</h3>
                        <form action="index.php?action=addComment" method="post">
                            <label for="content">Contenu :</label><br />
                            <textarea id="content" name="content"></textarea>
                            <input class="btn btn-success" type="submit" value="Publier"/>
                            <input type="hidden" name="postId" value=<?= $data->getId() ?> />
                        </form>
                    </div>
                <?php }
            } else { ?>
               <p>Le groupe ne contient encore aucun post. Lancez-vous !</p>  
            <?php } ?>                     
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-7">
            <div class="jumbotron">
                <p><?php  if ($this->getMessage() != NULL) {echo $this->getMessage();} ?></p>
                <h3>Ajouter un post au groupe</h3>
                <form action="index.php?action=addPost" method="post">
                    <label for="title">Titre :</label><br />
                    <input type="text" id="title" name="title" />
                    <label for="content">Contenu :</label><br />
                    <textarea id="content" name="content"></textarea>
                    <input class="btn btn-success" type="submit" value="Publier"/>
                    <input type="hidden" name="groupId" value=<?= $group->getId() ?> />
                </form>
            </div>
        </div>
    </div>        

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>