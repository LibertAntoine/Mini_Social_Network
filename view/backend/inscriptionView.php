<?php $title = 'Création d\'un compte utilisateur';

ob_start(); ?>

	<p><a class="indexLink" href="index.php">-> Retour à l'acceuil du site</a></p>

    <p><?php  if ($this->message != NULL) {echo $this->message;} ?></p>

	<h2>Création d'un nouveau compte</h2>

	<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 jumbotron">
		<form action="index.php?action=addUser" method="post">
			<h3>Merci de rensiegner les informations necessaire à la création de votre compte</h3>
			<label for="pseudo">Pseudo : </label>
			<input type="text" id="pseudo" name="pseudo"/>
			<p>Entre 8 et 25 caractères<p>
			<label for="mdp">Mot de passe : </label>
			<input type="password" id="mdp" name="mdp"/>
			<p>Entre 8 et 25 caractères<p>
			<input class="btn btn-success" type="submit" value="Je valide mon inscription"/>
		</form>
	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>