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
				<a class="navbar-link" href="index.php?action=newGroup"><div class="navbloc">Nouveau groupe</div><div class="navIcon"><i class="fas fa-plus-square"></i></div></a>
				<a class="navbar-link" href="index.php?action=myGroup"><div class="navbloc">Mes groupes</div><div class="navIcon"><i class="fas fa-layer-group"></i></div></a>
				<a class="navbar-link" href="index.php?action=myFriend"><div class="navbloc">Mes amis</div><div class="navIcon"><i class="fas fa-user-friends"></i></div></a>
				<a class="navbar-link" href="index.php?action=backOffice"><div class="navbloc">Paramètre du compte</div><div class="navIcon"><i class="fas fa-cogs"></i></div></a>
				<a class="navbar-link" href="index.php?action=logOut"><div class="navbloc">Déconnexion</div><div class="navIcon"><i class="fas fa-sign-out-alt"></i></div></a>
			<?php } else {?>
				<a class="navbar-link" href="index.php?action=login"><div class="navbloc">Connexion</div><div class="navIcon">Connexion</div></a>
				<a class="navbar-link" href="index.php?action=inscription"><div class="navbloc">Inscription</div><div class="navIcon">Inscription</div></a>
			<?php } ?>
		</div>
	</nav>
</header>
