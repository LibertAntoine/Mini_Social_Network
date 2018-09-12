<?php session_start();

	require_once('Action.php');
	require_once("Autoloader.php");
	new Autoloader();

	use \controller\Frontend;
	
try {
    if (isset($_GET['action'])) {
        $index = new Action($_GET['action']);
    } else {
        $frontend = new Frontend('mainPageView');
    }  
}

catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

?>