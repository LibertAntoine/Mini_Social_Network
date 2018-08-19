<header>
	<nav id="navbar" class="navbar navbar-default">
		<a href="index.php"><h1 class="navbar-text">VOus voilà sur mon site</h1></a>
		<div class="loger">
			<?php if (isset($_SESSION['pseudo'])) { ?> 
				<a class="navbar-link" href="#"><div class="navbloc">Espace personnel</div></a>
				<a class="navbar-link" href="#"><div class="navbloc">Déconnexion</div></a>
			<?php } else {?>
				<a class="navbar-link" href="#"><div class="navbloc">Connexion</div></a>
				<a class="navbar-link" href="#"><div class="navbloc">Inscription</div></a>
			<?php } ?>
		</div>
	</nav>
</header>
