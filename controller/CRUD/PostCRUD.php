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

class PostCRUD {
	
	public function add($title, $content, $groupId, $userId) {
	    $newPost  = new Post(['title' => $title, 'content' => $content, 'groupId' => $groupId, 'userId' => $userId]);	
	    $postManager = new PostManager();
	    $post = $postManager->add($newPost);
		if ($post) {
			$groupManager = new GroupManager();
			$groupManager->addPost($groupId);
			$userManager = new UserManager();
			$userManager->addPost($userId);
			return $post;
		} else {
			throw new Exception('Impossible d\'ajouter un post');
		}
	}

	public function readGroup($groupId) {
		$postManager = new PostManager();
		$posts = $postManager->getGroup($groupId);
		if ($posts) {
			return $posts;
		} else {
			return 'none';
		}	
	}

	public function read($info) {
		$postManager = new PostManager();
		if ($postManager->exists($info)) {
			$post = $postManager->get($info);
			return $post;
		}
	}

	public function update($title, $content, $postId) {
	    $newPost = $this->read($postId);
	    if ($newPost instanceof Post) {
	    	$newPost->setTitle($title);
			$newPost->setContent($content);
	    	$postManager = new PostManager();
	    	$post = $postManager->update($newPost);
			if ($post instanceof Post) {
				return $post;
			} 
	    }
	}

	public function delete($postId) {
		$post = $this->read($postId);
		if ($post) {
			$groupManager = new GroupManager();
			$groupManager->removePost($post->getGroupId());
			$commentCRUD = new CommentCRUD();
			$comments = $commentCRUD->readPost($postId);
			if ($comments != 'none') {
				foreach ($comments as $comment) {
					$commentCRUD->delete($comment->getId());
				}
			}
			$userManager = new UserManager();
			$userManager->removePost($post->getUserId());
			$postManager = new PostManager();
			$postManager->delete($postId);
			return $post->getGroupId();
		}
	}
}