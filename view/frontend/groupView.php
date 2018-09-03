<?php $title = $group->getTitle();

$_SESSION['page'] = 'index.php?action=group&id='. $group->getId();

ob_start(); ?>
<section  id="group-page" class="groupView">
<div id="contents" class="container">


<?php 
if ($group->getLinkCouvPicture() === 1) {?>
    <div id="couv-picture-block">
        <img id="couv-picture" src="public/pictures/couv/<?= str_replace(' ', '_', $group->getTitle()) ?>.<?= $group->getLinkCouvPictureString() ?>" alt="image de couverture de <?= $group->getTitle()?>">
    </div>
<?php } ?>

  <h2><?= $group->getTitle()?></h2>
  <p id="nav-option">
    <a href="index.php?action=deleteGroup&amp;groupId=<?= $group->getId() ?>">Supprimer le groupe</a> | 
    <a href="index.php?action=deleteLinkGroup&amp;userId=<?= $_SESSION['id'] ?>&amp;id=<?= $group->getId() ?>">Quitter le groupe</a> | 
    <a href="index.php?action=myStatus&amp;id=<?= $groupId ?> ?>">Changer de statut</a>
        <?php if ($link->getStatusInt() === 1) { ?>
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
                    <div class="row post-content">
                        <div class="col-sm-9">
                            <div class="postBox jumbotron">
                                <div class="slide"></div>

                                <h3><?= htmlspecialchars($data->getTitle()) ?></h3><br/>

                                <p><?= nl2br($data->getContent()) ?></p>
                                <?php if ($_SESSION['id'] === $data->getUserId()) { ?>
                                    <a class="action-post" href="index.php?action=deletePost&amp;postId=<?= $data->getId() ?>">Supprimer</a>
                                <?php } else { ?>
                                    <a class="action-post" href="#">Signaler</a>
                                <?php } ?> 
                                <em class="creationDate"><?= $userCRUD->readName($data->getUserId())?> - <?= $data->getCreationDate() ?></em><br/>
                                </div>
                    </div>
                    <div class="comment-content jumbotron col-sm-3 ">
                    <div class="comment-text">   
                        <?php if ($comments[$data->getId()] !== 'none') { ?>  
                            <?php foreach ($comments[$data->getId()] as $comment) { ?>
                                <div id="commentBox" class="jumbotron">
                                    <h4><?= $userCRUD->readName($comment->getUserId()) ?></h4>
                                    <?php if ($_SESSION['id'] === $comment->getUserId() OR $link->getStatusInt() === 1) { ?>
                                        <a class="comment-option" href="index.php?action=deleteComment&amp;commentId=<?= $comment->getId() ?>"><i class="fas fa-times"></i></a>
                                    <?php } elseif ($report[$comment->getId()] != 'none' AND in_array($_SESSION['id'], $report[$comment->getId()])) { ?>
                                        <a class="comment-option" href="index.php?action=deleteReport&amp;id=<?= $comment->getId()?>"><i class="fas fa-exclamation-triangle report-checked"></i></a>
                                    <?php } else { ?>
                                        <a class="comment-option" href="index.php?action=addReport&amp;id=<?= $comment->getId()?>"><i class="fas fa-exclamation-triangle"></i></a>
                                    <?php } ?>
                                    <p><?= nl2br($comment->getContent()) ?></p>
                                    <em class="comment-creationDate"><?= substr($comment->getCreationDate(), 0, 19) ?></em><br/>
                                </div>
                            <?php } ?>
       
                        <?php } else { ?>
                            <p>Le post ne compte aucun commentaire. Lancez-vous !</p> 
                        <?php } 
                        if ($link->getStatusInt() !== 4) { ?>
                            <div class="add-comment">
                                <form action="index.php?action=addComment" method="post">
                                    <textarea id="content" name="content"></textarea>
                                    <input class="btn btn-success  add-comment" type="submit" value="Ajouter"/>
                                    <input type="hidden" name="postId" value=<?= $data->getId() ?> />
                                    <input type="hidden" name="groupId" value=<?= $data->getGroupId() ?> />
                                </form>
                            </div>
                        <?php } ?>
                     </div>
                </div>
            </div>
            <?php   }
            } else { ?>
               <p>Le groupe ne contient encore aucun post. Lancez-vous !</p>  
            <?php } ?>                     
        </div>
    </div>
    <?php if ($link->getStatusInt() <= 2) { ?>
    <div id="create-post" class="row">
        <div class="col-sm-11">
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
    </div>        
    <?php } ?>
    </div>
</section>

    <script src="public/js/Slide.js"></script>
    <script src="public/js/main.js"></script>



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>