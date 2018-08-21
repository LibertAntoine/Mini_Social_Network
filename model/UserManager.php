<?php


class UserManager extends DBAccess
{

	public function add(User $user) 
  {
		$q = $this->db->prepare("INSERT INTO `projet5_users` (`pseudo`, `mdp`, `creationProfil`, `nbGroup`, `status`, `lastLogin`, `nbPublication`, `nbComment`, `acompte`) VALUES (:pseudo, :mdp, NOW(), '0', 'member', NOW(), '0', '0', 'on');");
      
		$q->bindValue(':pseudo', $user->getPseudo());
    $q->bindValue(':mdp', $user->getMdp());

		$q->execute();

    $user->hydrate([
      'id' => $this->db->lastInsertId()]);

    return $user;
  }

  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM projet5_users')->fetchColumn();
  }

  public function delete($userId)
  {
    $this->db->exec('UPDATE projet5_users SET acompte = "off" WHERE id = '. $userId);
    return 'ok';
  }

 	public function exists($info)
 	{
   	if (is_int($info)) {
      return (bool) $this->db->query('SELECT COUNT(*) FROM projet5_users WHERE id = '.$info)->fetchColumn();
    } else 
    {
      $q = $this->db->prepare('SELECT COUNT(*) FROM projet5_users WHERE pseudo = :pseudo');
    	$q->execute([':pseudo' => $info]);
    	return (bool) $q->fetchColumn();
    }
	}

  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->db->query('SELECT id, pseudo, mdp, DATE_FORMAT(creationProfil, \'%d/%m/%Y à %Hh%imin%ss\') AS creationProfil, nbGroup, status, DATE_FORMAT(lastLogin, \'%d/%m/%Y à %Hh%imin%ss\') AS lastLogin, nbPublication, nbComment, acompte FROM projet5_users WHERE id = '.$info);
      $user = $q->fetch(PDO::FETCH_ASSOC);
    } else 
    {
      $q = $this->db->prepare('SELECT id, pseudo, mdp, DATE_FORMAT(creationProfil, \'%d/%m/%Y à %Hh%imin%ss\') AS creationProfil, nbGroup, status, DATE_FORMAT(lastLogin, \'%d/%m/%Y à %Hh%imin%ss\') AS lastLogin, nbPublication, nbComment, acompte FROM projet5_users WHERE pseudo = :pseudo');
      $q->execute([':pseudo' => $info]);
      
      $user = $q->fetch(PDO::FETCH_ASSOC);
    } 
    return new User($user);
  }

  public function getAll()
  {
    $allUsers = [];
    
    $q = $this->db->query('SELECT id, pseudo, mdp, DATE_FORMAT(creationProfil, \'%d/%m/%Y à %Hh%imin%ss\') AS creationProfil, nbGroup, status, DATE_FORMAT(lastLogin, \'%d/%m/%Y à %Hh%imin%ss\') AS lastLogin, nbPublication, nbComment, acompte FROM projet5_users');
    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
     $allUsers[$data['id']] = new User($data);
    }
    return $allUsers;
  }

  public function getList()
  {
    $users = [];
    
    $q = $this->db->prepare('SELECT id, pseudo, mdp, DATE_FORMAT(creationProfil, \'%d/%m/%Y à %Hh%imin%ss\') AS creationProfil, nbGroup, status, DATE_FORMAT(lastLogin, \'%d/%m/%Y à %Hh%imin%ss\') AS lastLogin, nbPublication, nbComment, acompte FROM projet5_users WHERE status = "visitor" ORDER BY pseudo');
    $q->execute();
    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
     $users[] = new User($data);
    }
    return $users;
  }

  public function getName($userId)
  {
    $users = [];
    
    $q = $this->db->prepare("SELECT pseudo FROM projet5_users WHERE id = $userId");
    $q->execute();
 
     $pseudo = $q->fetch();
     $pseudo = $pseudo[0];
    return $pseudo;
  }
  
  public function update(User $user)
  {
    $q = $this->db->prepare('UPDATE projet5_users SET pseudo = :pseudo, mdp = :mdp, status = :status WHERE id = :id');
    
    $q->bindValue(':pseudo', $user->getPseudo());
    $q->bindValue(':mdp', $user->getMdp());
    $q->bindValue(':status', $user->getStatus());
    $q->bindValue(':id', $user->getId());

    $q->execute();
  }
}