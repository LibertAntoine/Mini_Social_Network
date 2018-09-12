<?php

namespace model;

class LinkGroup {

	protected $id,
	$groupId,
	$userId,
	$status,
	$linkDate;

	public function __construct(array $data) {
   	 $this->hydrate($data);
  }

	public function hydrate(array $data) {
    	foreach ($data as $key => $value)
    	{
     	 	$method = 'set'.ucfirst($key);
      		if (method_exists($this, $method))
      		{
        		$this->$method($value);
      		}
      	}
  }

  public function getId() {
 	 	return $this->id;
  }
 	
  public function getGroupId() {
    return $this->groupId;
  }

    public function getUserId() {
    return $this->userId;
  }

  public function getStatusInt() {
    return $this->status;
  }

  public function getStatusString() {
    switch ($this->status) {
      case 1:
        return "Administrateur";
        break;
      case 2:
        return "Auteur";
        break;
      case 3:
        return "Commenteur";
        break;
      case 4:
        return "Viewer";
        break;
      case 5:
        return "Membre";
      break; 
    }
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

  public function setGroupId($groupId) {
      $groupId = (int) $groupId;
      if ($groupId >= 0) {
        $this->groupId = $groupId;
      }
  }

  public function setUserId($userId) {
      $userId = (int) $userId;
      if ($userId >= 0) {
        $this->userId = $userId;
      }
  }


  public function setStatus($status) {
      $status = (int) $status;
      if ($status >= 0) {
        $this->status = $status;
      }
  }

  public function setLinkDate($linkDate) {
    if (is_string($linkDate)) {
      $this->linkDate = $linkDate;
    }
  } 
}