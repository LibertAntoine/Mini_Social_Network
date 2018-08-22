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
	
	public function add($title, $status, $linkCouvPicture = '', $adminId, $memberArray)
	{
	    $newGroup = new Group(['title' => $title, 'status' => $status, 'linkCouvPicture' => $linkCouvPicture, 'nbMember' => 1]);	
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
			$linkGroupCRUD->add($adminId, $group->getId(), 'admin');
		    return $group;
	    	} else {
	    		throw new Exception('Impossible d\'enregister le groupe');
	    	}
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