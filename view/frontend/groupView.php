<?php $title = $group->getTitle();

$_SESSION['page'] = 'index.php?action=group&id='. $group->getId();

ob_start(); ?>
<section  id="group-page" class="groupView overflow">
<?php 
if ($group->getLinkCouvPicture() === 1) {?>
    <div id="couv-picture-block">
        <img id="couv-picture" src="public/pictures/couv/<?= str_replace(' ', '_', $group->getTitle()) ?>.<?= $group->getLinkCouvPictureString() ?>" alt="image de couverture de <?= $group->getTitle()?>">
    </div>
<?php } ?>  
<div id="contents">

  <h2><?= $group->getTitle()?><span id="etat-group" class="<?php if ($group->getPublic() == 1) {echo 'green';} else {echo 'blue';}?>"><?= $group->getPublicString()?></span></h2>
  
  <p id="nav-option">
 <?php if (isset($_SESSION['id'])) { ?>
    <?php if ($status === 1) { ?>
    <a href="index.php?action=deleteGroup&amp;groupId=<?= $group->getId() ?>">Supprimer le groupe</a> | 
    <?php } 
    if ($status <= 4) { ?>
    <a href="index.php?action=deleteLinkGroup&amp;userId=<?= $_SESSION['id'] ?>&amp;id=<?= $group->getId() ?>">Quitter le groupe</a>
     <?php 
    } elseif ($status <= 5) { ?>
    <a id="unsuscribe" href="index.php?action=unsuscribe&amp;groupId=<?= $group->getId() ?>">Se désabonner</a>
 <?php } else { ?>
    <a id="suscribe" class="btn btn-primary" href="index.php?action=suscribe&amp;groupId=<?= $group->getId() ?>">S'abonner</a> 
 <?php }
     if ($group->getPublic() == 0) { ?>
        | <span data-toggle="modal" href="#status">Changer de statut</span>
    <?php }
        if ($status === 1) { ?>
            | <a href="index.php?action=adminGroup&amp;id=<?= $group->getId() ?>">Gerer le groupe</a> 
<?php } 
} else {?>
    <a href="index.php?action=login">Connectez-vous</a> pour pouvoir intéragir avec ce groupe.
<?php } ?>
</p>


  <?php if ($group->getDescription()) { ?>
    <div id="description-bloc" class="jumbotron">
        <p id="description"><?=  html_entity_decode($group->getDescription()) ?><p>
    </div>
  <?php } ?>


  	<div id="group-content">
            <?php if ($posts !== 'none') { 
                foreach ($posts as $data) { ?>
                    <div class="post-content">

                            <div class="postBox jumbotron">
                                <div class="slide"></div>
                                <i class="fas fa-comments"></i>

                                <h3><?= $data->getTitle() ?></h3><br/>
                                <div class="post">
                                <p ><?= nl2br(htmlspecialchars_decode($data->getContent())) ?></p>
                                </div>
                                <?php if (isset($_SESSION['id'])) { ?>
                                    <p class="action-post">
                                    <?php if ($_SESSION['id'] === $data->getUserId() OR $status === 1) { ?>
                                        <a href="index.php?action=deletePost&amp;postId=<?= $data->getId() ?>">Supprimer</a>
                                        <?php if ($_SESSION['id'] === $data->getUserId()) { ?>
                                         - <span class="edit-post <?= $data->getId() ?>">Modifier l'article</span>
                                    <?php }
                                    } else { ?>
                                        <a href="#">Signaler</a>
                                    <?php } ?>
                                    
                                    </p> 
                                <?php } ?>
                                <em class="creationDate"><?= $userCRUD->readName($data->getUserId())?> - <?= $data->getCreationDate() ?></em><br/>

                            </div>
 
                    <div class="comment-content jumbotron">
                    <div class="comment-text">   
                        <?php if ($comments[$data->getId()] !== 'none') { ?>  
                            <?php foreach ($comments[$data->getId()] as $comment) { ?>
                                <div id="commentBox" class="jumbotron">
                                    <h4><?= $userCRUD->readName($comment->getUserId()) ?></h4>
                                    <?php if (isset($_SESSION['id'])) { 
                                        if ($_SESSION['id'] === $comment->getUserId() OR $status === 1) { ?>
                                            <a class="comment-option" href="index.php?action=deleteComment&amp;commentId=<?= $comment->getId() ?>"><i class="fas fa-times"></i></a>
                                        <?php } elseif ($report[$comment->getId()] != 'none' AND in_array($_SESSION['id'], $report[$comment->getId()])) { ?>
                                            <a class="comment-option" href="index.php?action=deleteReport&amp;id=<?= $comment->getId()?>"><i class="fas fa-exclamation-triangle report-checked"></i></a>
                                        <?php } else { ?>
                                            <a class="comment-option" href="index.php?action=addReport&amp;id=<?= $comment->getId()?>"><i class="fas fa-exclamation-triangle"></i></a>
                                        <?php } 
                                    } ?>
                                    <p><?= nl2br($comment->getContent()) ?></p>
                                    <em class="comment-creationDate"><?= substr($comment->getCreationDate(), 0, 19) ?></em><br/>
                                </div>
                            <?php } ?>
       
                        <?php } else { ?>
                            <p id="no-post">Le post ne compte aucun commentaire. Lancez-vous !</p> 
                        <?php } 
                        if (isset($_SESSION['id'])) { 
                            if ($status !== 4) { ?>
                                <div class="add-comment">
                                    <form action="index.php?action=addComment" method="post">
                                        <textarea id="content" name="content"></textarea>
                                        <input class="btn btn-success  add-comment" type="submit" value="Ajouter"/>
                                        <input type="hidden" name="postId" value=<?= $data->getId() ?> />
                                        <input type="hidden" name="groupId" value=<?= $data->getGroupId() ?> />
                                    </form>
                                </div>
                            <?php } 
                        }?>
                     </div>
            </div>
            </div>
            <?php   }
            } else { ?>
               <p id="no-post-marg">Le groupe ne contient encore aucun post.<?php if ($status <= 2) { echo " Lancez-vous !"; } ?></p>  
            <?php } ?>                     
        
    </div>
    <?php if ($status <= 2) { ?>
          <div id="create-post">
            <div class="jumbotron">
                <p><?php  if ($this->getMessage() != NULL) {echo $this->getMessage();} ?></p>
                <h3>Ajouter un post au groupe</h3>
                <form action="index.php?action=addPost" method="post">
                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title" /><br />
                    <label for="content">Contenu :</label><br />
                    <textarea class="tinymce" id="content" name="content"></textarea>
                    <input class="btn btn-success" type="submit" value="Publier"/>
                    <input type="hidden" name="groupId" value=<?= $group->getId() ?> />
                </form>
            </div>

    </div> 
    <?php } ?>
    </div>
