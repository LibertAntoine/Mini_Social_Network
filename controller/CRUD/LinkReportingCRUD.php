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


class LinkReportingCRUD {
	
	public function add($userId, $commentId)
	{

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

	public function delete($commentId) {	
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