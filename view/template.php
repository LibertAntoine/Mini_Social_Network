<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/styles.css" rel="stylesheet" />
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    </head>
        
    <body>

    	<?php require("view/include/navbar.php");?>
        
        <section id="contents" class="container">
            <?= $content ?>
        </section>

        <script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="vendor/jQuery/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="vendor/tinymce/js/tinymce.min.js"></script>
		<script type="text/javascript" src="vendor/tinymce/js/themes/init-tinymce.js"></script>
    </body>
</html>