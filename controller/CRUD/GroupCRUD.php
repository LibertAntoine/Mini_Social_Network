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

class GroupCRUD {
	
	public function add($title, $public, $description = '', $linkCouvPicture, $adminId) {
		
        $memberArray = [];
        if ($_SESSION['admin'] != NULL) {
           	$memberArray[1] = $_SESSION['admin'];
        }
        if ($_SESSION['author'] != NULL) {
            $memberArray[2] = $_SESSION['author'];
        }
        if ($_SESSION['commenter'] != NULL) {
            $memberArray[3] = $_SESSION['commenter'];
        }
        if ($_SESSION['viewer'] != NULL) {
            $memberArray[4] = $_SESSION['viewer'];
        }

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
		    }
		    $linkGroupCRUD->add($adminId, $group->getId(), 1);
		    return $group;
		}	
	}

	public function update($groupId, $title, $description = '') {	
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

	public function updatePublic(Group $group) {	
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

	public function readFivePublic() {
		$groupManager = new GroupManager();
		$fiveGroup = $groupManager->getFive();
		if ($fiveGroup) {
			return $fiveGroup;
		}
	}

	public function delete($groupId) {
		$group = $this->read($groupId);
		if ($group)	{
			$link = "public/pictures/couv/". str_replace(' ', '_', $group->getTitle()) . "." .$group->getLinkCouvPictureString();
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