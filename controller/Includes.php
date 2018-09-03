<?php 

class Includes {

	function __construct($view)
   	{
        $this->$view(); 
    }


	public function groupBar() {
		if (isset($_SESSION['id'])) {
			$linkGroupCRUD = new LinkGroupCRUD();
			$linkGroups = $linkGroupCRUD->readGroups($_SESSION['id']);

			if ($linkGroups != 'none') {
				$groupCRUD = new GroupCRUD();
				foreach ($linkGroups as $groupId => $link) {
					$groups[$groupId] = $groupCRUD->read($groupId);
				}
			}
			require('view/include/groupBar.php');
		}
	}

	public function memberBar() {
		
		if (isset($_GET['id'], $_SESSION['id'])) {
			$groupCRUD = new GroupCRUD();
			$group = $groupCRUD->read(intval($_GET['id']));

			$linkGroupCRUD = new LinkGroupCRUD();
			$members = $linkGroupCRUD->readMembers(intval($_GET['id']));
			
			$userCRUD = new UserCRUD();

			foreach ($members as $memberId => $member) {
				$profils[$memberId] = $userCRUD->read($memberId);
				if ($member->getStatusInt() === 1) {
					$admins[$memberId] = $member;
				} elseif ($member->getStatusInt() === 2) {
					$authors[$memberId] = $member;
				} elseif ($member->getStatusInt() === 3) {
					$commenters[$memberId] = $member;
				} elseif ($member->getStatusInt() === 4) {
					$viewers[$memberId] = $member;
				} else {
					throw new Exception('Erreur de profil utilisateur');
				}
			}
			require('view/include/memberBar.php');
		}
	}

}

?>