<?php

class LinkGroupManager extends DBAccess
{

	public function add(LinkGroup $linkGroup) 
  {
		$q = $this->db->prepare("INSERT INTO `projet5_linkfriend` (`userId1`, `userId2`, `status`, `linkDate`) VALUES (:groupId, :userId, 'status', NOW());");

		$q->bindValue(':userId1', $linkGroup->getUserId1());
    $q->bindValue(':userId2', $linkGroup->getUserId2());
    $q->bindValue(':status', $linkGroup->getStatus());
		$q->execute();

    $linkGroup->hydrate([
      'id' => $this->db->lastInsertId()]);
  }

  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM projet5_linkfriend')->fetchColumn();
  }

  public function delete(LinkGroup $linkGroup)
  {
    $this->db->exec('DELETE FROM projet5_linkfriend WHERE id = '.$linkGroup->getId());
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


  public function getList()
  {
    $linkGroups = [];
    
    $q = $this->db->prepare(' SELECT id, userId1, userId2, status, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkfriend WHERE status = "visitor" ORDER BY userId1');
    $q->execute();
    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
     $linkGroups[] = new LinkGroup($data);
    }
    return $linkGroups;
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
  
  public function update(LinkGroup $linkGroup)
  {
    $q = $this->db->prepare('UPDATE projet5_linkfriend SET userId1 = :userId1, userId2 = :userId2, status = :status WHERE id = :id');
    
    $q->bindValue(':userId1', $linkGroup->getUserId1());
    $q->bindValue(':userId2', $linkGroup->getUserId2());
    $q->bindValue(':status', $linkGroup->getStatus());
    $q->bindValue(':id', $linkGroup->getId());

    $q->execute();
  }
}