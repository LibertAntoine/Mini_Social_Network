<?php 

require_once('Action.php');

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