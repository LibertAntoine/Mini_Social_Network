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


class CommentCRUD {
	
	public function add($userId, $postId, $content)
	{
	    $newComment  = new Comment(['content' => $content, 'articleId' => $postId, 'userId' => $userId]);	

	    $commentManager = new CommentManager();
	    $comment = $commentManager->add($newComment);
		if ($comment) {
			$postManager = new PostManager();
			$postManager->addComment($postId);
			$userManager = new UserManager();
			$userManager->addComment($userId);
			return $comment;
		} else {
			throw new Exception('Impossible d\'ajouter un post');
		}
	}

	public function readPost($postId) {
		$commentManager = new commentManager();
		$comments = $commentManager->getPost($postId);
		if ($comments) {
			return $comments;
		} else {
			return 'none';
		}
	}

	public function read($commentId) {
		$commentManager = new CommentManager();
		if ($commentManager->exists($commentId)) {
			$comment = $commentManager->get($commentId);
			return $comment;
		}
	}

	public function delete($commentId) {
		$comment = $this->read($commentId);
		if ($comment) {
			$commentManager = new CommentManager();
			$commentManager->delete($commentId);
			$postManager = new PostManager();
			$postManager->removeComment($comment->getArticleId());
			$userManager = new UserManager();
			$userManager->removeComment($comment->getUserId());
		}
		
		

		return 'ok';
	}
}