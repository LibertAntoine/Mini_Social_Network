<?php

namespace model;

class LinkFriendManager extends DBAccess {

	public function add(LinkFriend $linkFriend) {
		$q = $this->db->prepare("INSERT INTO `projet5_linkfriend` (`userId1`, `userId2`, `link`, `linkDate`) VALUES (:userId1, :userId2, :link, NOW());");

		$q->bindValue(':userId1', $linkFriend->getUserId1());
    $q->bindValue(':userId2', $linkFriend->getUserId2());
    $q->bindValue(':link', $linkFriend->getLink());
		$q->execute();

    $linkFriend->hydrate([
      'id' => $this->db->lastInsertId()]);

    return $linkFriend;
  }

  public function count() {
    return $this->db->query('SELECT COUNT(*) FROM projet5_linkfriend')->fetchColumn();    
  }

  public function delete($userApplicant, $Friend) {
    $q = $this->db->prepare('DELETE FROM projet5_linkfriend WHERE userId1 = :userId1 AND userId2 = :userId2');
    $q->bindValue(':userId2', $userApplicant);
    $q->bindValue(':userId1', $Friend);
    $q->execute();
    return 'ok';
  }

  public function deleteAll($userId) {
    $q = $this->db->prepare('DELETE FROM projet5_linkfriend WHERE userId1 = :userId OR userId2 = :userId');
    $q->bindValue(':userId', $userId);
    $q->execute();
    return 'ok';
  }

  public function existLink($userApplicant, $newFriend) {
    $q = $this->db->prepare('SELECT COUNT(*) FROM projet5_linkfriend WHERE userId2 = :userId2 AND userId1 = :userId1 AND link = :link');
    $q->bindValue(':userId2', $userApplicant);
    $q->bindValue(':userId1', $newFriend);
    $q->bindValue(':link', 1);
    $q->execute();
    return (bool) $q->fetchColumn();
  }

  public function get($info) {
    if (is_int($info)) {
      $q = $this->db->query('SELECT id, userId1, userId2, link, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkfriend WHERE id = '.$info);

      $linkGroup = $q->fetch(\PDO::FETCH_ASSOC);
    }
    return new LinkGroup($linkGroup);
  }

  public function getFriends($userId) {
    $linkFriends = [];
    
    $q = $this->db->prepare(' SELECT id, userId1, userId2, link, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkfriend WHERE userId1 = :userId ORDER BY linkDate');
    $q->bindValue(':userId', $userId);
    $q->execute();

    while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
     $linkFriends[] = new LinkFriend($data);
    }
    return $linkFriends;
  }

  public function getName($linkGroupId) {
    $linkGroups = [];
    
    $q = $this->db->prepare("SELECT pseudo FROM projet5_linkfriend WHERE id = $linkGroupId");
    $q->execute();
 
     $pseudo = $q->fetch();
     $pseudo = $pseudo[0];
    return $pseudo;
  }
  
  public function update(LinkFriend $linkFriend) {
    $q = $this->db->prepare('UPDATE projet5_linkfriend SET link = :link WHERE userId1 = :userId1 AND userId2 = :userId2');
    
    $q->bindValue(':userId1', $linkFriend->getUserId1());
    $q->bindValue(':userId2', $linkFriend->getUserId2());
    $q->bindValue(':link', $linkFriend->getLink());

    $q->execute();

    return 'ok';
  }
}