
	<section id="groupBar">
			<a href="index.php?action=myGroup"><h4>Mes groupes</h4></a>
			<?php foreach ($groups as $groupId => $group) { ?>
				<a href="index.php?action=group&amp;id=<?= $groupId ?>"><div><p><?= $group->getTitle() ?></p></div></a>
			<?php } ?>
	</section>

