<?php


class Backend {

	protected $message;

	function __construct($view, $message = '')
    {
    	$this->message = $message;
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

	public function newGroupView() {

		$userManager = new UserManager();
		$users = $userManager->getAll();

		require('view/backend/newGroupView.php');
	}


	public function myGroupView() {

		require('view/backend/myGroupView.php');

	}

}