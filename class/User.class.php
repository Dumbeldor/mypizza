			<?php 
class User {
	protected $id,
		  	  $nom,
		  	  $prenom,
		  	  $pseudo,
		  	  $pass,
		  	  $email,
		  	  $adresse,
		  	  $codePostal,
		  	  $ville,
		  	  $numDetel;

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
	// modification d'id
	public function setId($id)
	{
		$id = (int) $id;
		$this->id = $id;
	}
	// modification du nom
	public function setNom($nom)
	{
		if(is_string($nom))
		{
			$this->nom = $nom;
		}
	}
	// modification du prenom
	public function setPrenom($prenom)
	{
		if(is_string($prenom)){
			$this->prenom = $prenom;
		}
	}
	// modification du pseudo
	public function setPseudo($pseudo)
	{
		if(is_string($pseudo)) {
			$this->pseudo = $pseudo;
		}
	}
	//modification du mail
	public function setEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->email = $email;
		}
	}
	// modification du mot de passe
	public function setPass($pass)
	{
		if(is_string($pass)){
			$this->pass = $pass;
		}
	}
	// modification de l'adresse
	public function setAdresse($adresse)
	{
		if(is_string($adresse)){
			$this->adresse = $adresse;
		}
	}
	// modification du code postal
	public function setCodePostal($codePostal)
	{
		if(is_string($codePostal)){
			$this->codePostal = $codePostal;
		}
	}
	//modification de la ville
	public function setVille($ville)
	{
		if(is_string($ville)){
			$this->ville = $ville;
		}
	}
	// modification du numéro de téléphone
	public function setNumDeTel($numDetel)
	{
		if(is_string($numDetel)){
			$this->numDetel = $numDetel;
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
	public function adresse(){
		return $this->adresse;
	}

	public function codePostal(){
		return $this->codePostal;
	}

	public function ville(){
		return $this->ville;
	}
	
	public function numDetel(){
		return $this->numDetel;
	}
}
