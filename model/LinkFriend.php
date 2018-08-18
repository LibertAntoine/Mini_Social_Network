<?php

/**
 * 
 */
class LinkGroup
{

	protected $id,
	$userId1,
	$userId2,
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
 	
  public function getUserId1() 
  {
    return $this->userId1;
  }

    public function getUserId2() 
  {
    return $this->userId2;
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

  public function setUserId($userId1) 
  {
      $userId1 = (int) $userId1;
      if ($userId1 >= 0) 
      {
        $this->userId1 = $userId1;
      }
  }

  public function setUserId($userId2) 
  {
      $userId2 = (int) $userId2;
      if ($userId2 >= 0) 
      {
        $this->userId2 = $userId2;
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