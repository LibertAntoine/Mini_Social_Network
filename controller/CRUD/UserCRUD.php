<?php

	namespace controller\CRUD;

	use \model\TextContent;
    use \model\DBAccess;
    use \model\Group;
    use \model\GroupManager;
    use \model\Post;   
    use \model\PostManager;
    use \model\Comment;
    use \model\CommentManager;
    use \model\User;
    use \model\UserManager;
    use \model\LinkGroup;
    use \model\LinkGroupManager;
    use \model\LinkFriend;
    use \model\LinkFriendManager;
    use \model\LinkReporting;
    use \model\LinkReportingManager;

class UserCRUD {
	
	public function add($pseudo, $mdp) {
		$pass_hache = password_hash($mdp, PASSWORD_DEFAULT);
	    $user = new User(['pseudo' => $pseudo, 'mdp' => $pass_hache]);	
	    $userManager = new UserManager();
	    if (!$userManager->exists($pseudo)){
	    	return $userManager->add($user);
		}
	}

	public function updatePseudo($newPseudo) {
        $userManager = new UserManager();
        $user = $userManager->get($_SESSION['id']);
        $user->setPseudo($newPseudo);
        $user = $userManager->update($user);
        return $user;
	}

	public function updateMdp($newMdp) {
	    $userManager = new userManager();
	    $user = $userManager->get(intval($_SESSION['id']));
	    $pass_hache = password_hash($newMdp, PASSWORD_DEFAULT);
	    $user->setMdp($pass_hache);
	    $user = $userManager->update($user);
	    return $user;
	}

	public function read($info, $mdp = NULL) {
		$userManager = new UserManager();
		if ($userManager->exists($info)) {
			$user = $userManager->get($info);
			if ($mdp !== NULL) {
				$verif = password_verify($mdp, $user->getMdp());
				if ($verif) {
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
			if ($user->getActif() == 1) {
				$allUsers[$user->getId()] = $user;
			}
		}
		return $allUsers;
	}

	public function readName($userId) {
		$userManager = new UserManager();
		if ($userManager->exists($userId)) {
			$user = $userManager->get($userId);
			$pseudo = $user->getPseudo();
			if ($pseudo != NULL) {
				return $pseudo;
			}
		}	
	}


	public function delete() {
		$userManager = new UserManager();
		$delete1 = $userManager->delete($_SESSION['id']);
		$linkGroupCRUD = new LinkGroupCRUD();
		$delete2 = $linkGroupCRUD->deleteAllGroups();
		$linkFriendCRUD = new LinkFriendCRUD();
		$delete3 = $linkFriendCRUD->deleteAll();
		$this->logOut();
		return 'ok';
	}


	public function logOut() {	
		session_destroy();
	}
}