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



class GroupCRUD {
	
	public function add($title, $public, $description = '', $linkCouvPicture, $adminId, $memberArray)
	{
		if ($linkCouvPicture === NULL) {
			$linkCouvPicture = 0;
		} elseif ($linkCouvPicture === "jpeg") {
			$linkCouvPicture = 1;
		} elseif ($linkCouvPicture === "png") {
			$linkCouvPicture = 2;
		} elseif ($linkCouvPicture === "jpg") {
			$linkCouvPicture = 3;
		} else {
			throw new Exception('Fichier fournit au mauvais format.');
		}
		
	    $newGroup = new Group(['title' => $title, 'public' => $public, 'description' => $description, 'linkCouvPicture' => $linkCouvPicture, 'nbMember' => 0]);

	    $groupManager = new GroupManager();
	    $group = $groupManager->add($newGroup);
	    if ($group) {
		    $linkGroupCRUD = new LinkGroupCRUD();
		    if ($memberArray != NULL) {
			    foreach ($memberArray as $fonction => $list) {
			    	foreach ($list as $data) {
			    	$member = unserialize($data);
			    	$linkGroupCRUD->add($member->getId(), $group->getId(), $fonction);
			    }
			}
			$linkGroupCRUD->add($adminId, $group->getId(), 1);
		    return $group;
	    	} else {
	    		throw new Exception('Impossible d\'enregister le groupe');
	    	}
		}	
	}

	public function update($groupId, $title, $description = '')
	{	
		$group = $this->read($groupId);
			if ($group instanceof Group) {
			if ($group->getLinkCouvPicture() != 0) {
				rename ("public/pictures/couv/" . str_replace(' ', '_', $group->getTitle()) . "." . $group->getLinkCouvPictureString(), "public/pictures/couv/" . str_replace(' ', '_', $title) . "." . $group->getLinkCouvPictureString());
			}
			$group->setTitle($title);
			$group->setDescription($description);
			$groupManager = new GroupManager();
			$newgroup = $groupManager->update($group);
			if ($newgroup instanceof Group) {
				return $newgroup;
			}
		}	
	}

	public function updatePublic(Group $group)
	{	
		$groupManager = new GroupManager();
		if ($group->getPublic() === 0) {
			$group->setPublic(1);
			$linkGroupManager = new LinkGroupManager();
			$linkGroupManager->deletePublicLink($group->getId());
			$group->setNbMember($linkGroupManager->countLink($group->getId()));
		} elseif ($group->getPublic() === 1) {
			$group->setPublic(0);
		}
		$newgroup = $groupManager->update($group);
		if ($newgroup instanceof Group) {
			return $newgroup;
		}	
	}

	public function read($info) {
		$groupManager = new GroupManager();
		if ($groupManager->exists($info)) {
			$group = $groupManager->get($info);
			return $group;
		}
	}





	public function delete($groupId) {
		$group = $this->read($groupId);
		if ($group)	{
			$link = $group->getLinkCouvPicture();
			unlink($link);
			$linkGroupCRUD = new LinkGroupCRUD();
			$linkGroupCRUD->deleteAllMembers($groupId);
			$postCRUD = new PostCRUD();
			$posts = $postCRUD->readGroup($groupId);
			if ($posts != 'none') {
				foreach ($posts as $post) {
					$postCRUD->delete($post->getId());
				}
			}
			$groupManager = new GroupManager();
			$groupManager->delete($groupId);
			return 'ok';
		}
	}
}