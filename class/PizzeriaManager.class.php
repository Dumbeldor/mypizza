<?php
class PizzeriaManager
{
	private $_db; //instance de la DB
	public function __construct($db)
	{
		$this->setDb($db);
	}
	public function setDb(PDO $db){
		$this->_db = $db;
	}
	//Ajouter pizzeria a la base de donnée
	public function add(Pizzeria $pizzeria)
	{
		$q = $this->_db->prepare('INSERT INTO pizzeria SET nomPizzeria = :nomPizzeria, pass = :pass, telephone = :telephone, email = :email, ville = :ville, adressePostal = :adressePostal, rue = :rue');
		$q->bindValue(':nomPizzeria', $pizzeria->nomPizzeria());
		$q->bindValue(':pass', $pizzeria->pass());
		$q->bindValue(':telephone', $pizzeria->telephone());
		$q->bindValue(':email', $pizzeria->email());
		$q->bindValue(':ville', $pizzeria->ville());
		$q->bindValue(':adressePostal', $pizzeria->adressePostal());
		$q->bindValue(':rue', $pizzeria->rue());
	}
	//supprimer une pizzeria dans la BDD
	public function delete(Pizzeria $pizzeria)
	{
		$this->_db->exec('DELETE FROM pizzeria WHERE id = '.$pizzeria->id());
	}
	//récupérer une pizzerria et stocker dans une nouvelle instance
	public function get($info)
	{
		if(is_int($info)) // Si on recherche avec l'id de la pizzeria
		{
			$q = $this->_db->query('SELECT id, nomPizzeria, pass, telephone, email, ville, adressePostal, rue FROM pizzeria WHERE id = '.$info);
			while($donnees = $q->fetch())
			{
				return new Pizzeria(array(
					'id' => $donnees['id'],
					'nomPizzeria' => $donnees['nomPizzeria'],
					'pass' => $donnees['pass'],
					'telephone' => $donnees['telephone'],
					'email' => $donnees['email'],
					'ville' => $donnees['ville'],
					'adressePostal' => $donnees['adressePostal'],
					'rue' => $donnees['rue'],
					));
			}
		}
		else { //Si on recherche avec le nom de la pizzeria
			$q = $this->_db->query('SELECT id, nomPizzeria, pass, telephone, email, ville, adressePostal, rue FROM pizzeria WHERE nomPizzeria = '.$info);
			while($donnees = $q->fetch())
			{
				return new Pizzeria(array(
					'id' => $donnees['id'],
					'nomPizzeria' => $donnees['nomPizzeria'],
					'pass' => $donnees['pass'],
					'telephone' => $donnees['telephone'],
					'email' => $donnees['email'],
					'ville' => $donnees['ville'],
					'adressePostal' => $donnees['adressePostal'],
					'rue' => $donnees['rue'],
					));
			}
		}			
	}
	//Vérifier si le nom de la pizzeria existe
	public function exists($info)
	{
		//Vérification avec ID
		if(is_int($info)){
			return (bool) $this->_db->query('SELECT COUNT(*) FROM pizzeria WHERE id = '.$info)->fetchColumn();
		}
		$q = $this->_db->prepare('SELECT COUNT(*) FROM pizzeria WHERE nomPizzeria = :nomPizzeria');
		$q->execute(array(':nomPizzeria' => $info));
		return (bool) $q->fetchColumn();
	}
	//mettre à jours
	public function update(Pizzeria $pizzeria)
	{
		$id = $pizzeria->id();
		if(isset($id))
		{
			$q = $this->_db->prepare('UPDATE pizzeria SET nomPizzeria = :nomPizzeria, pass = :pass, telephone = :telephone, email = :email, ville = :ville, adressePostal = :adressePostal, rue = :rue WHERE id = :id');
			$q->bindValue('id', $user->id());
			$q->binValue(':nomPizzeria', $pizzeria->nomPizzeria());
			$q->binValue(':pass', $pizzeria->pass());
			$q->binValue(':telephone', $pizzeria->telephone());
			$q->binValue(':email', $pizzeria->email());
			$q->binValue(':ville', $pizzeria->ville());
			$q->binValue(':adressePostal', $pizzeria->adressePostal());
			$q->binValue(':rue', $pizzeria->rue());
			$q->execute();
		}
		else { //Si nous voulons updat avec un nom d'utilisateurs
			$q = $this->_db->prepare('UPDATE pizzeria SET pass = :pass, telephone = :telephone, email = :email, ville = :ville, adressePostal = :adressePostal, rue = :rue WHERE nomPizzeria = :nomPizzeria');
			$q->binValue(':nomPizzeria', $pizzeria->nomPizzeria());
			$q->binValue(':pass', $pizzeria->pass());
			$q->binValue(':telephone', $pizzeria->telephone());
			$q->binValue(':email', $pizzeria->email());
			$q->binValue(':ville', $pizzeria->ville());
			$q->binValue(':adressePostal', $pizzeria->adressePostal());
			$q->binValue(':rue', $pizzeria->rue());
			$q->execute();
		}
	}
}
