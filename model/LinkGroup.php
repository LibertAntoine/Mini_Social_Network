<?php


/**
 * 
 */
class LinkGroup
{

	protected $id,
	$groupId,
	$userId,
	$status,
	$linkDate;


	public function __construct(array $data)
  {
   	 $this->hydrate($data);
  }

	public function hydrate(array $data)
  {
    	foreach ($data as $key => $value)
    	{
     	 	$method = 'set'.ucfirst($key);
      		if (method_exists($this, $method))
      		{
        		$this->$method($value);
      		}
      	}
  }

  public function getId() 
  {
 	 	return $this->id;
  }
 	
  public function getGroupId() 
  {
    return $this->groupId;
  }

    public function getUserId() 
  {
    return $this->userId;
  }

  public function getStatus() 
  {
    return $this->status;
  }
  
  public function getLinkDate() 
  {
    return $this->linkDate;
  }

  public function setId($id) 
  {
      $id = (int) $id;
      if ($id >= 0) 
      {
        $this->id = $id;
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

  public function setUserId($userId) 
  {
      $userId = (int) $userId;
      if ($userId >= 0) 
      {
        $this->userId = $userId;
      }
  }


  public function setStatus($status) 
  {
      if (is_string($status) && strlen($status) < 25) 
      {
         $this->status = $status;
      }
  }

  public function setLinkDate($linkDate) 
  {
      if (is_string($linkDate)) 
      {
         $this->linkDate = $linkDate;
      }
  } 
}