<?php
function chargerClasses($classe)
{
  require '../../class/' . $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}
spl_autoload_register('chargerClasses');
include "session.php";
if(isset($_POST['nomPizzera']) || isset($_POST['nomResponsable']) || isset($_POST['prenomResponsable']) || isset($_POST['ville']) || isset($_POST['adressePostal']) || isset($_POST['rue']) || isset($_POST['pass1']) || isset($_POST['pass2']) || isset($_POST['email'])) //Véfication que le formulaire est pas vide !
{
	if (isset($_POST['nomPizzeria'])) 
	{ //Vérification nom de pizzeria renseigné
		if (isset($_POST['nomResponsable'])) 
		{ // Vérification prenom
			if (isset($_POST['pass1']) && isset($_POST['pass2'])) 
			{ //Mdp renseigné
				if ($_POST['pass1'] == $_POST['pass1'])
				{ //Meme mot de passe
					if (strlen($_POST['pass1']) >= 6) 
					{//Mot de passe de mini 6 caracteres
						if (isset($_POST['pseudo']))
						{// Verification pseudo
							if (!$userManager->exists($_POST['pseudo']))
							{//Vérification pseudo libre
								if (isset($_POST['email']))
								{//Vérification email
									if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
									{//validation Email
										$pizzeria = new Pizzeria(array(
											'nomPizzeria' => $_POST['nomPizzeria'],
											'nomResponsable' => $_POST['nomResponsable'],
											'prenomResponsable' => $_POST['prenomResponsable'],
											'pass' => sha1($_POST['pass1']),
											'telephone' => $_POST['telephone'],
											'email' => $_POST['email'],
											'ville' => $_POST['ville'],
											'adressePostal' => $_POST['adressePostal'],
											'rue' => $_POST['rue'],
											));
										$_SESSION['user'] = $user;
										$userManager->add($user);
									}
									else
									{ //Email non valide
										$erreur = "Votre email est pas valide";
									}
								}
								else
								{//email vide
									$erreur = "Vous devez remplire le champ email";
								}
							}
							else
							{ // Pseudo déjà utilisé
								$erreur = "Le pseudo est déjà utilisé";
							}
						}
						else
						{//Pseudo vide
							$erreur = "Vous devez remplir le champ pseudo.";
						}							
					}
					else
					{ // Mot de passe inférieur a 6 caractere
						$erreur = "Votre mot de passe doit faire au minimum 6 caracteres.";
					}
				}
				else
				{ // Mot de passe non identique
					$erreur = "Vos deux mots de passes doivent être identique.";
				}		
			} 
			else 
			{ // Mot de passe vide
				$erreur = "Remplissez vos mots de passes.";
			}			
		} 
		else 
		{ //Prenom vide
			$erreur = "Remplissez votre prénom s'il vous plait.";
		} 
	} 
	else 
	{ // Nom pizzeria vide
		$erreur = "Remplissez le nom de votre pizzeria s'il vous plait.";
	}
} 
else 
{ //Formulaire vide
	$erreur = "Remplissez le formulaire pour vous inscrire.";
}
if(isset($erreur))
{
	echo $erreur;
}