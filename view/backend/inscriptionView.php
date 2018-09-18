<?php $title = 'Création d\'un compte utilisateur';

ob_start(); ?>
<section id="contents" class="container">

	<h2>Création d'un nouveau compte</h2>
	<p><a class="indexLink" href="index.php">-> Retour à l'acceuil du site</a></p>

	<div id="inscription-form" class="row">
		<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 jumbotron">
			<form id="login" action="index.php?action=addUser" method="post">
				<h3>Merci de renseigner les informations necessaires à la création de votre compte</h3>
				<label for="pseudo">Pseudo : </label>
				<input type="text" id="pseudo" name="pseudo" maxlength="24"/>
				<p><em>Entre 8 et 24 caractères</em></p>
				<label for="mdp">Mot de passe : </label>
				<input type="password" id="mdp" name="mdp" maxlength="24"/>
				<p><em>Entre 8 et 24 caractères</em></p>
				<input class="btn btn-success" type="submit" value="Je valide mon inscription"/>
			</form>
		</div>
	</div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>