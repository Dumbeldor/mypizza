<?php
class Ingredient {
	protected $id,
			  $idPizzeria,
			  $nomIngredient,
			  
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
  		$this->id = $id;
  	}
	public function setIdPizzeria($id){
		$this->idPizzeria = $id;
	}
	public function setNomIngredient($nom) {
		if(is_string($nom)){
			$this->nomIngredient = $nom;
		}
	}
	
	//function qui sert à récupérer les variables
	public function id(){
		return $this->id;
	}
	public function idPizzeria(){
		return $this->idPizzeria;
	}
	public function nomIngredient(){
		return $this->nomIngredient;
	}
			  
}
