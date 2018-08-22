<?php

	require_once('model/TextContent.php');
	require_once('model/DBAccess.php');
	require_once('model/PostManager.php');
	require_once('model/CommentManager.php');
	require_once('model/UserManager.php');
	require_once('model/Post.php');
	require_once('model/Comment.php');
	require_once('model/User.php');


class UserCRUD {
	
	public function add($pseudo, $mdp)
	{
	    $user = new User(['pseudo' => $pseudo, 'mdp' => $mdp]);	

	    $userManager = new UserManager();
	    if ($userManager->exists($pseudo)){
	    	return 'exist';
	    } else { 
	    	return $userManager->add($user);
		}
	}

	public function editPseudo($newPseudo) {
	    if(strlen($newPseudo) < 25 && strlen($newPseudo) > 8) {
	        $userManager = new UserManager();
	        $user = $userManager->get($_SESSION['id']);
	        $user->setPseudo($newPseudo);
	        $userManager->update($user);
	        $_SESSION['pseudo'] = $newPseudo;
	        $message = 'Le nouveau pseudo a bien été enregistré';
	    } else {
        	$message = 'Le pseudo renseigné n\'est pas compris entre 8 et 15 caractères';
    	}
    	require('view/backend/backOffice.php');
	}

	public function editMdp($oldMdp, $newMdp) {
	    $userManager = new userManager();
	    $user = $userManager->get(intval($_SESSION['id']));
	    if ($user->getMdp() === $oldMdp) {
	        if(strlen($newMdp) < 25 && strlen($newMdp) > 8) {
	        $user->setMdp($newMdp);
	        $userManager->update($user);
	        $message = 'Le nouveau mot de passe a bien été enregistré';
	    	} else {
	        	$message = 'Le mot de passe renseigné n\'est pas compris entre 8 et 15 caractères';
	    	}
	    } else {
	        $message = 'L\'ancien mot de passe renseigné n\'est pas le bon';
		}
	    require('view/backend/backOffice.php');
	}

	public function read($info, $mdp = NULL) {
		$userManager = new UserManager();
		if ($userManager->exists($info)) {
			$user = $userManager->get($info);
			if ($mdp !== NULL) {
				if ($user->getMdp() == $mdp) {
					return $user;
				}
			} else {
				return $user;
			}
			
		}
	}

	public function readAll() {
		$userManager = new UserManager();
		$usersList = $userManager->getAll();
		foreach ($usersList as $user) {
			if ($user->getAcompte() == 'on') {
				$allUsers[$user->getId()] = $user;
			}
		}
		return $allUsers;
	}

	public function delete() {
		$userManager = new UserManager();
		$delete1 = $userManager->delete($_SESSION['id']);
		$linkGroupCRUD = new LinkGroupCRUD();
		$delete2 = $linkGroupCRUD->deleteAll();
		$linkFriendCRUD = new LinkFriendCRUD();
		$delete3 = $linkFriendCRUD->deleteAll();
		$this->logOut();
		return 'ok';
	}


	public function logOut() {	
		session_destroy();
	}
}