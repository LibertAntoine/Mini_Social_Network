<?php


class PostManager extends DBAccess {

	public function add(Post $post) 
  {
		$q = $this->db->prepare("INSERT INTO `projet5_posts` (`title`, `userId`, `content`, `creationDate`, `updateDate`, `nbComment`, `groupId`) VALUES (:title , :userId, :content, NOW(), NOW(), :nbComment, :groupId)");

		$q->bindValue(':userId', $post->getUserId());
    $q->bindValue(':title', $post->getTitle());
    $q->bindValue(':content', $post->getContent());
    $q->bindValue(':groupId', $post->getGroupId());
    $q->bindValue(':nbComment', 0);
		$q->execute();

    $post->hydrate([
      'id' => $this->db->lastInsertId()]);
    return $post;
  }

  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM projet5_posts')->fetchColumn();
  }

  public function delete($postId)
  {
    $this->db->exec('DELETE FROM projet5_posts WHERE id = '.$postId);
  }

 	public function exists($info)
 	{
   	if (is_int($info)) 
    {
      return (bool) $this->db->query('SELECT COUNT(*) FROM projet5_posts WHERE id = '.$info)->fetchColumn();
    } else 
    {
    	$q = $this->db->prepare('SELECT COUNT(*) FROM projet5_posts WHERE title = :title');
    	$q->execute([':title' => $info]);
    	return (bool) $q->fetchColumn();
    }
  }


public function getGroup($groupId)
  {

    $posts = [];
    $q = $this->db->query('SELECT id, userId, groupId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment FROM projet5_posts WHERE groupId = '.$groupId);
  
    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $posts[] = new Post($data);
    }
    return $posts;
  }

  public function get($info)
  {
    if (is_int($info))
    {

      $q = $this->db->query('SELECT id, userId, groupId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment, groupId FROM projet5_posts WHERE id = '.$info);

      $post = $q->fetch(PDO::FETCH_ASSOC);
    } else 
    {
     	$q = $this->db->prepare('SELECT id, userId, groupId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment, groupId FROM projet5_posts WHERE title = :title');
      $q->execute([':title' => $info]);
      $post = $q->fetch(PDO::FETCH_ASSOC);
    }
    return new post($post);
  }

  public function getTitle($postId)
  {
    $q = $this->db->query('SELECT title FROM projet5_posts WHERE id = '. $postId);
    $info = $q->fetch(PDO::FETCH_ASSOC);

    return $info['title'];
  }


  public function getAllList()
  {
    $posts = [];
    
    $q = $this->db->query('SELECT id, userId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment, groupId FROM projet5_posts ORDER BY updateDate DESC');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $posts[] = new Post($data);
    }
    return $posts;
  }

  public function getRecentList()
  {
    $posts = [];
    
    $q = $this->db->query('SELECT id, userId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment, groupId FROM projet5_posts ORDER BY updateDate DESC LIMIT 0, 5');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $posts[] = new Post($data);
    }
    return $posts;
  }

  public function getBestList()
  {
    $posts = [];
    
    $q = $this->db->query('SELECT id, userId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment, groupId FROM projet5_posts ORDER BY nbComment DESC LIMIT 0, 5');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $posts[] = new Post($data);
    }
    return $posts;
  }
  
  public function updateNbComment($postId, $action)
  {
    if ($action === "add") {
    $q = $this->db->prepare('UPDATE projet5_posts SET nbComment = nbComment + 1 WHERE id = :id');

    } elseif ($action === "remove") {
    $q = $this->db->prepare('UPDATE projet5_posts SET nbComment = nbComment - 1 WHERE id = :id');
    }
    $q->bindValue(':id', $postId);
    $q->execute();
  }


  public function addComment($postId)
  {
    $q = $this->db->query('UPDATE projet5_posts SET nbComment = nbComment + 1 WHERE id ='. $postId);
  }

    public function removeComment($postId)
  {
    $q = $this->db->query('UPDATE projet5_posts SET nbComment = nbComment - 1 WHERE id ='. $postId);
  }

  public function update(Post $post)
  {
    $q = $this->db->prepare('UPDATE projet5_posts SET userId = :userId, title = :title, content = :content, updateDate = NOW(), nbComment = :nbComment WHERE id = :id');
    
    $q->bindValue(':userId', $post->getUserId());
    $q->bindValue(':title', $post->getTitle());
    $q->bindValue(':content', $post->getContent());
    $q->bindValue(':nbComment', $post->getNbComment());
    $q->bindValue(':id', $post->getId());
    $q->execute();
  }
}

