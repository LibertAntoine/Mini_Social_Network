<?php


namespace model;

class LinkReporting {

	protected $id,
	$userId,
	$commentId,
	$reportingDate,
  $groupId;

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
 	

  public function getUserId() {
    return $this->userId;
  }

  public function getCommentId() {
    return $this->commentId;
  }
  
  public function getReportingDate() {
    return $this->reportingDate;
  }

  public function getGroupId() {
    return $this->groupId;
  }

  public function setId($id) {
      $id = (int) $id;
      if ($id >= 0) {
        $this->id = $id;
      }
  }


  public function setUserId($userId) {
      $userId = (int) $userId;
      if ($userId >= 0) {
        $this->userId = $userId;
      }
  }

  public function setGroupId($groupId) {
      $groupId = (int) $groupId;
      if ($groupId >= 0) {
        $this->groupId = $groupId;
      }
  }

  public function setCommentId($commentId) {
      $commentId = (int) $commentId;
      if ($commentId >= 0) {
        $this->commentId = $commentId;
      }
  }

  public function setReportingDate($reportingDate) {
      if (is_string($reportingDate)) {
         $this->reportingDate = $reportingDate;
      }
  } 
}