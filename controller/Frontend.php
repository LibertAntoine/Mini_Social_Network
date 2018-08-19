<?php session_start();

class Frontend {

	function __construct($view)
    {
        $this->$view(); 
    }
    
	public function mainPageView() {


		require('view/frontend/mainPageView.php');
	}

	public function groupView() {

		require('view/frontend/groupView.php');

	}

	public function allPublicGroupView() {

		require('view/frontend/allPublicGroupView.php');

	}
}