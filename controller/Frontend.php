<?php session_start();

require_once('controller/View.php');

class Frontend extends View {

	function __construct($view, $param = NULL)
    {
        	$this->$view($param); 
    }
    
	public function mainPageView() {

		$groupCRUD = new GroupCRUD();
		$fiveGroup = $groupCRUD->readFivePublic();
		$include = new Includes('groupBar');
		require('view/frontend/mainPageView.php');
	}

	public function groupView($groupId) {

			$groupCRUD = new GroupCRUD();
			$group = $groupCRUD->read($groupId);

			if (isset($_SESSION['id'])) {
				$linkGroupManager = new LinkGroupManager();
				$link = $linkGroupManager->access($groupId, $_SESSION['id']);			
			}

			if (isset($link)) {
			$status = $link->getStatusInt();
			$statusString = $link->getStatusString();
			} elseif ($group->getPublic() == 1){
				$status = 10;
			}

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
					
					$userCRUD = new UserCRUD();
					$include = new Includes('memberBar');
					$include = new Includes('groupBar');
					require('view/frontend/GroupView.php');
				} else {
					throw new Exception('Problème d\'accès aux posts');
				}
			} else {
				throw new Exception('Problème d\'accès au groupe');
			}	

	}

	public function allPublicGroupView() {

		require('view/frontend/allPublicGroupView.php');

	}
}