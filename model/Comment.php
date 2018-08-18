<?php

class Comment extends BlogContent {

	protected $articleId,
	$reporting;

	public function getArticleId() 
  {
 	  return $this->articleId;
 	}

 	public function setArticleId($articleId) {
 	  $articleId = (int) $articleId;
 	  if ($articleId > 0) 
    {
 		 $this->articleId = $articleId;
 	  }
  }

 	public function getReporting() 
  {
 	  return $this->reporting;
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


