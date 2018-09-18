<?php $title = 'Connectez-vous à votre compte' ?>

<?php ob_start(); ?>
<section id="contents" class="container">
     <h2>Page d'authentification</h2>
    <p><a class="indexLink" href="index.php">-> Retour à l'acceuil du site</a></p>

    <div id="login-form" class="row">
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 jumbotron">
            <form id="login" action="index.php?action=verifUser" method="post">
                <h3>Merci d'entrer vos identifiants de connexion</h3>
                <div>
                    <label for="pseudo">Identifiant :</label><br />
                    <input type="text" id="pseudo" name="pseudo" maxlength="24"/>
                </div>
                <div>
                    <label for="mdp">Mot de passe :</label><br />
                    <input type="password" id="mdp" name="mdp" maxlength="24"/>
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