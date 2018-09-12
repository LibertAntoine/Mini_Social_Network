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

class LinkReportingCRUD {
	
	public function add($userId, $commentId) {
		$linkReporting = new LinkReporting(['userId' => $userId, 'commentId' => $commentId]);
		$linkReportingManager = new LinkReportingManager();	
		$link = $linkReportingManager->add($linkReporting);
		if ($link) {
			$commentManager = new CommentManager();
			$commentManager->Reporting($commentId);
			return $link;
		}
	}

	public function readReporters($commentId) {
		$linkReportingManager = new LinkReportingManager();
		$listReports = $linkReportingManager->getComments($commentId);
		if ($listReports != NULL) {
			$reporters = [];
			foreach ($listReports as $report) {
				array_push($reporters, $report->getUserId());
			}
		    return $reporters;
	    } else {
	    	return 'none';
	    }
	}


	public function readLink($userId, $commentId) {
		$linkReportingManager = new LinkGroupManager();
		$link = $linkReportingManager->existLink($userId, $commentId);
		if (isset($link)) {
			return $link;
		}
	}

	public function delete($userId, $commentId) {	
		$linkReportingManager = new LinkReportingManager();
		$delete = $linkReportingManager->delete($userId, $commentId);
		if ($delete === 'ok') {
			$commentManager = new CommentManager();
			$commentManager->removeReporting($commentId);
			return 'ok';
		} else {
	    	throw new Exception('Erreur : impossible de supprimer le lien');
	    }
	}


	public function deleteAll($commentId) {	
		$linkReportingManager = new LinkReportingManager();
		$delete = $linkReportingManager->deleteAllComment($commentId);
		if ($delete === 'ok') {
			$commentManager = new CommentManager();
			$commentManager->removeReporting($commentId);
			return 'ok';
		} else {
	    	throw new Exception('Erreur : impossible de supprimer le lien');
	    }
	}
}