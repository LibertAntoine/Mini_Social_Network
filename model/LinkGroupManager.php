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


  public function exists($linkId)
  {
    $q = $this->db->prepare('SELECT `id`, `groupId`, `userId`, `status`, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkgroupuser WHERE id = :id');
    $q->bindValue(':id', $linkId);
    $q->execute();

    $linkGroup = $q->fetch(PDO::FETCH_ASSOC);
    return new LinkGroup($linkGroup);
  }



  public function existLink($userId, $groupId)
  {
    $q = $this->db->prepare('SELECT `id`, `groupId`, `userId`, `status`, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkgroupuser WHERE userId = :userId AND groupId = :groupId');
    $q->bindValue(':userId', $userId);
    $q->bindValue(':groupId', $groupId);
    $q->execute();

    $linkGroup = $q->fetch(PDO::FETCH_ASSOC);
    return new LinkGroup($linkGroup);
  }

  public function delete($userId, $groupId)
  {
    $q = $this->db->prepare('DELETE FROM projet5_linkgroupuser WHERE userId = :userId AND groupId = :groupId');
    $q->bindValue(':userId', $userId);
    $q->bindValue(':groupId', $groupId);
    $q->execute();
    return 'ok';
  }

  public function deleteAll($userId)
  {
    $q = $this->db->prepare('DELETE FROM projet5_linkgroupuser WHERE userId = :userId');
    $q->bindValue(':userId', $userId);
    $q->execute();
    return 'ok';
  }

  public function access($groupId, $userId)
  {
    $q = $this->db->prepare('SELECT `id`, `groupId`, `userId`, `status`, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM `projet5_linkgroupuser` WHERE `groupId` = :groupId AND `userId` = :userId');
    $q->bindValue(':userId', $userId);
    $q->bindValue(':groupId', $groupId);
    $q->execute();
      $linkGroup = $q->fetch(PDO::FETCH_ASSOC);
      return new LinkGroup($linkGroup);
  }

  public function getGroups($userId)
  {
    $linkGroups = [];

    $q = $this->db->prepare('SELECT id, groupId, userId, status, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkgroupuser WHERE userId = :userId ORDER BY linkDate');
    $q->bindValue(':userId', $userId);
    $q->execute();

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
     $linkGroups[] = new LinkGroup($data);
    }
    return $linkGroups;
  }

  public function getMembers($groupId)
  {
    $linkUsers = [];

    $q = $this->db->prepare('SELECT id, groupId, userId, status, DATE_FORMAT(linkDate, \'%d/%m/%Y à %Hh%imin%ss\') AS linkDate FROM projet5_linkgroupuser WHERE groupId = :groupId ORDER BY linkDate');
    $q->bindValue(':groupId', $groupId);
    $q->execute();

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
     $linkUsers[] = new LinkGroup($data);
    }
    return $linkUsers;
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