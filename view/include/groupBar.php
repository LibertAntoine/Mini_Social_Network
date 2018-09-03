	<?php if (isset($groups)) { ?>
	<section id="groupBarSection">
		<div id="groupBar">
			<a href="index.php?action=myGroup"><h3>Mes groupes</h3></a>
			<?php foreach ($groups as $groupId => $group) { ?>
				<a href="index.php?action=group&amp;id=<?= $groupId ?>"><div><p><?= $group->getTitle() ?></p></div></a>
			<?php } ?>
		</div>
	</section>
	<?php } ?>

