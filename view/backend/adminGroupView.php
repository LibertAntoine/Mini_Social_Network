<?php $title = 'Mon compte - gestion des droits du groupe <?php $group->getTitle() ?>';

$_SESSION['page'] = 'index.php?action=adminGroup&id='. $group->getId();

ob_start(); ?>

	<h2>Gestion des droits du groupe <?php $group->getTitle() ?></h2>

	<p><a class="indexLink" href="index.php?action=mainPage">-> Retour à l'acceuil du site</a></p>
	<p><a class="indexLink" href="index.php?action=group&amp;id=<?= $group->getId() ?>">-> Retour au groupe</a></p>

	<div class="row">
		<div class="col-md-12 col-sm-12 jumbotron">
				<form action="index.php?action=updateLinkGroup&amp;id=<?= $group->getId()?>" method="post">
					<h3>Gestions des droits utilisateurs</h3>
					<?php if (isset($admins)) { ?>
						<h4>Administrateurs.</h4>
						<?php foreach ($admins as $adminId => $admin) { ?>
							<label for="<?= $adminId ?>"><?= $profils[$adminId]->getPseudo() ?></label>
							<select name="<?= $adminId ?>">
								<option value="admin" selected="selected">Administrateur</option>
								<option value="author">Auteur</option>
								<option value="commenter">Commenteur</option>
								<option value="viewer">Viewer</option>
							</select>
							<br/>
						<?php } 
					} ?>
					<?php if (isset($authors)) { ?>
						<h4>Auteurs</h4>
						<?php foreach ($authors as $authorId => $author) { ?>
							<label for="<?= $authorId ?>"><?= $profils[$authorId]->getPseudo() ?></label>
							<select name="<?= $authorId ?>">
								<option value="admin">Administrateur</option>
								<option value="author" selected="selected">Auteur</option>
								<option value="commenter">Commenteur</option>
								<option value="viewer">Viewer</option>
							</select>
							<br/>
						<?php } 
					} ?>
					<?php if (isset($commenters)) { ?>
						<h4>Commenteur</h4>
						<?php foreach ($commenters as $commenterId => $commenter) { ?>
							<label for="<?= $commenterId ?>"><?= $profils[$commenterId]->getPseudo() ?></label>
							<select name="<?= $commenterId ?>">
								<option value="admin">Administrateur</option>
								<option value="author">Auteur</option>
								<option value="commenter" selected="selected">Commenteur</option>
								<option value="viewer">Viewer</option>
							</select>
							<br/>
						<?php } 
					} ?>
					<?php if (isset($viewers)) { ?>
						<h4>Viewer</h4>
						<?php foreach ($viewers as $viewerId => $viewer) { ?>
							<label for="<?= $viewerId ?>"><?= $profils[$viewerId]->getPseudo() ?></label>
							<select name="<?= $viewerId ?>">
								<option value="admin">Administrateur</option>
								<option value="author">Auteur</option>
								<option value="commenter" >Commenteur</option>
								<option value="viewer" selected="selected">Viewer</option>
							</select>
							<br/>
						<?php } 
					} ?>
					<input class="btn btn-success" type="submit" value="Valider les modifications"/>
				</form>			
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 jumbotron">
				<form action="index.php?action=updateLinkGroup&amp;id=<?= $group->getId()?>" method="post">
				<h3>Gestion des membres.</h3>
				<h4>Administrateurs.</h4>
						<form action="index.php?action=addLinkGroup" method="post">
							<select name="friend">
								<option value=""></option>
								<?php foreach ($friends as $friendId => $friend) { ?>
									<option value="<?= $friendId?>"><?= $friend->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<input type="hidden" name="groupId" value=<?= $group->getId() ?> />
							<input type="hidden" name="status" value="admin" />
							<?php if (isset($admins)) {
								foreach ($admins as $adminId => $admin) { ?>
									<p><?= $profils[$adminId]->getPseudo()  ?></p>
									<a href="index.php?action=deleteLinkGroup&amp;userId=<?= $adminId ?>&amp;id=<?= $group->getId() ?>">X</a>
								<?php } 
							} ?>
						</form>
				<h4>Auteurs.</h4>
						<form action="index.php?action=addLinkGroup" method="post">
							<select name="friend">
								<option value=""></option>
								<?php foreach ($friends as $friendId => $friend) { ?>
									<option value="<?= $friendId?>"><?= $friend->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<input type="hidden" name="groupId" value=<?= $group->getId() ?> />
							<input type="hidden" name="status" value="author" />
							<?php if (isset($authors)) {
								foreach ($authors as $authorId => $author) { ?>
									<p><?= $profils[$authorId]->getPseudo()  ?></p>
									<a href="index.php?action=deleteLinkGroup&amp;userId=<?= $authorId ?>&amp;id=<?= $group->getId() ?>">X</a>
								<?php } 
							} ?>
						</form>
				<h4>Commenteurs.</h4>
						<form action="index.php?action=addLinkGroup" method="post">
							<select name="friend">
								<option value=""></option>
								<?php foreach ($friends as $friendId => $friend) { ?>
									<option value="<?= $friendId?>"><?= $friend->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<input type="hidden" name="groupId" value=<?= $group->getId() ?> />
							<input type="hidden" name="status" value="commenter" />
							<?php if (isset($commenters)) {
								foreach ($commenters as $commenterId => $commenter) { ?>
									<p><?= $profils[$commenterId]->getPseudo()  ?></p>
									<a href="index.php?action=deleteLinkGroup&amp;userId=<?= $commenterId ?>&amp;id=<?= $group->getId() ?>">X</a>
								<?php } 
							} ?>
						</form>
				<h4>Viewers.</h4>
						<form action="index.php?action=addLinkGroup" method="post">
							<select name="friend">
								<option value=""></option>
								<?php foreach ($friends as $friendId => $friend) { ?>
									<option value="<?= $friendId?>"><?= $friend->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<input type="hidden" name="groupId" value=<?= $group->getId() ?> />
							<input type="hidden" name="status" value="viewer" />
							<?php if (isset($viewers)) {
								foreach ($viewers as $viewerId => $viewer) { ?>
									<p><?= $profils[$viewerId]->getPseudo()  ?></p>
									<a href="index.php?action=deleteLinkGroup&amp;userId=<?= $viewerId ?>&amp;id=<?= $group->getId() ?>">X</a>
								<?php } 
							} ?>
						</form>
				</form>
		</div>
	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>