<?php

class LinkGroupManager extends DBAccess
{

	public function add(LinkGroup $linkGroup) 
  {
		$q = $this->db->prepare("INSERT INTO `projet5_linkgroupuser` (`groupId`, `userId`, `status`, `linkDate`) VALUES (:groupId, :userId, :status, NOW());");

		$q->bindValue(':groupId', $linkGroup->getGroupId());
    $q->bindValue(':userId', $linkGroup->getUserId());
    $q->bindValue(':status', $linkGroup->getStatus());
		$q->execute();

    $linkGroup->hydrate([
      'id' => $this->db->lastInsertId()]);
  }

  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM projet5_linkgroupuser')->fetchColumn();
  }

  public function delete(LinkGroup $linkGroup)
  {
    $this->db->exec('DELETE FROM projet5_linkgroupuser WHERE id = '.$linkGroup->getId());
  }

  public function access($groupId, $userId)
  {
    $q = $this->db->query('SELECT `id`, `groupId`, `userId`, `status`, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM `projet5_linkgroupuser` WHERE `groupId` = '. $groupId);
      $linkGroup = $q->fetch(PDO::FETCH_ASSOC);
      return new LinkGroup($linkGroup);
  }


  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->db->query('SELECT id, groupId, userId, status, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkgroupuser WHERE id = '.$info);
      $linkGroup = $q->fetch(PDO::FETCH_ASSOC);
    }
    return new LinkGroup($linkGroup);
  }


  public function getList()
  {
    $linkGroups = [];
    
    $q = $this->db->prepare(' SELECT id, groupId, userId, status, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkgroupuser WHERE status = "visitor" ORDER BY userId');
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
    
    $q = $this->db->prepare("SELECT pseudo FROM projet5_linkgroupuser WHERE id = $linkGroupId");
    $q->execute();
 
     $pseudo = $q->fetch();
     $pseudo = $pseudo[0];
    return $pseudo;
  }
  
  public function update(LinkGroup $linkGroup)
  {
    $q = $this->db->prepare('UPDATE projet5_linkgroupuser SET groupId = :groupId, userId = :userId, status = :status WHERE id = :id');
    
    $q->bindValue(':groupId', $linkGroup->getGroupId());
    $q->bindValue(':userId', $linkGroup->getUserId());
    $q->bindValue(':status', $linkGroup->getStatus());
    $q->bindValue(':id', $linkGroup->getId());

    $q->execute();
  }
}