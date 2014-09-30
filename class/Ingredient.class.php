<?php
class Ingredient {
	protected $id = array(),
			  $idPizzeria = array(),
			  $nomIngredient = array(),
			  
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
  	public function setId($id){
  		$id = (int) $id;
		if ($id >= 0)
		{
			array_push($this->id, $id);
		}
  	}
	public function setIdPizzeria($id){
		$id = (int) $id;
		if ($id >= 0)
		{
			array_push($this->idPizzeria, $id);
		}
	}
	public function setNomIngredient($nom) {
		if(is_string($nom))
		{
			array_push($this->nomIngredient, $nom);
		}
	}
	
	//function qui sert à récupérer les variables
	public function id(){
		for ($numero = 0; $numero < count($this->id); $numero++)
  		{
  			return $this->id[$numero]; 	
  		}
	}
	public function idPizzeria(){
		for ($numero = 0; $numero < count($this->id); $numero++)
  		{
  			return $this->idPizzeria[$numero]; 	
  		}
	}
	public function nomIngredient(){
		for ($numero = 0; $numero < count($this->id); $numero++)
  		{
  			return $this->nomIngredient[$numero]; 	
  		}
	}
			  
}
