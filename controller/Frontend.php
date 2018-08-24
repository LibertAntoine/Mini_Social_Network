<?php session_start();

require_once('controller/View.php');

class Frontend extends View {

	function __construct($view, $param = NULL)
    {
        	$this->$view($param); 
    }
    
	public function mainPageView() {


		require('view/frontend/mainPageView.php');
	}

	public function groupView($groupId) {

		
		$linkGroupManager = new LinkGroupManager();
		$link = $linkGroupManager->access($groupId, $_SESSION['id']);
		if ($link) {
			$groupCRUD = new GroupCRUD();
			$group = $groupCRUD->read($groupId);
			if ($group) {
				$postCRUD = new PostCRUD();
				$posts = $postCRUD->readGroup($groupId);
				if ($posts) {
					if ($posts !== 'none') {
						$commentCRUD = new CommentCRUD();
						$linkReportingCRUD = new LinkReportingCRUD();
						foreach ($posts as $data) {
							$comments[$data->getId()] = $commentCRUD->readPost($data->getId());
							if ($comments[$data->getId()] != 'none') {
								foreach ($comments[$data->getId()] as $comment) {
									$report[$comment->getId()] = $linkReportingCRUD->readReporters($comment->getId());
								}	
							}					
						}
					}
					require('view/frontend/GroupView.php');
				} else {
					throw new Exception('Problème d\'accès aux posts');
				}
			} else {
				throw new Exception('Problème d\'accès au groupe');
			}	
		} else {
			throw new Exception('Accès à cette page non-autorisé');
		}
	}

	public function allPublicGroupView() {

		require('view/frontend/allPublicGroupView.php');

	}
}