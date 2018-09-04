<?php


class GroupManager extends DBAccess {

	public function add(Group $group) 
  {
		$q = $this->db->prepare("INSERT INTO `projet5_groups` (`title`, `public`, `description`, `creationDate`, `lastUpdate`, `nbPost`, `nbMember`, `linkCouvPicture`) VALUES (:title , :public, :description, NOW(), NOW(), :nbPost, :nbMember, :linkCouvPicture);");

    $q->bindValue(':title', $group->getTitle());
    $q->bindValue(':public', $group->getPublic());
    $q->bindValue(':description', $group->getDescription());
    $q->bindValue(':linkCouvPicture', $group->getLinkCouvPicture());
    $q->bindValue(':nbPost', '0');
    $q->bindValue(':nbMember', $group->getNbMember());
		$q->execute();

    $group->hydrate([
      'id' => $this->db->lastInsertId()]);
    return $group;
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
      $q = $this->db->query('SELECT id, title, public, description, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\') AS lastUpdate, nbPost, nbMember, linkCouvPicture FROM projet5_groups WHERE id = '.$info);
      $group = $q->fetch(PDO::FETCH_ASSOC);
    } else 
    {
      $q = $this->db->query('SELECT id, title, public, description, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\') AS lastUpdate, nbPost, nbMember, linkCouvPicture FROM projet5_groups WHERE title ='. $info);
      $group = $q->fetch(PDO::FETCH_ASSOC);
    }
    return new Group($group);
  }

  public function getAllList()
  {
    $groups = [];
    
    $q = $this->db->query('SELECT id, title, public, description, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\'), nbPost, nbMember, linkCouvPicture AS lastUpdate FROM projet5_groups ORDER BY lastUpdate DESC');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $groups[] = new Group($data);
    }
    return $groups;
  }

  public function getFive()
  {
    $groups = [];
    
    $q = $this->db->query('SELECT id, title, public, description, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\'), nbPost, nbMember, linkCouvPicture AS lastUpdate, nbPost FROM projet5_groups WHERE public = 1 ORDER BY lastUpdate DESC LIMIT 0, 5');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $groups[] = new Group($data);
    }
    return $groups;
  }

  public function getBestList()
  {
    $groups = [];
    
    $q = $this->db->query('SELECT id, title, public, description, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(lastUpdate, \'%d/%m/%Y à %Hh%i\'), nbPost, nbMember, linkCouvPicture AS lastUpdate FROM projet5_groups ORDER BY nbPost DESC LIMIT 0, 5');

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

  public function addPost($groupId)
  {
    $q = $this->db->query('UPDATE projet5_groups SET nbPost = nbPost + 1  WHERE id ='. $groupId);
  }

  public function addMember($groupId)
  {
    $q = $this->db->query('UPDATE projet5_groups SET nbMember = nbMember + 1  WHERE id ='. $groupId);
  }

  public function removePost($groupId)
  {
    $q = $this->db->query('UPDATE projet5_groups SET nbPost = nbPost - 1  WHERE id ='. $groupId);
  }

  public function removeMember($groupId)
  {
    $q = $this->db->query('UPDATE projet5_groups SET nbMember = nbMember - 1  WHERE id ='. $groupId);
  }

  public function update(Group $group)
  {
    $q = $this->db->prepare('UPDATE projet5_groups SET title = :title, public = :public, description = :description, lastUpdate = NOW(), nbPost = :nbPost, nbMember = :nbMember, linkCouvPicture = :linkCouvPicture WHERE id = :id');
    
    $q->bindValue(':title', $group->getTitle());
    $q->bindValue(':public', $group->getPublic());
    $q->bindValue(':description', $group->getDescription());
    $q->bindValue(':nbPost', $group->getNbPost());
    $q->bindValue(':nbMember', $group->getNbMember());
    $q->bindValue(':linkCouvPicture', $group->getLinkCouvPicture());
    $q->bindValue(':id', $group->getId());
    $q->execute();

    return $group;
  }
}