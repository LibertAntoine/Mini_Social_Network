<?php $title = 'Mon compte - création d\'un nouveau groupe';

ob_start(); ?>
	<section id="contents" class="container">
	<h2>Création d'un nouveau groupe.</h2>

	<p><a class="indexLink" href="index.php?action=mainPage">-> Retour à l'acceuil du site</a></p>

	<div id='add-member-group'class="row">
		<div class="col-md-12 col-sm-12 jumbotron">
					<h3>Ajoutez d'autres membres.</h3>
					<?php if (isset($friends)) { ?>
						<h4>Ajoutez des administrateurs.</h4>
						<form action="index.php?action=newGroupMember" method="post">
							<select name="admin">
								<option value=""></option>
								<?php foreach ($listAdmins as $admin) { ?>
									<option value="<?= $admin->getId()?>"><?= $admin->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<?php if ($_SESSION['admin'] != NULL) {
								foreach ($_SESSION['admin'] as $admin) { $user = unserialize($admin) ?>
									<p><?= $user->getPseudo()  ?></p>
								<?php } 
							} ?>
						</form>
						<h4>Ajoutez des auteurs.</h4>
						<form action="index.php?action=newGroupMember" method="post">
							<select name="author">
								<option value=""></option>
								<?php foreach ($listAuthors as $author) { ?>
									<option value="<?= $author->getId()?>"><?= $author->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<?php if ($_SESSION['author'] != NULL) {
								foreach ($_SESSION['author'] as $author) { $user = unserialize($author) ?>
									<p><?= $user->getPseudo()  ?></p>
								<?php } 
							} ?>
						</form>
						<h4>Ajoutez des commenteurs.</h4>
						<form action="index.php?action=newGroupMember" method="post">
							<select name="commenter">
								<option value=""></option>
								<?php foreach ($listCommenters as $commenter) { ?>
									<option value="<?= $commenter->getId()?>"><?= $commenter->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<?php if ($_SESSION['commenter'] != NULL) {
								foreach ($_SESSION['commenter'] as $commenter) { $user = unserialize($commenter)?>
									<p><?= $user->getPseudo()  ?></p>
								<?php } 
							} ?>
						</form>
						<h4>Ajoutez des viewers.</h4>
						<form action="index.php?action=newGroupMember" method="post">
							<select name="viewer">
								<option value=""></option>
								<?php foreach ($listViewers as $viewer) { ?>
									<option value="<?= $viewer->getId()?>"><?= $viewer->getPseudo()?></option>
								<?php } ?>
							</select>
							<input class="btn btn-success" type="submit" value="Ajouter"/>
							<?php if ($_SESSION['viewer'] != NULL) {
								foreach ($_SESSION['viewer'] as $viewer) { $user = unserialize($viewer)?>
									<p><?= $user->getPseudo() ?></p>
								<?php } 
							} ?>
						</form>
					<?php } else {?>
						<p>Ajoutez des amis pour pouvoir les ajouter au groupe.</p>
					<?php } ?>
				
					<a href="index.php?action=addGroup">
						<div id="addGroup" class="btn btn-primary btn-lg">					
							<p>Valider la création du groupe</p>
						</div>
					</a>
				</div>
			</div>
		</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>