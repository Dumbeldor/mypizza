<?php
class Stock {
	protected $id,
			  $idPizzeria,
			  $idProduit;

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
	//Modifier les variables de class
	public function setId($id)
	{
		$id = (int) $id;
		$this->id = $id;
	}
	public function setIdPizzeria($idPizzeria)
	{
		$idPizzeria = (int) $idPizzeria;
		$this->idPizzeria = $idPizzeria;
	}
	public function setIdProduit($idProduit)
	{
		$idProduit = (int) $idProduit;
		$this->idProduit = $idProduit;
	}

	//Fonction qui sert à récupérer nos variable de class

	public function id(){
		return $this->id;
	}
	public function idPizzeria(){
		return $this->idPizzeria;
	}
	public function idProduit(){
		return $this->idProduit;
	}
}