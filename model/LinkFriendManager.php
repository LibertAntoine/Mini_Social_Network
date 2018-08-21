<?php

class LinkFriendManager extends DBAccess
{

	public function add(LinkFriend $linkFriend) 
  {
		$q = $this->db->prepare("INSERT INTO `projet5_linkfriend` (`userId1`, `userId2`, `status`, `linkDate`) VALUES (:userId1, :userId2, :status, NOW());");

		$q->bindValue(':userId1', $linkFriend->getUserId1());
    $q->bindValue(':userId2', $linkFriend->getUserId2());
    $q->bindValue(':status', $linkFriend->getStatus());
		$q->execute();

    $linkFriend->hydrate([
      'id' => $this->db->lastInsertId()]);

    return $linkFriend;
  }

  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM projet5_linkfriend')->fetchColumn();    
  }

  public function delete($userApplicant, $newFriend)
  {
    $q = $this->db->prepare('DELETE FROM projet5_linkfriend WHERE userId1 = :userId1 AND userId2 = :userId2');
    $q->bindValue(':userId2', $userApplicant);
    $q->bindValue(':userId1', $newFriend);
    $q->execute();
    return 'ok';
  }

  public function existLink($userApplicant, $newFriend)
  {
    $q = $this->db->prepare('SELECT COUNT(*) FROM projet5_linkfriend WHERE userId2 = :userId2 AND userId1 = :userId1 AND status = :status');
    $q->bindValue(':userId2', $userApplicant);
    $q->bindValue(':userId1', $newFriend);
    $q->bindValue(':status', 'yes');
    $q->execute();
    return (bool) $q->fetchColumn();
  }

  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->db->query('SELECT id, userId1, userId2, status, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkfriend WHERE id = '.$info);

      $linkGroup = $q->fetch(PDO::FETCH_ASSOC);
    }
    return new LinkGroup($linkGroup);
  }

  public function getFriends($userId)
  {
    $linkFriends = [];
    
    $q = $this->db->prepare(' SELECT id, userId1, userId2, status, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkfriend WHERE userId1 = :userId ORDER BY linkDate');
    $q->bindValue(':userId', $userId);
    $q->execute();

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
     $linkFriends[] = new LinkFriend($data);
    }
    return $linkFriends;
  }

  public function getName($linkGroupId)
  {
    $linkGroups = [];
    
    $q = $this->db->prepare("SELECT pseudo FROM projet5_linkfriend WHERE id = $linkGroupId");
    $q->execute();
 
     $pseudo = $q->fetch();
     $pseudo = $pseudo[0];
    return $pseudo;
  }
  
  public function update(LinkFriend $linkFriend)
  {
    $q = $this->db->prepare('UPDATE projet5_linkfriend SET status = :status WHERE userId1 = :userId1 AND userId2 = :userId2');
    
    $q->bindValue(':userId1', $linkFriend->getUserId1());
    $q->bindValue(':userId2', $linkFriend->getUserId2());
    $q->bindValue(':status', $linkFriend->getStatus());

    $q->execute();

    return 'ok';
  }
}