<?php

class Backend {

	function __construct($view)
    {
        $this->$view(); 
    }
    
	public function loginView() {
		$message='';
		require('view/backend/loginView.php');

	}

	public function inscriptionView() {

		require('view/backend/inscriptionView.php');

	}

	public function backOfficeView() {

		require('view/backend/backOfficeView.php');

	}

	public function myGroupView() {

		require('view/backend/myGroupView.php');

	}

}