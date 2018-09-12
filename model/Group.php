<?php

namespace model;

class Group {

	protected $id,
	$title,
	$public,
	$creationDate,
	$lastUpdate,
	$nbPost,
	$nbMember, 
	$description,
	$linkCouvPicture;


	public function __construct(array $data)
  	{
   		$this->hydrate($data);
  	}

	public function hydrate(array $data)
  	{
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

 	public function getTitle() {
 	 	return $this->title;
 	}

  	public function getPublic() {
 	  	return $this->public;
  	}

	public function getPublicString() {
 	switch ($this->public) {
      case 0:
        return "privé";
        break;
      case 1:
        return "public";
        break;
    	}
  	}

  	public function getDescription() {
 	  	return $this->description;
  	}

  	public function getCreationDate() {
 	  	return $this->creationDate;
  	}

  	public function getLastUpdate() {
 	  	return $this->lastUpdate;
  	}

  	public function getLinkCouvPicture() {
 	  	return $this->linkCouvPicture;
  	}

  	public function getLinkCouvPictureString() {
 	 	switch ($this->linkCouvPicture) {
      case 0:
        return NULL;
        break;
      case 1:
        return "jpeg";
        break;
      case 2:
        return "png";
        break;
      case 3:
        return "jpg";
        break;
    	}
  	}

  	public function getNbPost() {
 	  	return $this->nbPost;
  	}

  	public function getNbMember() {
 	  	return $this->nbMember;
  	}


	public function setId($id) {
	    $id = (int) $id;
	    if ($id >= 0) {
	      $this->id = $id;
	    }
	}

  	public function setTitle($title) {
	    if (is_string($title) && strlen($title) < 240) {
	       $this->title = $title;
	    }
	}

	public function setDescription($description) {
	    if (is_string($description)) {
	       $this->description = $description;
	    }
	}

	public function setCreationDate($creationDate) {
	    if (is_string($creationDate)) {
	      $this->creationDate = $creationDate;
	    }
	}

	public function setLastUpdate($lastUpdate) {
	    if (is_string($lastUpdate)) {
	      $this->lastUpdate = $lastUpdate;
	    }
	}

	public function setPublic($public) {
	    $public = (int) $public;
	    if ($public >= 0) {
	      $this->public = $public;
	    }
	}

	public function setLinkCouvPicture($linkCouvPicture) {
	    $linkCouvPicture = (int) $linkCouvPicture;
	    if ($linkCouvPicture >= 0) {
	      $this->linkCouvPicture = $linkCouvPicture;
	    }
	}

	public function setNbPost($nbPost) {
	    $nbPost = (int) $nbPost;
	    if ($nbPost >= 0) {
	      $this->nbPost = $nbPost;
	    }
	}

	public function setNbMember($nbMember) {
	    $nbMember = (int) $nbMember;
	    if ($nbMember >= 0) {
	      $this->nbMember = $nbMember;
	    }
	}
}