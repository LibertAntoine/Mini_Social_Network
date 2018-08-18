<?php

class User {
	protected $id,
	$pseudo,
	$mdp,
  $creationProfil,
	$status
  ;


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

  public function getPseudo() 
  {
    return $this->pseudo;
  }

  public function getMdp() 
  {
  	return $this->mdp;
  }

  public function getCreationProfil() 
  {
    return $this->creationProfil;
  }

  public function getStatus() 
  {
    return $this->status;
  }

	public function setId($id) 
  {
 	  $id = (int) $id;
 	  if ($id > 0) 
    {
 		 $this->id = $id;
 	  }
  }

 	public function setPseudo($pseudo) 
  {
  	if (is_string($pseudo) && strlen($pseudo) < 26) 
    {
 		$this->pseudo = $pseudo;
 	  }
  }

  public function setMdp($creationProfil) 
  {
    if (is_string($creationProfil) && strlen($creationProfil) < 26) 
    {
     $this->creationProfil = $creationProfil;
    }
  }

 	public function setMdp($mdp) 
  {
  	if (is_string($mdp) && strlen($mdp) < 26) 
    {
 		 $this->mdp = $mdp;
 	  }
  }

 	public function setStatus($status) 
  {
  	if (is_string($status) && strlen($status) < 26) 
    {
 		 $this->status = $status;
 	  }
  }
}






