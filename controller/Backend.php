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

		$linkGroupCRUD = new LinkGroupCRUD();
		$linkGroups = $linkGroupCRUD->readGroups($_SESSION['id']);

		if ($linkGroups) {
			$groupCRUD = new GroupCRUD();
			foreach ($linkGroups as $groupId => $link) {
				$groups[$groupId] = $groupCRUD->read($groupId);
			}
		}
		require('view/backend/myGroupView.php');
	}

	public function myFriendView() {

		$friendCRUD = new LinkFriendCRUD();
		$listFriends = $friendCRUD->readFriends();
		$userCRUD = new UserCRUD();
		$friends = NULL;
		$requests = NULL;
		if ($listFriends !== NULL) {
			foreach ($listFriends as $friend) {
				if ($friend->getStatus() === "no") {
					$requests[$friend->getUserId2()] = $userCRUD->read($friend->getUserId2());
				} elseif ($friend->getStatus() === "yes") {
					if ($friendCRUD->readLink($_SESSION['id'], $friend->getUserId2())) {
						$friends[$friend->getUserId2()] = $userCRUD->read($friend->getUserId2());
					}
				} else {
					throw new Exception('Erreur dans la lecture de la liste d\'amis');
				}	
			}
		} else {
			$this->setMessage('Vous n\'avez pas encore d\'ami, dépéchez vous d\'en ajouter');
		}
		$userCRUD = new UserCRUD();
		$allUsers = $userCRUD->readAll();

		if (isset($allUsers)) {
			foreach ($listFriends as $friend) {
				unset($allUsers[$friend->getuserId2()]);
			}
			unset($allUsers[$_SESSION['id']]);
			require('view/backend/myFriendView.php');
		} else {
			throw new Exception('Impossible de récupérer les utilisateurs');
		}	
	}

	public function newGroupView() {

		$userManager = new UserManager();
		$users = $userManager->getAll();

		require('view/backend/newGroupView.php');
	}
}