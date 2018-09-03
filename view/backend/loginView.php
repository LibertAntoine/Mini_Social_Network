<?php $title = 'Connectez-vous à votre compte' ?>

<?php ob_start(); ?>
<section id="contents" class="container">
     <h2>Page d'authentification</h2>
    <p><a class="indexLink" href="index.php">-> Retour à l'acceuil du site</a></p>

    <p><?php  if ($this->getMessage() != NULL) {echo $this->getMessage();} ?></p>

   
    <div id="login-form" class="row">
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 jumbotron">
            <form action="index.php?action=verifUser" method="post">
                <h3>Merci d'entrer vos identifiants de connexion</h3>
                <div>
                    <label for="pseudo">Identifiant :</label><br />
                    <input type="text" id="pseudo" name="pseudo" />
                </div>
                <div>
                    <label for="mdp">Mot de passe :</label><br />
                    <input type="password" id="mdp" name="mdp"></input>
                </div>
                <div>
                    <input class="btn btn-success" type="submit" value="Valider"/>
                </div>
            </form>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>