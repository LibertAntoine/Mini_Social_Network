<?php $title = 'Mon compte - espace utilisateur';

ob_start(); ?>
	<section id="contents" class="container">

	<h2>Bienvenue <?= $_SESSION['pseudo'] ?> dans votre espace administrateur.</h2>

	<p><a class="indexLink" href="index.php">-> Retour à l'acceuil du site</a></p>


	<h3>Modifier les données personnelles.</h3>
	<div id="edit-acompte" class="row">
		<div class="col-md-6 col-sm-12 col-xs-12 jumbotron">
			<p><?php  if ($this->getMessage() != NULL) {echo $this->getMessage();} ?></p>
			<form action="index.php?action=editPseudo" method="post">
				<h3>Modification du nom utilisateur.</h3>
				<p>Votre nom actuelle est <strong><?= $_SESSION['pseudo'] ?></strong></p><br/>
				<label for="newPseudo">Nouveau nom utilisateur :  </label>
				<input type="text" id="newPseudo" name="newPseudo">
				<input class="btn btn-success" type="submit" value="Valider la modification"/>
			</form>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12 jumbotron">
			<form action="index.php?action=editMdp" method="post">
				<h3>Modification du mot de passe du compte.</h3>
				<label for="oldMdp">Ancien mot de passe :  </label>
				<input type="password" id='oldMdp' name="oldMdp"><br/>
				<label for="newMdp">Nouveau mot de passe :</label>
				<input type="password" id='newMdp' name="newMdp"><br/>
				<input class="btn btn-success" type="submit" value="Valider la modification"/>
			</form>
		</div>
	</div>
	<a href="index.php?action=deleteUser"><div id="newGroup" class="btn btn-danger">
	<p>Supprimer le compte</p></div></a>

</section>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>