<?php

	require_once('model/TextContent.php');
	require_once('model/DBAccess.php');
	require_once('model/PostManager.php');
	require_once('model/CommentManager.php');
	require_once('model/GroupManager.php');	
	require_once('model/Group.php');		
	require_once('model/UserManager.php');
	require_once('model/LinkGroupManager.php');
	require_once('model/LinkGroup.php');
	require_once('model/LinkFriendManager.php');
	require_once('model/LinkFriend.php');
	require_once('model/Post.php');
	require_once('model/Comment.php');
	require_once('model/User.php');


class LinkGroupCRUD {
	
	public function add($userApplicant, $newFriend)
	{
		$linkFriendManager = new LinkFriendManager();

		if (!$linkFriendManager->existLink($newFriend, $userApplicant)) {

			if (!$linkFriendManager->existLink($userApplicant, $newFriend)) {
			    $Applicant = new LinkFriend(['userId1' => $userApplicant, 'userId2' => $newFriend, 'status' => "yes"]);	
				$Friend = new LinkFriend(['userId1' => $newFriend, 'userId2' => $userApplicant, 'status' => "no"]);	
			    
			    $user1 = $linkFriendManager->add($Applicant);
			    $user2 = $linkFriendManager->add($Friend);
			    if (isset($user1, $user2)) {
				    return $user1;
				}
			} else {
	    		$Applicant = new LinkFriend(['userId1' => $userApplicant, 'userId2' => $newFriend, 'status' => "yes"]);	
	    		$user1 = $linkFriendManager->update($Applicant);
	    		if ($user1 === 'ok') {
	    			return $user1;
	    		}	
	    	}
	    } else {
	    	throw new Exception('Demander invalide : lien déjà présent');
	    }
	}

	public function readGroups($userId) {
		$linkGroupManager = new LinkGroupManager();
		$listGroups = $linkGroupManager->getGroups($userId);
		if ($listGroups != NULL) {
			foreach ($listGroups as $group) {
				
				$linkGroups[$group->getGroupId()] = $group;
			}
		    return $linkGroups;
	    } else {
	    	return 'none';
	    }
	}

	public function readLink($userId, $groupId) {
		$linkGroupManager = new LinkGroupManager();
		$link = $linkGroupManager->existLink($userId, $groupId);
		if (isset($link)) {
			return $link->getStatus();
		}
	}

	public function delete($groupId) {	
		$linkGroupManager = new LinkGroupManager();
		$delete = $linkGroupManager->delete($_SESSION['id'], $groupId);
		if ($delete === 'ok') {
			$groupManager = new GroupManager();
			$groupManager->removeMember($groupId);
			return 'ok';
		} else {
	    	throw new Exception('Erreur : impossible de supprimer le lien');
	    }
	}

	public function deleteAll() {
		$groups = $this->readGroups($_SESSION['id']);
		if ($groups != 'none') {
			foreach ($groups as $groupId => $group) {
				$this->delete($groupId);
			}
		}
	}
}