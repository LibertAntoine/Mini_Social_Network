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
	require_once('model/Post.php');
	require_once('model/Comment.php');
	require_once('model/User.php');


class GroupCRUD {
	
	public function add($title, $status, $linkCouvPicture = '', $memberArray)
	{
	    $newGroup = new Group(['title' => $title, 'status' => $status, 'linkCouvPicture' => $linkCouvPicture, 'nbMember' => count($memberArray)]);	

	    $groupManager = new GroupManager();
	    $group = $groupManager->add($newGroup);
	    if ($group) {
		    $groupId = $group->getId();
		    $linkGroupManager = new LinkGroupManager();
		    foreach ($memberArray as $member => $status) {
		    	$linkGroup = new LinkGroup(['groupId' => $groupId, 'userId' => $member, 'status' => $status]);
		    	$linkGroupManager->add($linkGroup);
		    }
		    return $group;
	    } else {
	    	throw new Exception('Impossible d\'enregister le groupe');
	    }
	}

	public function readMine($userId) {
		$linkGroupManager = new LinkGroupManager();
		$linkGroups = $linkGroupManager->getGroups($userId);
		if (isset($linkGroups)) {
			foreach ($linkGroups as $linkGroup) {
				$groups[$linkGroup->getGroupId()] = [$this->read($linkGroup->getGroupId()), $linkGroup->getStatus()];
			}
			if (isset($groups)) {
				return $groups;
			} else {
				throw new Exception('Impossible de récupérer les informations de groupe');
			}
		} else {
			return 'none';
		}


	}

	public function read($info) {
		$groupManager = new GroupManager();
		if ($groupManager->exists($info)) {
			$group = $groupManager->get($info);
			return $group;
		}
	}

	public function delete($id) {	
		$groupManager = new GroupManager();
		$groupManager->delete($id);
	}
}