<?php 
class User {
	protected $id,
		  	  $nom,
		  	  $prenom,
		  	  $pseudo,
		  	  $pass,
		  	  $email,

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
	}
	//Fonction qui sert à Modifier nos variables de class
	public function setId($id)
	{
		$id = (int) $id;
		$this->id = $id;
	}
	public function setNom($nom)
	{
		if(is_string($nom))
		{
			$this->nom = $nom;
		}
	}
	public function setPrenom($prenom)
	{
		if(is_string($prenom)){
			$this->prenom = $prenom;
		}
	}
	public function setPseudo($pseudo)
	{
		if(is_string($pseudo)) {
			$this->pseudo = $pseudo;
		}
	}
	public function setEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->email = $email;
		}
	}
	public function setPass($pass)
	{
		if(is_string($pass)){
			$this->pass = $pass;
		}
	}

	//Fonction qui sert à récupérer nos variable de class

	public function id(){
		return $this->id;
	}
	public function nom(){
		return $this->nom;
	}
	public function prenom(){
		return $this->prenom;
	}
	public function pseudo(){
		return $this->pseudo;
	}
	public function email(){
		return $this->email;
	}
	public function pass(){
		return $this->pass;
	}

		 
}
