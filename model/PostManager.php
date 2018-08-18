<?php


class PostManager extends DBAccess {

	public function add(Article $article) 
  {
		$q = $this->db->prepare("INSERT INTO `roche_articles` (`title`, `userId`, `content`, `creationDate`, `updateDate`, `nbComment`) VALUES (:title , :userId, :content, NOW(), NOW(), :nbComment)");

		$q->bindValue(':userId', $article->getUserId());
    $q->bindValue(':title', $article->getTitle());
    $q->bindValue(':content', $article->getContent());
    $q->bindValue(':nbComment', 0);
		$q->execute();

    $article->hydrate([
      'id' => $this->db->lastInsertId()]);
  }

  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM roche_articles')->fetchColumn();
  }

  public function delete($articleId)
  {
    $this->db->exec('DELETE FROM roche_articles WHERE id = '.$articleId);
  }

 	public function exists($info)
 	{
   	if (is_int($info)) 
    {
      return (bool) $this->db->query('SELECT COUNT(*) FROM roche_articles WHERE id = '.$info)->fetchColumn();
    } else 
    {
    	$q = $this->db->prepare('SELECT COUNT(*) FROM roche_articles WHERE title = :title');
    	$q->execute([':title' => $info]);
    	return (bool) $q->fetchColumn();
    }
  }

  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->db->query('SELECT id, userId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment FROM roche_articles WHERE id = '.$info);
      $article = $q->fetch(PDO::FETCH_ASSOC);
    } else 
    {
     	$q = $this->db->prepare('SELECT id, userId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment FROM roche_articles WHERE title = :title');
      $q->execute([':title' => $info]);
      $article = $q->fetch(PDO::FETCH_ASSOC);
    }
    return new Article($article);
  }

  public function getTitle($articleId)
  {
    $q = $this->db->query('SELECT title FROM roche_articles WHERE id = '. $articleId);
    $info = $q->fetch(PDO::FETCH_ASSOC);

    return $info['title'];
  }


  public function getAllList()
  {
    $articles = [];
    
    $q = $this->db->query('SELECT id, userId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment FROM roche_articles ORDER BY updateDate DESC');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $articles[] = new Article($data);
    }
    return $articles;
  }

  public function getRecentList()
  {
    $articles = [];
    
    $q = $this->db->query('SELECT id, userId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment FROM roche_articles ORDER BY updateDate DESC LIMIT 0, 5');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $articles[] = new Article($data);
    }
    return $articles;
  }

  public function getBestList()
  {
    $articles = [];
    
    $q = $this->db->query('SELECT id, userId, title, content, DATE_FORMAT(creationDate, \'%d/%m/%Y à %Hh%i\') AS creationDate, DATE_FORMAT(updateDate, \'%d/%m/%Y à %Hh%i\') AS updateDate, nbComment FROM roche_articles ORDER BY nbComment DESC LIMIT 0, 5');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $articles[] = new Article($data);
    }
    return $articles;
  }
  
  public function updateNbComment($articleId, $action)
  {
    if ($action === "add") {
    $q = $this->db->prepare('UPDATE roche_articles SET nbComment = nbComment + 1 WHERE id = :id');

    } elseif ($action === "remove") {
    $q = $this->db->prepare('UPDATE roche_articles SET nbComment = nbComment - 1 WHERE id = :id');
    }
    $q->bindValue(':id', $articleId);
    $q->execute();
  }

  public function update(Article $article)
  {
    $q = $this->db->prepare('UPDATE roche_articles SET userId = :userId, title = :title, content = :content, updateDate = NOW(), nbComment = :nbComment WHERE id = :id');
    
    $q->bindValue(':userId', $article->getUserId());
    $q->bindValue(':title', $article->getTitle());
    $q->bindValue(':content', $article->getContent());
    $q->bindValue(':nbComment', $article->getNbComment());
    $q->bindValue(':id', $article->getId());
    $q->execute();
  }
}

