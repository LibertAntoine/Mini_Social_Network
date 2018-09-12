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

class LinkGroupCRUD {
	
	public function add($userId, $groupId, $status) {
		$linkGroup = new LinkGroup(['groupId' => $groupId, 'userId' => $userId, 'status' => $status]);
		$linkGroupManager = new LinkGroupManager();	
		$link = $linkGroupManager->add($linkGroup);
		if ($link) {
			$groupManager = new GroupManager();
			$groupManager->addMember($groupId);
			$userManager = new UserManager();
			$userManager->addGroup($userId);
		}
	}

	public function read($userId, $groupId) {
		$linkGroupManager = new LinkGroupManager();
		$link = $linkGroupManager->existLink($userId, $groupId);
		if (isset($link)) {
			return $link;
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

	public function readMembers($groupId) {
		$linkGroupManager = new LinkGroupManager();
		$listUsers = $linkGroupManager->getMembers($groupId);
		if ($listUsers != NULL) {
			foreach ($listUsers as $user) {
				$linkUsers[$user->getUserId()] = $user;
			}
		    return $linkUsers;
	    } else {
	    	return 'none';
	    }
	}

	public function readLink($userId, $groupId) {
		$linkGroupManager = new LinkGroupManager();
		$link = $linkGroupManager->existLink($userId, $groupId);
		if (isset($link)) {
			return $link->getStatusInt();
		}
	}

	public function update($linkGroup, $status) {
		$linkGroupManager = new LinkgroupManager();
		if ($linkGroupManager->exists($linkGroup->getId())) {
			$linkGroup->setStatus($status);
			$linkGroupManager->update($linkGroup);
			return 'ok';
		}
	}

	public function delete($userId ,$groupId) {	
		$linkGroupManager = new LinkGroupManager();
		$delete = $linkGroupManager->delete($userId, $groupId);
		if ($delete === 'ok') {
			$groupManager = new GroupManager();
			$groupManager->removeMember($groupId);
			$userManager = new UserManager();
			$userManager->removeGroup($userId);
			return 'ok';
		} else {
	    	throw new Exception('Erreur : impossible de supprimer le lien');
	    }
	}

	public function deleteAllGroups() {
		$groups = $this->readGroups($_SESSION['id']);
		if ($groups != 'none') {
			foreach ($groups as $groupId => $group) {
				$this->delete($_SESSION['id'], $groupId);
			}
		}
	}

	public function deleteAllMembers($groupId) {
		$members = $this->readMembers($groupId);
		if ($members != 'none') {
			foreach ($members as $userId => $user) {
				$this->delete($userId, $groupId);
			}
		} else {
			throw new Exception('Erreur');
		}
	}
}