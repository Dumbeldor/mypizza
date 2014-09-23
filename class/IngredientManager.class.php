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
		$q = $this->_db->prepare('INSERT INTO ingredient SET idPizzeria = :idPizzeria, nomProduit = :nomIngredient');
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
			$q = $this->_db->query('SELECT id, idPizzeria, nomProduit FROM ingredient WHERE id = '.$info);
			while($donnees = $q->fetch())
			{
				return new Ingredient(array(
					'id' => $donnees['id'],
					'idPizzeria' => $donnees['idPizzeria'],
					'nomProduit' => $donnees['nomProduit'],
					));
			}
		}
		else {
			$q = $this->_db->query('SELECT id, idPizzeria, nomProduit FROM ingredient WHERE nomProduit = '.$info);
			while($donnees = $q->fetch())
			{
				return new Ingredient(array(
					'id' => $donnees['id'],
					'idPizzeria' => $donnees['idPizzeria'],
					'nomProduit' => $donnees['nomProduit'],
					));
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
		$q = $this->_db->prepare('SELECT COUNT(*) FROM ingredient WHERE nomProduit = :nomProduit');
		$q->execute(array(':nomProduit' => $info));
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
				$q = $this->_db->prepare('UPDATE ingredient SET idPizzeria = :idPizzeria, nomProduit = :nomProduit WHERE id = :id');
				$q->bindValue('id', $ingredient->id());
				$q->bindValue('idPizzeria', $ingredient->idPizzeria());
				$q->bindValue('nomProduit', $ingredient->nomProduit());
				$q->execute();
			} else {
				$q = $this->_db->prepare('UPDATE ingredient SET idPizzeria = :idPizzeria WHERE nomProduit = :nomProduit');
				$q->bindValue('id', $ingredient->id());
				$q->bindValue('idPizzeria', $ingredient->idPizzeria());
				$q->bindValue('nomProduit', $ingredient->nomProduit());
				$q->execute();
			}
		}
	}

}