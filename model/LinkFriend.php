<?php

namespace model;

class LinkFriend {

	protected $id,
	$userId1,
	$userId2,
	$link,
	$linkDate;

  public function __construct(array $data) {
   	 $this->hydrate($data);
  }

	public function hydrate(array $data) {
    foreach ($data as $key => $value) {
     	$method = 'set'.ucfirst($key);
      if (method_exists($this, $method)) {
        $this->$method($value);
      }
    }
  }

  public function getId() {
 	 	return $this->id;
  }
 	
  public function getUserId1() {
    return $this->userId1;
  }

  public function getUserId2() {
    return $this->userId2;
  }

  public function getLink() {
    return $this->link;
  }
  
  public function getLinkDate() {
    return $this->linkDate;
  }

  public function setId($id) {
      $id = (int) $id;
      if ($id >= 0) {
        $this->id = $id;
      }
  }

  public function setUserId1($userId1) {
      $userId1 = (int) $userId1;
      if ($userId1 >= 0) {
        $this->userId1 = $userId1;
      }
  }

  public function setUserId2($userId2) {
      $userId2 = (int) $userId2;
      if ($userId2 >= 0) {
        $this->userId2 = $userId2;
      }
  }


  public function setLink($link) {
      $link = (int) $link;
      if ($link >= 0) {
        $this->link = $link;
      }
  }

  public function setLinkDate($linkDate) {
    if (is_string($linkDate)) {
      $this->linkDate = $linkDate;
    }
  } 
}