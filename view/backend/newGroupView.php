<?php $title = 'Mon compte - création d\'un nouveau groupe';

ob_start(); ?>
<section id="contents" class="container">
	<h2>Création d'un nouveau groupe</h2>

	<p><a class="indexLink" href="index.php?action=mainPage">-> Retour à l'acceuil du site</a></p>

	<div id="new-group-form" class="row">
		<div class="col-md-12 col-sm-12 jumbotron">
		<p><?php  if ($this->getMessage() != NULL) {echo $this->getMessage();} ?></p>	
			<form action="index.php?action=newGroupMember" method="post" enctype="multipart/form-data">
				<h3>Informations sur le groupe</h3>
				<label for="titleGroup">Nom du groupe* :  </label>
				<input type="text" id="titleGroup" name="titleGroup" required>
				<br/>
				<label for="public">Statut du groupe* :  </label>
				<input type="radio" id="publique" name="public" value="1">
				<label for="publique">Public</label>
				<input type="radio" id="private" name="public" value="0" checked="true">
				<label for="private">Privé</label>
				<br/>
				<label for="description">Description du groupe :  </label>
				<textarea class="tinymce" id="description" name="description"></textarea>
				<label for="couvPicture">Ajouter une image de couverture : </label>
				<input type="file" id="couvPicture" name="couvPicture" accept=".png, .jpg, .jpeg">
				<br/>
				<p>* : champs obligatoire.</p>
				<br/>
				<input class="btn btn-success" type="submit" value="Valider la modification"/>
			</form>
		</div>
	</div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>