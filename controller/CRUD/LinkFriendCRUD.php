<?php

	require_once('model/TextContent.php');
	require_once('model/DBAccess.php');
	require_once('model/Post.php');
	require_once('model/PostManager.php');
	require_once('model/Comment.php');
	require_once('model/CommentManager.php');
	require_once('model/Group.php');
	require_once('model/GroupManager.php');	
	require_once('model/User.php');
	require_once('model/UserManager.php');
	require_once('model/LinkGroupManager.php');
	require_once('model/LinkGroup.php');
	require_once('model/LinkFriendManager.php');
	require_once('model/LinkFriend.php');
	require_once('model/LinkReportingManager.php');
	require_once('model/LinkReporting.php');



class LinkFriendCRUD {
	
	public function add($userApplicant, $newFriend)
	{
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