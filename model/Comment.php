<?php

class Comment extends TextContent {

	protected $articleId,
  $groupId,
	$reporting;

	public function getArticleId() 
  {
 	  return $this->articleId;
 	}

    public function getGroupId() 
  {
    return $this->groupId;
  }

    public function getReporting() 
  {
    return $this->reporting;
  }

 	public function setArticleId($articleId) {
 	  $articleId = (int) $articleId;
 	  if ($articleId > 0) 
    {
 		 $this->articleId = $articleId;
 	  }
  }

    public function setGroupId($groupId) {
    $groupId = (int) $groupId;
    if ($groupId > 0) 
    {
     $this->groupId = $groupId;
    }
  }


 	public function setReporting($reporting) 
  {
 	  $reporting = (int) $reporting;
 	  if ($reporting >= 0) 
    {
 		 $this->reporting = $reporting;
 	  }
  }
}


