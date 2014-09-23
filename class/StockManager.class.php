<?php
class StockManager
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
	public function add(Stock $stock)
	{
		$q = $this->_db->prepare('INSERT INTO stock SET idPizzeria = :idPizzeria, idProduit = :idProduit');
		$q->bindValue(':idPizzeria', $stock->idPizzeria());
		$q->bindValue(':idProduit', $stock->idProduit());
	}
	//Supprimer un stock dans la BDD
	public function delete(Stock $stock)
	{
		$this->_db->exec('DELETE FROM stock WHERE id = '.$stock->id());
	}
	//Récupérer un stock dans la BDD pour le stocker dans une nouvelle instance stock
	public function get($info)
	{
		if(is_int($info))
		{
			$q = $this->_db->query('SELECT id, idPizzeria, idProduit FROM stock WHERE id = '.$info);
			while($donnees = $q->fetch())
			{
				return new Stock(array(
					'id' => $donnees['id'],
					'idPizzeria' => $donnees['idPizzeria'],
					'idProduit' => $donnees['idProduit'],
					));
			}
		}
		else {
			echo "Erreur, vous devez mettre une valeur numerique !";
		}			
	}
	//Voir si le stock existe déjà
	public function exists($info)
	{
		//Vérification avec ID
		if(is_int($info)){
			return (bool) $this->_db->query('SELECT COUNT(*) FROM stock WHERE id = '.$info)->fetchColumn();
		}
	}
	//mettre à jours
	public function update(Stock $stock)
	{
		$id = $stock->id();
		if(isset($id))
		{
			$q = $this->_db->prepare('UPDATE stock SET idPizzeria = :idPizzeria, idProduit = :idProduit WHERE id = :id');
			$q->bindValue('id', $stock->id());
			$q->bindValue('idPizzeria', $stock->idPizzeria());
			$q->bindValue('idProduit', $stock->idProduit());
			$q->execute();
		}
	}

}