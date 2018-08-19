<?php

class Post extends TextContent {

	protected $title,
  $groupId,
  $updateDate,
  $nbComment;

  public function getTitle() 
  {
 	  return $this->title;
 	}

  public function getUpdateDate() 
  {
 	  return $this->updateDate;
  }

  public function getGroupId() 
  {
    return $this->groupId;
  }

  public function getNbComment() 
  {
    return $this->nbComment;
  }

  public function setTitle($title) 
  {
    if (is_string($title) && strlen($title) < 240) 
    {
       $this->title = $title;
    }
  }

  public function setUpdateDate($updateDate) 
  {
    if (is_string($updateDate)) 
    {
      $this->updateDate = $updateDate;
    }
  }

  public function setNbComment($nbComment) 
  {
    $nbComment = (int) $nbComment;
    if ($nbComment >= 0) 
    {
      $this->nbComment = $nbComment;
    }
  }

  public function setGroupId($groupId) 
  {
    $groupId = (int) $groupId;
    if ($groupId >= 0) 
    {
      $this->groupId = $groupId;
    }
  }

}
