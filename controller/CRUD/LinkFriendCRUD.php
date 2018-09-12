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

class LinkFriendCRUD {
	
	public function add($userApplicant, $newFriend) {
		$linkFriendManager = new LinkFriendManager();
		if (!$linkFriendManager->existLink($newFriend, $userApplicant)) {
			if (!$linkFriendManager->existLink($userApplicant, $newFriend)) {
			    $Applicant = new LinkFriend(['userId1' => $userApplicant, 'userId2' => $newFriend, 'link' => 1]);	
				$Friend = new LinkFriend(['userId1' => $newFriend, 'userId2' => $userApplicant, 'link' => 0]);	
			    $user1 = $linkFriendManager->add($Applicant);
			    $user2 = $linkFriendManager->add($Friend);
			    if (isset($user1, $user2)) {
				    return $user1;
				}
			} else {
	    		$Applicant = new LinkFriend(['userId1' => $userApplicant, 'userId2' => $newFriend, 'link' => 1]);	
	    		$user1 = $linkFriendManager->update($Applicant);
	    		if ($user1 === 'ok') {
	    			return $user1;
	    		}	
	    	}
	    } else {
	    	throw new Exception('Demander invalide : lien déjà présent');
	    }
	}
	
	public function readFriends() {
		$linkFriendManager = new LinkFriendManager();
		$linkFriends = $linkFriendManager->getFriends($_SESSION['id']);
		if (isset($linkFriends)) {
		    return $linkFriends;
	    } else {
	    	return 'none';
	    }
	}

	public function readLink($userApplicant, $newFriend) {
		$linkFriendManager = new LinkFriendManager();
		return $linkFriendManager->existLink($userApplicant, $newFriend);
	}

	public function delete($idFriend) {	
		$linkFriendManager = new LinkFriendManager();
		$delete1 = $linkFriendManager->delete($_SESSION['id'], $idFriend);
		$delete2 = $linkFriendManager->delete($idFriend, $_SESSION['id']);
		if ($delete1 === 'ok' AND $delete2 === 'ok') {
			return 'ok';
		} else {
	    	throw new Exception('Demander invalide : lien déjà présent');
	    }
	}

	public function deleteAll() {	
		$linkFriendManager = new LinkFriendManager();
		$delete1 = $linkFriendManager->deleteAll($_SESSION['id']);
		if ($delete1 === 'ok') {
			return 'ok';
		} else {
	    	throw new Exception('Demander invalide : lien déjà présent');
	    }
	}
}