</section>


<?php if ($group->getPublic() == 0) { ?>
 <div class="modal fade" id="status">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Modification de statut</h4>
              <button type="button" class="close" data-dismiss="modal">x</button>
            </div>
                <div id="modal" class="modal-body">
                        <p id="actual-status">Vous êtes actuellement <strong><?= $statusString ?></strong> de ce groupe.</p>
                        <p>Statut dans ce groupe :  </p>
                        <?php if ($status == 1) { ?>
                        <input type="radio" id="admin" class="changeStatus" name="status" value="1" checked="true">
                        <label for="admin">Administrateur</label>
                        <?php } 
                        if ($status <= 2) { ?>
                        <input type="radio" id="author"class="changeStatus" name="status" value="2" <?php if ($status == 2) { echo "checked='true'";} ?>>
                        <label for="author">Auteur</label>
                        <?php } 
                        if ($status <= 3) { ?>
                        <input type="radio" id="commenter" class="changeStatus" name="status" value="3" <?php if ($status == 3) { echo "checked='true'";} ?>>
                        <label for="commenter">Commenter</label>
                        <?php } ?>
                        <input type="radio" id="viewer" class="changeStatus" name="status" value="4" <?php if ($status == 4) { echo "checked='true'";}?>>
                        <label for="viewer">Viewer</label>
                        <input type="radio" id="none" class="changeStatus" name="status" value="5">
                        <input type="hidden" name="group" id="groupId" value="<?= $group->getId() ?>" />
                        <input type="hidden" name="group" id="userId" value="<?= $_SESSION['id'] ?>" />
                        <label for="none">Aucun</label>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" data-dismiss="modal">Fermer</button>
                    <button id="valid-status" class="btn btn-success">Valider</button>
                </div>
          </div>
        </div>
    </div>
<?php } ?>




<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>