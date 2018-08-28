<header>
	<nav id="navbar" class="navbar navbar-default">
		<div id="teller">
			<a href="index.php">
				<img id="logo-teller" src="public/pictures/logo/logo_Plume.png" alt="logo de teller">
				<h1 class="navbar-text">Teller</h1>
			</a>
		</div>
		<div class="loger">
			<?php if (isset($_SESSION['pseudo'])) { ?> 
				<a class="navbar-link" href="index.php?action=newGroup"><div class="navbloc">Nouveau groupe</div></a>
				<a class="navbar-link" href="index.php?action=myGroup"><div class="navbloc">Mes groupes</div></a>
				<a class="navbar-link" href="index.php?action=myFriend"><div class="navbloc">Mes amis</div></a>
				<a class="navbar-link" href="index.php?action=backOffice"><div class="navbloc">Paramètre du compte</div></a>
				<a class="navbar-link" href="index.php?action=logOut"><div class="navbloc">Déconnexion</div></a>
			<?php } else {?>
				<a class="navbar-link" href="index.php?action=login"><div class="navbloc">Connexion</div></a>
				<a class="navbar-link" href="index.php?action=inscription"><div class="navbloc">Inscription</div></a>
			<?php } ?>
		</div>
	</nav>
</header>
