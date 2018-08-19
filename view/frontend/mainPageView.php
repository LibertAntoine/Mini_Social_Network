<?php $title = 'Page d\acceuil';

ob_start(); ?>

  <h2>Bienvenue sur mon site</h2>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>