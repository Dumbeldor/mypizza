<?php
if(isset($_POST['nom']) || isset($_POST['prenom']) || isset($_POST['pseudo']) || isset($_POST['pass1']) || isset($_POST['pass2']) || isset($_POST['email'])) //Véfication que le formulaire est pas vide !
{
	else if (isset($_POST['nom'])) 
	{ //Vérification nom renseigné
		else if (isset($_POST['prenom'])) 
		{ // Vérification prenom
			else if (isset($_POST['pass1']) && isset($_POST['pass2'])) 
			{ //Mdp renseigné
				else if ($_POST['pass1'] == $_POST['pass1'])
				{ //Meme mot de passe
					else if (strlen($_POST['pass1']) == 6) 
					{//Mot de passe de mini 6 caracteres
						else if (isset($_POST['pseudo']))
						{// Verification pseudo
							if ($userManager->exists($_POST['pseudo']))
							{//Vérification pseudo libre
								if (isset($_POST['email']))
								{//Vérification email
									if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
									{//validation Email
										$user = new User(array(
											'nom' => $_POST['nom'],
											'prenom' => $_POST['prenom'],
											'pseudo' => $_POST['pseudo'],
											'pass' => $_POST['pass1'],
											'email' => $_POST['email'],
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
						$erreur = "Votre mot de passe doit faire au minimum 6 caracteres."
					}
				}
				else
				{ // Mot de passe non identique
					$erreur = "Vos deux mots de passes doivent être identique."
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
	{ // Nom vide
		$erreur = "Remplissez votre nom s'il vous plait.";
	}
} 
else 
{ //Formulaire vide
	$erreur = "Remplissez le formulaire pour vous inscrire.";
}