<?php


class GroupManager extends DBAccess {

	public function add(Group $group) 
  {
		$q = $this->db->prepare("INSERT INTO `projet5_groups` (`title`, `status`, `creationDate`, `lastUpdate`, 'nbPost') VALUES (:title , :status, NOW(), NOW(), :nbPost)");

    $q->bindValue(':title', $group->getTitle());
    $q->bindValue(':status', $group->getStatus());
    $q->bindValue(':nbPost', '0');
		$q->execute();

    $group->hydrate([
      'id' => $this->db->lastInsertId()]);
  }

  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM projet5_groups')->fetchColumn();
  }

  public function delete($groupId)
  {
    $this->db->exec('DELETE FROM projet5_groups WHERE id = '.$groupId);
  }

 	public function exists($info)
 	{
   	if (is_int($info)) 
    {
      return (bool) $this->db->query('SELECT COUNT(*) FROM projet5_groups WHERE id = '.$info)->fetchColumn();
    } else 
    {
    	$q = $this->db->prepare('SELECT COUNT(*) FROM projet5_groups WHERE title = :title');
    	$q->execute([':title' => $info]);
    	return (bool) $q->fetchColumn();
    }
  }

  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->db->query('SELECT id, title, status, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\') AS lastUpdate, nbPost FROM projet5_groups WHERE id = '.$info);
      $group = $q->fetch(PDO::FETCH_ASSOC);
    } else 
    {
     	$q = $this->db->prepare('SELECT id, title, status, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\') AS lastUpdate, nbPost FROM projet5_groups WHERE title = :title');
      $q->execute([':title' => $info]);
      $group = $q->fetch(PDO::FETCH_ASSOC);
    }
    return new Group($group);
  }

  public function getTitle($groupId)
  {
    $q = $this->db->query('SELECT title FROM projet5_groups WHERE id = '. $groupId);
    $info = $q->fetch(PDO::FETCH_ASSOC);

    return $info['title'];
  }


  public function getAllList()
  {
    $groups = [];
    
    $q = $this->db->query('SELECT id, title, status, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\'), nbPost AS lastUpdate FROM projet5_groups ORDER BY lastUpdate DESC');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $groups[] = new Group($data);
    }
    return $groups;
  }

  public function getRecentList()
  {
    $groups = [];
    
    $q = $this->db->query('SELECT id, title, status, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\'), nbPost AS lastUpdate, nbPost FROM projet5_groups ORDER BY lastUpdate DESC LIMIT 0, 5');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $groups[] = new Group($data);
    }
    return $groups;
  }

  public function getBestList()
  {
    $groups = [];
    
    $q = $this->db->query('SELECT id, title, status, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\'), nbPost AS lastUpdate FROM projet5_groups ORDER BY nbPost DESC LIMIT 0, 5');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $articles[] = new Group($data);
    }
    return $articles;
  }
  
  public function updateNbPost($groupId, $action)
  {
    if ($action === "add") {
    $q = $this->db->prepare('UPDATE projet5_groups SET nbPost = nbPost + 1 WHERE id = :id');

    } elseif ($action === "remove") {
    $q = $this->db->prepare('UPDATE projet5_groups SET nbPost = nbPost - 1 WHERE id = :id');
    }
    $q->bindValue(':id', $groupId);
    $q->execute();
  }

  public function update(Group $group)
  {
    $q = $this->db->prepare('UPDATE projet5_groups SET title = :title, status = :status, lastUpdate = NOW(), nbPost = :nbPost WHERE id = :id');
    
    $q->bindValue(':title', $group->getTitle());
    $q->bindValue(':status', $group->getContent());
    $q->bindValue(':nbPost', $group->getNbComment());
    $q->bindValue(':id', $group->getId());
    $q->execute();
  }
}