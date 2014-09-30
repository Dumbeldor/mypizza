<?php
class IngredientManager
{
	private $_db; //Instance PDO

	public function __construct($db)
	{
		$this->setDb($db);
	}
	public function setDb(PDO $db){
		$this->_db = $db;
	}
	//Ajouter un stock dans la base de donnée
	public function add(Ingredient $ingredient)
	{
		$q = $this->_db->prepare('INSERT INTO ingredient SET idPizzeria = :idPizzeria, nomIngredient = :nomIngredient');
		$q->binValue(':idPizzeria', $ingredient->idPizzeria());
		$q->binValue(':nomIngredient', $ingredient->nomIngredient());
	}
	//Supprimer un ingredient dans la BDD
	public function delete(Ingredient $ingredient)
	{
		if(is_int($ingredient->id()))
		{
			$this->_db->exec('DELETE FROM ingredient WHERE id = '.$ingredient->id());
		{ else {
			$this->_db->exec('DELETE FROM ingredient WHERE id = '.$ingredient->nomIngredient());
		}
	}
	//Récupérer un ingredient dans la BDD pour le stocker dans une nouvelle instance ingredient
	public function get($info)
	{
		if(is_int($info))
		{
			$ingredient = new Ingredient();
			$q = $this->_db->query('SELECT id, idPizzeria, nomIngredient FROM ingredient WHERE id = '.$info);
			while($donnees = $q->fetch())
			{
				$ingredient->setId($donnees['id']);
				$ingredient->setIdPizzeria($donnees['idPizzeria']);
				$ingredient->setNomIngredient($donnees['nomIngredient']);
			}
		}
		else {
			$ingredient = new Ingredient();
			$q = $this->_db->query('SELECT id, idPizzeria, nomIngredient FROM ingredient WHERE nomIngredient = '.$info);
			while($donnees = $q->fetch())
			{
				$ingredient->setId($donnees['id']);
				$ingredient->setIdPizzeria($donnees['idPizzeria']);
				$ingredient->setNomIngredient($donnees['nomIngredient']);
			}
		}			
	}
	//Voir si le ingredient existe déjà
	public function exists($info)
	{
		//Vérification avec ID
		if(is_int($info)){
			return (bool) $this->_db->query('SELECT COUNT(*) FROM ingredient WHERE id = '.$info)->fetchColumn();
		}
		$q = $this->_db->prepare('SELECT COUNT(*) FROM ingredient WHERE nomIngredient = :nomIngredient');
		$q->execute(array(':nomIngredient' => $info));
		return (bool) $q->fetchColumn();
	}
	//mettre à jours
	public function update(Ingredient $ingredient)
	{
		$id = $ingredient->id();
		if(isset($id))
		{
			if (is_int($id))
			{
				$q = $this->_db->prepare('UPDATE ingredient SET idPizzeria = :idPizzeria, nomIngredient = :nomIngredient WHERE id = :id');
				$q->bindValue('id', $ingredient->id());
				$q->bindValue('idPizzeria', $ingredient->idPizzeria());
				$q->bindValue('nomIngredient', $ingredient->nomIngredient());
				$q->execute();
			} else {
				$q = $this->_db->prepare('UPDATE ingredient SET idPizzeria = :idPizzeria WHERE nomIngredient = :nomIngredient');
				$q->bindValue('id', $ingredient->id());
				$q->bindValue('idPizzeria', $ingredient->idPizzeria());
				$q->bindValue('nomIngredient', $ingredient->nomIngredient());
				$q->execute();
			}
		}
	}

}