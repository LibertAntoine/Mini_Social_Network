<?php $title = 'Mon compte - création d\'un nouveau groupe';

ob_start(); ?>

	<h2>Création d'un nouveau groupe</h2>

	<p><a class="indexLink" href="index.php?action=mainPage">-> Retour à l'acceuil du site</a></p>

	<div class="row">
		<div class="col-md-12 col-sm-12 jumbotron">
		<p><?php  if ($this->getMessage() != NULL) {echo $this->getMessage();} ?></p>	
			<form action="index.php?action=newGroupMember" method="post" enctype="multipart/form-data">
				<h3>Informations sur le groupe</h3>
				<label for="titleGroup">Nom du groupe :  </label>
				<input type="text" id="titleGroup" name="titleGroup" required>
				<br/>
				<label for="status">Statut du groupe :  </label>
				<input type="radio" id="public" name="status" value="public">
				<label for="public">Public</label>
				<input type="radio" id="private" name="status" value="private" checked="true">
				<label for="private">Privé</label>
				<br/>
				<label for="status">Ajouter une image de couverture :  </label>
				<input type="file" id="couvPicture" name="couvPicture" accept=".png, .jpg, .jpeg">
				<br/>
				<input class="btn btn-success" type="submit" value="Valider la modification"/>
			</form>
		</div>
	</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>