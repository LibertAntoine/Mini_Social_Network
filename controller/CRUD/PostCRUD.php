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


class PostCRUD {
	
	public function add($title, $content, $groupId, $userId)
	{
	    $newPost  = new Post(['title' => $title, 'content' => $content, 'groupId' => $groupId, 'userId' => $userId]);	

	    $postManager = new PostManager();
	    $post = $postManager->add($newPost);
		if ($post) {
			$groupManager = new GroupManager();
			$groupManager->addPost($groupId);

		} else {
			throw new Exception('Impossible d\'ajouter un post');
		}
		return $post;
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

	public function read($title) {
		$postManager = new PostManager();
		if ($postManager->exists($title)) {
			$post = $postManager->get($title);
			return $post;
		}
	}

	public function delete($id) {	
		$postManager = new PostManager();
		$postManager->delete($id);
	}
}