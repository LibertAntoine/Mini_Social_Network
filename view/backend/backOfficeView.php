<?php $title = 'Mon compte - espace utilisateur';

ob_start(); ?>

	<h2>Bienvenue <?= $_SESSION['pseudo'] ?> dans votre espace administrateur</h2>

	<p><a class="indexLink" href="index.php">-> Retour à l'acceuil du site</a></p>

	<a href="index.php?action=newGroup"><div id="newGroup" class="btn btn-primary btn-lg">
	<p>Créer un nouvel groupe</p></div></a>


	<h3>Gestion du compte utilisateur.</h3>
	<div class="row">
		<div class="col-md-6 col-sm-12 jumbotron">
			<p><?php  if ($this->getMessage() != NULL) {echo $this->getMessage();} ?></p>
			<form action="index.php?action=editPseudo" method="post">
				<h3>Modification du nom utilisateur</h3>
				<p>Votre nom actuelle est <strong><?= $_SESSION['pseudo'] ?></strong></p>
				<label for="newPseudo">Nouveau nom utilisateur :  </label>
				<input type="text" id="newPseudo" name="newPseudo">
				<input class="btn btn-success" type="submit" value="Valider la modification"/>
			</form>
		</div>
		<div class="col-md-6 col-sm-12 jumbotron">
			<form action="index.php?action=editMdp" method="post">
				<h3>Modification du mot de passe du compte</h3>
				<label for="oldMdp">Ancien mot de passe :  </label>
				<input type="password" id='oldMdp' name="oldMdp">
				<label for="newMdp">Nouveau mot de passe :</label>
				<input type="password" id='newMdp' name="newMdp">
				<input class="btn btn-success" type="submit" value="Valider la modification"/>
			</form>
		</div>
	</div>
	<a href="index.php?action=deleteUser"><div id="newGroup" class="btn btn-alert btn-lg">
	<p>Supprimer le compte</p></div></a>




<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>