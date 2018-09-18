<?php $title = 'Mon compte - gestion des droits du groupe <?php $group->getTitle() ?>';

$_SESSION['page'] = 'index.php?action=adminGroup&id='. $group->getId();

ob_start(); 
echo $groupBar;
?>
<section id="contents" class="container">
<div id="admin-group-page">
	<h2>Gestion des droits du groupe : <?= $group->getTitle() ?>.</h2>

	<p><a class="indexLink" href="index.php?action=mainPage">-> Retour à l'acceuil du site</a></p>
	<p><a class="indexLink" href="index.php?action=group&amp;id=<?= $group->getId() ?>">-> Retour au groupe</a></p>

	<div class="row">
			<div id="edit-group" class="col-md-12 col-sm-12 jumbotron">
				<div class="row">
				<div class="col-md-4 col-sm-4">
					<h3 id='setting-gestion'>Paramètres du groupe.</h3>
					<p>Ce groupe est actuellement <?= $group->getPublicString() ?></p>
					<?php if ($group->getPublic() == 0) { ?>
					<a href="index.php?action=changePublic&amp;id=<?= $group->getId() ?>"><div id="newGroup" class="btn btn-info">
					<p>Rendre publique</p></div></a>
					<?php } else { ?>
					<a href="index.php?action=changePublic&amp;id=<?= $group->getId() ?>"><div id="newGroup" class="btn btn-info">
					<p>Rendre privé</p></div></a>
					<?php } ?>
				</div>
				<div class="col-md-8 col-sm-8">
					<form id="submitGroup" action="index.php?action=updateGroup" method="post">
							<label>Titre du groupe :</label>
							<input type="text" id="titleGroup" name="titleGroup" value="<?= $group->getTitle() ?>"><br/>
							<label>Description du groupe :</label>
							<textarea class="tinymce" id="description" name="description"><?= $group->getDescription() ?></textarea>
							<input class="btn btn-success" type="submit" value="Valider la modification"/>
							<input type="hidden" name="groupId" value="<?= $group->getId()?>" />
					</form>
				</div>
				</div>
			</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 jumbotron">
				<form action="index.php?action=updateLinkGroup&amp;id=<?= $group->getId()?>" method="post">
					<h3 id='access-gestion'>Gestions des droits utilisateurs.</h3>
					<?php if (isset($admins)) { ?>
						<h4>Administrateurs</h4>
						<?php foreach ($admins as $adminId => $admin) { ?>
							<label for="<?= $adminId ?>"><?= $profils[$adminId]->getPseudo() ?></label>
							<select name="<?= $adminId ?>">
								<option value="1" selected="selected">Administrateur</option>
								<option value="2">Auteur</option>
								<?php if ($group->getPublic() == 0) { ?>
										<option value="3">Commenteur</option>
										<option value="4">Viewer</option>
								<?php } ?>
							</select>
							<br/>
						<?php } 
					} ?>
					<?php if (isset($authors)) { ?>
						<h4>Auteurs</h4>
						<?php foreach ($authors as $authorId => $author) { ?>
							<label for="<?= $authorId ?>"><?= $profils[$authorId]->getPseudo() ?></label>
							<select name="<?= $authorId ?>">
								<option value="1">Administrateur</option>
								<option value="2" selected="selected">Auteur</option>
								<?php if ($group->getPublic() == 0) { ?>
										<option value="3">Commenteur</option>
										<option value="4">Viewer</option>
								<?php } ?>
							</select>
							<br/>
						<?php } 
					} ?>
					<?php if (isset($commenters) AND $group->getPublic() == 0) { ?>
						<h4>Commenteur</h4>
						<?php foreach ($commenters as $commenterId => $commenter) { ?>
							<label for="<?= $commenterId ?>"><?= $profils[$commenterId]->getPseudo() ?></label>
							<select name="<?= $commenterId ?>">
								<option value="1">Administrateur</option>
								<option value="2">Auteur</option>
								<?php if ($group->getPublic() == 0) { ?>								
										<option value="3" selected="selected">Commenteur</option>
										<option value="4">Viewer</option>
								<?php } ?>								
							</select>
							<br/>
						<?php } 
					} ?>
					<?php if (isset($viewers) AND $group->getPublic() == 0) { ?>
						<h4>Viewer</h4>
						<?php foreach ($viewers as $viewerId => $viewer) { ?>
							<label for="<?= $viewerId ?>"><?= $profils[$viewerId]->getPseudo() ?></label>
							<select name="<?= $viewerId ?>">
								<option value="1">Administrateur</option>
								<option value="2">Auteur</option>
								<?php if ($group->getPublic() == 0) { ?>								
										<option value="3" >Commenteur</option>
										<option value="4" selected="selected">Viewer</option>
								<?php } ?>								
							</select>
							<br/>
						<?php } 
					} ?>
					<input id="valid-status" class="btn btn-success" type="submit" value="Valider les modifications"/>
				</form>
			</div>		
		</div>

	<div class="row">
		<div id="change-member" class="col-md-12 col-sm-12 jumbotron">
				<h3 id='member-gestion'>Gestion des membres.</h3>
				<h4>Administrateurs</h4>
						<form action="index.php?action=addLinkGroup" method="post">
							<select name="friend">
								<option value=""></option>
								<?php foreach ($friends as $friendId => $friend) { ?>
									<option value="<?= $friendId?>"><?= $friend->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<input type="hidden" name="groupId" value=<?= $group->getId() ?> />
							<input type="hidden" name="status" value="1" />
							<?php if (isset($admins)) { ?>
									<p>
									<?php foreach ($admins as $adminId => $admin) { ?>
									<?= $profils[$adminId]->getPseudo()  ?> <a href="index.php?action=deleteLinkGroup&amp;userId=<?= $adminId ?>&amp;id=<?= $group->getId() ?>"><i class="fas fa-times"></i></a>
									<?php } ?>
									<p>
								<?php } ?>
						</form>
				<h4>Auteurs</h4>
						<form action="index.php?action=addLinkGroup" method="post">
							<select name="friend">
								<option value=""></option>
								<?php foreach ($friends as $friendId => $friend) { ?>
									<option value="<?= $friendId?>"><?= $friend->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<input type="hidden" name="groupId" value=<?= $group->getId() ?> />
							<input type="hidden" name="status" value="2" />
							<?php if (isset($authors)) { ?>
									<p>
									<?php foreach ($authors as $authorId => $author) { ?>
									<?= $profils[$authorId]->getPseudo()  ?> <a href="index.php?action=deleteLinkGroup&amp;userId=<?= $authorId ?>&amp;id=<?= $group->getId() ?>"><i class="fas fa-times"></i></a>
									<?php } ?>
									<p>
								<?php } ?>
						</form>
				<?php if ($group->getPublic() == 0) { ?>
					<h4>Commenteurs</h4>
							<form action="index.php?action=addLinkGroup" method="post">
								<select name="friend">
									<option value=""></option>
									<?php foreach ($friends as $friendId => $friend) { ?>
										<option value="<?= $friendId?>"><?= $friend->getPseudo()?></option>
									<?php } ?>
								</select>
								<input class="btn btn-success" type="submit" value="Ajouter"/>
								<input type="hidden" name="groupId" value=<?= $group->getId() ?> />
								<input type="hidden" name="status" value="3" />
								<?php if (isset($commenters)) { ?>
									<p>
									<?php foreach ($commenters as $commenterId => $commenter) { ?>
										<?= $profils[$commenterId]->getPseudo()  ?> <a href="index.php?action=deleteLinkGroup&amp;userId=<?= $commenterId ?>&amp;id=<?= $group->getId() ?>"><i class="fas fa-times"></i></a>
										
									<?php } ?>
									<p>
								<?php } ?>
							</form>
					<h4>Viewers</h4>
							<form action="index.php?action=addLinkGroup" method="post">
								<select name="friend">
									<option value=""></option>
									<?php foreach ($friends as $friendId => $friend) { ?>
										<option value="<?= $friendId?>"><?= $friend->getPseudo()?></option>
									<?php } ?>
								</select>
								<input class="btn btn-success" type="submit" value="Ajouter"/>
								<input type="hidden" name="groupId" value=<?= $group->getId() ?> />
								<input type="hidden" name="status" value="4" />
								<?php if (isset($viewers)) { ?>
									<p>
									<?php foreach ($viewers as $viewerId => $viewer) { ?>
										<?= $profils[$viewerId]->getPseudo()  ?> <a href="index.php?action=deleteLinkGroup&amp;userId=<?= $viewerId ?>&amp;id=<?= $group->getId() ?>"><i class="fas fa-times"></i></a>
									<?php } ?>
									<p>
								<?php } ?>
							</form>
				<?php } ?>
		</div>
	</div>
	<div class="row table-report">
        <div class="col-lg-10 col-md-12">
			<h2>Liste des commentaires signalés</h2>
			<?php if ($links != NULL) {?>
				<table class="table">
				   	<tr>
				       	<th>Commentaire</th>
				       	<th class="mega-off-responsive">Personnes ayant signalé</th>
				       	<th class="off-responsive">Date du signalement</th>
				       	<th>Action</th>
				   	</tr>
					<?php foreach ($links as $link) { 
						$comment = $commentCRUD->read($link->getCommentId());
						$user = $userCRUD->read($link->getUserId()); ?>   
							<tr>
					       	<td><?= htmlspecialchars($comment->getContent()) ?></td>
							<td class="mega-off-responsive"><?= $user->getPseudo() ?></td>
							<td class="off-responsive"><?= $link->getReportingDate() ?></td>
					       	<td>
					       		<a href="index.php?action=deleteComment&amp;commentId=<?= $link->getCommentId()?>">Supprimer</a><br>
					       		<a href="index.php?action=deleteAllReport&amp;id=<?= $link->getCommentId() ?>">Annuler</a>
					   		</td>
					   </tr>
					<?php }?>
				</table>
			<?php } else { ?>
				<p>Aucun commentaire n'a été signalé dans ce groupe.</p>
			<?php } ?>
		</div>
	</div>
</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>