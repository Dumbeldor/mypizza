<?php
Class Pizzeria {
	protected $id,
			  $nomPizzeria,
			  $pass,
			  $telephone,
			  $email,
			  $ville,
			  $adressePostal,
			  $rue;

	public function __construct(array $donnees)
 {
    $this->hydrate($donnees);
  }

  	  // Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
	public function hydrate(array $donnees)
	{
  		foreach ($donnees as $key => $value)
  		{
    		// On récupère le nom du setter correspondant à l'attribut.
    		$method = 'set'.ucfirst($key);
        
    // Si le setter correspondant existe.
    		if (method_exists($this, $method))
    		{
      			// On appelle le setter.
      			$this->$method($value);
    		}
  		}
  		//Fonction qui sert à Modifier nos variables de class
  		function setId($id){
  			$this->id = $id;
  		}
  	public function setNomPizzeria($nomPizzeria)
	{
		if(is_string($nomPizzeria))
		{
			$this->nomPizzeria = $nomPizzeria;
		}
	}
	public function setPass($pass)
	{
		if(is_string($pass)){
			$this->pass = $pass;
		}
	}
	public function setTelephone($telephone)
	{
		if(is_string($telephone)){
			$this->telephone = $telephone;
		}
	}
	public function setEmail($email)
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->email = $email;
		}
	}
	public function setVille($ville)
	{
		$this->ville = $ville;
	}
	public function setAdressePostal($adressePostal)
	{
		if(strlen($adressePostal) == 5){
			$this->adressePostal = $adressePostal;
		}
	}
	public function setRue($rue)
	{
		$this->rue = $rue;
	}

	//Fonction qui sert à récupérer nos variable de class

	public function id(){
		return $this->id;
	}
	public function nomPizzeria(){
		return $this->nomPizzeria;
	}
	public function pass(){
		return $this->pass;
	}
	public function telephone(){
		return $this->telephone;
	}
	public function email(){
		return $this->email;
	}
	public function ville(){
		return $this->ville;
	}
	public function adressePostal(){
		return $this->adressePostal;
	}
	public function rue(){
		return $this->rue;
	}
}