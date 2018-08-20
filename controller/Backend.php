<?php

require_once('controller/View.php');

class Backend extends View {

	function __construct($view)
    {
        $this->$view(); 
    }
    
	public function loginView() {

		require('view/backend/loginView.php');

	}

	public function inscriptionView() {

		require('view/backend/inscriptionView.php');

	}

	public function backOfficeView() {

		require('view/backend/backOfficeView.php');

	}

	public function myGroupView() {

		$groupCRUD = new GroupCRUD;
		$groups = $groupCRUD->readMine($_SESSION['id']);

		require('view/backend/myGroupView.php');

	}

	public function newGroupView() {

		$userManager = new UserManager();
		$users = $userManager->getAll();

		require('view/backend/newGroupView.php');
	}
}