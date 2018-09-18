<?php 

namespace controller;

    use \controller\CRUD\GroupCRUD;
    use \controller\CRUD\PostCRUD;
    use \controller\CRUD\CommentCRUD;
    use \controller\CRUD\UserCRUD;
    use \controller\CRUD\LinkGroupCRUD;
    use \controller\CRUD\LinkFriendCRUD;
    use \controller\CRUD\LinkReportingCRUD;

class Frontend {

	function __construct($view, $param = NULL)
    {
        $this->$view($param); 
    }
    
	public function mainPageView() {
		$groupCRUD = new GroupCRUD();
		$fiveGroup = $groupCRUD->readFivePublic();
		$includes = new Includes();
		$groupBar = $includes->groupBar();
		require('view/frontend/mainPageView.php');
	}

	public function groupView($groupId) {
		$groupCRUD = new GroupCRUD();
		$group = $groupCRUD->read($groupId);
		if (isset($_SESSION['id'])) {
			$linkGroupCRUD = new LinkGroupCRUD();
			$link = $linkGroupCRUD->read($_SESSION['id'], $groupId);	
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
				$includes = new Includes();
				$memberBar = $includes->memberBar();
				$groupBar = $includes->groupBar();
				require('view/frontend/groupView.php');
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