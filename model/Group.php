<?php

/**
 * 
 */
class Group
{

	protected $id,
	$title,
	$status,
	$creationDate,
	$lastUpdate,
	$nbPost,
	$nbMember, 
	$linkCouvPicture;


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

 	public function getTitle() 
  	{
 	 	return $this->title;
 	}

  	public function getStatus() 
  	{
 	  	return $this->status;
  	}

  	public function getCreationDate() 
  	{
 	  	return $this->status;
  	}

  	public function getLastUpdate() 
  	{
 	  	return $this->lastUpdate;
  	}

  	public function getLinkCouvPicture() 
  	{
 	  	return $this->linkCouvPicture;
  	}

  	  	public function getNbPost() 
  	{
 	  	return $this->nbPost;
  	}

  	  	public function getNbMember() 
  	{
 	  	return $this->nbMember;
  	}


	public function setId($id) 
	{
	    $id = (int) $id;
	    if ($id >= 0) 
	    {
	      $this->id = $id;
	    }
	}

  	public function setTitle($title) 
	{
	    if (is_string($title) && strlen($title) < 240) 
	    {
	       $this->title = $title;
	    }
	}

	public function setCreationDate($creationDate) 
	{
	    if (is_string($creationDate)) 
	    {
	      $this->creationDate = $creationDate;
	    }
	}

	public function setLastUpdate($lastUpdate) 
	{
	    if (is_string($lastUpdate)) 
	    {
	      $this->lastUpdate = $lastUpdate;
	    }
	}

	public function setStatus($status) 
	{
	    if (is_string($status)) 
	    {
	      $this->status = $status;
	    }
	}

	public function setLinkCouvPicture($linkCouvPicture) 
	{
	    if (is_string($linkCouvPicture)) 
	    {
	      $this->linkCouvPicture = $linkCouvPicture;
	    }
	}

	public function setNbPost($nbPost) 
	{
	    $nbPost = (int) $nbPost;
	    if ($nbPost >= 0) 
	    {
	      $this->nbPost = $nbPost;
	    }
	}

	public function setNbMember($nbMember) 
	{
	    $nbMember = (int) $nbMember;
	    if ($nbMember >= 0) 
	    {
	      $this->nbMember = $nbMember;
	    }
	}
}