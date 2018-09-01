
	<section id="memberBar">
		<a href="index.php?action=myGroup"><h3>Membres</h3></a>
		<div>
							<?php if (isset($admins)) { ?>
								<h4>Admin</h4>
								<?php foreach ($admins as $adminId => $admin) { ?>
									<div><p><?= $profils[$adminId]->getPseudo()  ?></p></div>
								<?php } 
							} ?>			
							<?php if (isset($authors)) { ?>
								<h4>Auteur</h4>
								<?php foreach ($authors as $authorId => $author) { ?>
									<div><p><?= $profils[$authorId]->getPseudo()  ?></p></div>
								<?php } 
							} ?>				
							<?php if (isset($commenters)) { ?>
								<h4>Commenteur</h4>
								<?php foreach ($commenters as $commenterId => $commenter) { ?>
									<div><p><?= $profils[$commenterId]->getPseudo()  ?></p></div>
								<?php } 
							} ?>
							<?php if (isset($viewers)) { ?>
								<h4>Viewer</h4>
								<?php foreach ($viewers as $viewerId => $viewer) { ?>
									<div><p><?= $profils[$viewerId]->getPseudo()  ?></p></div>
								<?php } 
							} ?>
		<?php if (isset($admins[$_SESSION['id']])) { ?>
            <a href="index.php?action=adminGroup&amp;id=<?= $group->getId() ?>">Gerer le groupe</a>  
        <?php } ?>
		</div>

	</section>					

