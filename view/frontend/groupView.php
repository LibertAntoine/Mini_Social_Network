<?php $title = $group->getTitle();

$_SESSION['page'] = 'index.php?action=group&id='. $group->getId();

ob_start(); 
  
if (explode('.',$group->getLinkCouvPicture(), 2)[1] != NULL) {?>
    <div id="couv-picture-block">
        <img id="couv-picture" src="<?= $group->getLinkCouvPicture() ?>" alt="image de couverture de <?= $group->getTitle()?>">
    </div>
<?php } ?>

  <h2><?= $group->getTitle()?></h2>
  <p id="nav-option">
    <a href="index.php?action=deleteGroup&amp;groupId=<?= $group->getId() ?>">Supprimer le groupe</a> | 
    <a href="index.php?action=deleteLinkGroup&amp;userId=<?= $_SESSION['id'] ?>&amp;id=<?= $group->getId() ?>">Quitter le groupe</a> | 
    <a href="index.php?action=myStatus&amp;id=<?= $groupId ?> ?>">Changer de statut</a>
        <?php if ($link->getStatus() === 'admin') { ?>
            | <a href="index.php?action=adminGroup&amp;id=<?= $group->getId() ?>">Gerer le groupe</a> 
        <?php } ?>
  </p>

  <?php if ($group->getDescription()) { ?>
    <div id="description-bloc" class="jumbotron">
        <p id="description"><?=  html_entity_decode($group->getDescription()) ?><p>
    </div>
  <?php } ?>




  	<div id="group-content" class="row">
        <div class="col-sm-11">
            <?php if ($posts !== 'none') { 
                foreach ($posts as $data) { ?>
                    <div id="post-content" class="row">
                    <div class="col-sm-9">
                    <div class="postBox jumbotron">
                        <?php if ($_SESSION['id'] === $data->getUserId()) { ?>
                                    <a class="delete-post" href="index.php?action=deletePost&amp;postId=<?= $data->getId() ?>">Supprimer</a>
                        <?php } ?>
                        <h3><?= htmlspecialchars($data->getTitle()) ?></h3><br/>
                        
                        <p><?= nl2br($data->getContent()) ?></p>
                        <em class="creationDate"><?= $data->getCreationDate() ?></em><br/>

                    </div>
                    </div>
                    <?php if ($comments[$data->getId()] !== 'none') { ?>
                        <div class="comment-content jumbotron col-sm-3">
                        <?php foreach ($comments[$data->getId()] as $comment) { ?>
                            <div class="commentBox jumbotron">
                                <?php if ($_SESSION['id'] === $comment->getUserId() OR $link->getStatus() === 'admin') { ?>
                                    <a class="comment-option" href="index.php?action=deleteComment&amp;commentId=<?= $comment->getId() ?>">x</a>
                                <?php } elseif ($report[$comment->getId()] != 'none' AND in_array($_SESSION['id'], $report[$comment->getId()])) { ?>
                                    <a class="comment-option" href="index.php?action=deleteReport&amp;id=<?= $comment->getId()?>">Ne plus signaler</a>
                                <?php } else { ?>
                                    <a class="comment-option" href="index.php?action=addReport&amp;id=<?= $comment->getId()?>">Signaler</a>
                                <?php } ?>
                                <p><?= nl2br($comment->getContent()) ?></p>
                                <em class="creationDate"><?= $comment->getCreationDate() ?></em><br/>
                            </div>
                        <?php } ?>
                         
                    <?php } else { ?>
                        <p>Le post ne compte aucun commentaire. Lancez-vous !</p> 
                    <?php } 
                    if ($link->getStatus() !== 'viewer') { ?>
                        <div class="jumbotron">
                            <form action="index.php?action=addComment" method="post">
                                <textarea id="content" name="content"></textarea>
                                <input class="btn btn-success  add-comment" type="submit" value="Ajouter"/>
                                <input type="hidden" name="postId" value=<?= $data->getId() ?> />
                                <input type="hidden" name="groupId" value=<?= $data->getGroupId() ?> />
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                
            </div>
            <?php   }
            } else { ?>
               <p>Le groupe ne contient encore aucun post. Lancez-vous !</p>  
            <?php } ?>                     
        </div>
    </div>
    <?php if ($link->getStatus() === 'admin' OR $link->getStatus() === 'author') { ?>
    <div id="create-post" class="row">
        <div class="col-sm-11">
            <div class="jumbotron">
                <p><?php  if ($this->getMessage() != NULL) {echo $this->getMessage();} ?></p>
                <h3>Ajouter un post au groupe</h3>
                <form action="index.php?action=addPost" method="post">
                    <label for="title">Titre :</label><br />
                    <input type="text" id="title" name="title" />
                    <label for="content">Contenu :</label><br />
                    <textarea class="tinymce" id="content" name="content"></textarea>
                    <input class="btn btn-success" type="submit" value="Publier"/>
                    <input type="hidden" name="groupId" value=<?= $group->getId() ?> />
                </form>
            </div>
        </div>
    </div>        
    <?php } ?>

    <script src="puclic/js/group.js"></script>
    <script src="puclic/js/Slide.js"></script>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>