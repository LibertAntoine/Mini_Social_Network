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

class CommentCRUD {
	
	public function add($userId, $postId, $groupId, $content) {
	    $newComment  = new Comment(['content' => $content, 'articleId' => $postId, 'groupId' => $groupId, 'userId' => $userId]);	
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
			$linkReportingManager = new LinkReportingManager();
			$linkReportingManager->deleteAllComment($commentId);
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