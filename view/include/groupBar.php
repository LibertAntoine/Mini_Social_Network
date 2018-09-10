<section id="groupBarSection">
		<div id="groupBar">
			<?php if (isset($_SESSION['id'])) { ?>
				<a href="index.php?action=myGroup" class="underline"><h3>Mes groupes</h3></a>
				
				<?php if (isset($groupsPrivate)) { ?>
					<h4>Privé</h4>
					<?php foreach ($groupsPrivate as $groupId => $group) { ?>
						<a href="index.php?action=group&amp;id=<?= $groupId ?>"><div><p><?= $group->getTitle() ?></p></div></a>
					<?php }
				} ?>
				
				<?php if (isset($groupsPublic)) { ?>
					<h4>Public</h4>
					<?php foreach ($groupsPublic as $groupId => $group) { ?>
						<a href="index.php?action=group&amp;id=<?= $groupId ?>"><div><p><?= $group->getTitle() ?></p></div></a>
					<?php }
				} ?>
				<?php if (!isset($groupsPublic) AND !isset($groupsPrivate)) { ?>
				<p id='link-newGroup'>Vous n'êtes actuellement dans aucun groupe. <br/> <a href="index.php?action=newGroup" class="underline">Créez en un !</a></p>
				<?php } else { ?>
				<p id='link-newGroup'><a href="index.php?action=newGroup" class="underline">Créer un groupe</a></p>	
				<?php } 
			} else { ?>
			            <form action="index.php?action=verifUser" method="post">
			                <h3 id="login-title">Connectez-vous</h3>
	
			                    <label for="pseudo">Identifiant :</label><br />
			                    <input type="text" id="pseudo" name="pseudo" />


			                    <label for="mdp">Mot de passe :</label><br />
			                    <input type="password" id="mdp" name="mdp"></input>


			                    <input class="btn btn-success" type="submit" value="Valider"/>
			            </form>
			    <p id='link-newGroup'>Vous n'avez pas encore de compte ?<br/> <a href="index.php?action=inscription" class="underline">Inscrivez-vous !</a></p>
			<?php } ?>    
		</div>
	</section>

