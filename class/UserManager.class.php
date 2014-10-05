<?php
class UserManager
{
	private $_db; //Instance PDO

	public function __construct($db)
	{
		$this->setDb($db);
	}
	public function setDb(PDO $db){
		$this->_db = $db;
	}
	//Ajouter un User dans la base de donnée
	public function add(User $user)
	{
		$q = $this->_db->prepare('INSERT INTO user SET nom = :nom, prenom = :prenom, pseudo = :pseudo, pass = :pass, email = :email, adresse = :adresse, codePostal = :codePostal,ville = :ville, numDetel = :numDetel');
		$q->bindValue(':nom', $user->nom());
		$q->bindValue(':prenom', $user->prenom());
		$q->bindValue(':pseudo', $user->pseudo());
		$q->bindValue(':pass', $user->pass());
		$q->bindValue(':email', $user->email());
		$q->bindValue(':adresse', $user->adresse());
		$q->bindValue(':codePostal', $user->codePostal());
		$q->bindValue(':ville', $user->ville());
		$q->bindValue(':numDetel', $user->numDetel());
		$q->execute();
	}
	//Supprimer un user dans la BDD
	public function delete(User $user)
	{
		$this->_db->exec('DELETE FROM user WHERE id = '.$user->id());
	}
	//Récupérer un user dans la BDD pour le stocker dans une nouvelle instance user
	public function get($info)
	{
		if(is_int($info))
		{
			$q = $this->_db->query('SELECT id, nom, prenom, pseudo, pass, email,adresse,numDetel,ville,rang FROM user WHERE id = '.$info);
			while($donnees = $q->fetch())
			{
				return new User(array(
					'id' => $donnees['id'],
					'nom' => $donnees['nom'],
					'prenom' => $donnees['prenom'],
					'pseudo' => $donnees['pseudo'],
					'pass' => $donnees['pass'],
					'email' => $donnees['email'],
					'adresse' => $donnees['adresse'],
					'numDetel' => $donnees['numDetel'],
					'ville' => $donnees['ville'],
					'rang' => $donnees['rang'],
					));
			}
		}
		else {
			$q = $this->_db->prepare('SELECT id, nom, prenom, pseudo, pass, email , adresse, numDetel,ville,rang 	FROM user WHERE pseudo = :pseudo');
			$q->execute(array(':pseudo' => $info));
			while($donnees = $q->fetch())
			{
				return new User(array(
					'id' => $donnees['id'],
					'nom' => $donnees['nom'],
					'prenom' => $donnees['prenom'],
					'pseudo' => $donnees['pseudo'],
					'pass' => $donnees['pass'],
					'email' => $donnees['email'],
					'adresse' => $donnees['adresse'],
					'numDetel' => $donnees['numDetel'],
					'ville' => $donnees['ville'],
					'rang' => $donnees['rang'],
					));
			}
		}			
	}
	//Vérifier le mot de passe
	public function pass($pseudo, $pass)
	{
		$q = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE pseudo = :pseudo AND pass = :pass');
		$q->execute(array(':pseudo' => $pseudo, ':pass' => $pass));
		return (bool) $q->fetchColumn();
	}
	//Voir si le pseudo existe déjà
	public function exists($info)
	{
		//Vérification avec ID
		if(is_int($info)){
			return (bool) $this->_db->query('SELECT COUNT(*) FROM user WHERE id = '.$info)->fetchColumn();
		}
		$q = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE pseudo = :pseudo');
		$q->execute(array(':pseudo' => $info));
		return (bool) $q->fetchColumn();
	}
	//mettre à jours
	public function update(User $user)
	{
		$id = $user->id();
		if(isset($id))
		{
			$q = $this->_db->prepare('UPDATE personnage SET nom = :nom, prenom = :prenom, pseudo = :pseudo, pass = :pass, email = :email,adresse=:adresse,numDetel=:numDetel,rang=:rang,codePostal= :codePostal,ville = :ville WHERE id = :id');
			$q->bindValue('id', $user->id());
			$q->bindValue('nom', $user->nom());
			$q->bindValue('prenom', $user->prenom());
			$q->bindValue('pseudo', $user->pseudo());
			$q->bindValue('pass', $user->pass());
			$q->bindValue('email', $user->email());	
			$q->bindValue('adresse', $user->adresse());
			$q->bindValue('numDetel', $user->numDetel());
			$q->bindValue('codePostal', $user->codePostal());
			$q->bindValue('ville', $user->ville());				
			$q->execute();
		}
		else { //Si nous voulons updat avec un nom d'utilisateurs
			$q = $this->_db->prepare('UPDATE personnage SET nom = :nom, prenom = :prenom, pseudo = :pseudo, pass = :pass, email = :email,adresse=:adresse,numDetel=:numDetel,rang=:rang,codePostal= :codePostal,ville = :villeWHERE pseudo = :pseudo');
			$q->bindValue('id', $user->id());
			$q->bindValue('nom', $user->nom());
			$q->bindValue('prenom', $user->prenom());
			$q->bindValue('pseudo', $user->pseudo());
			$q->bindValue('pass', $user->pass());
			$q->bindValue('email', $user->email());	
			$q->bindValue('adresse', $user->adresse());
			$q->bindValue('numDetel', $user->numDetel());
			$q->bindValue('codePostal', $user->codePostal());
			$q->bindValue('ville', $user->ville());	
			$q->execute();
		}
	}

}
