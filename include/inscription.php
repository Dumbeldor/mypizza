<?php
function chargerClasses($classe)
{
  require '../class/' . $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}
spl_autoload_register('chargerClasses');
include "session.php";
if(isset($_POST['nom']) || isset($_POST['prenom']) || isset($_POST['pseudo']) || isset($_POST['pass1']) || isset($_POST['pass2']) || isset($_POST['email']) || isset ($_POST['adresse']) || isset ($_POST['codePostal'])|| isset ($_POST['ville'])|| isset ($_POST['numDetel'])) //Véfication que le formulaire est pas vide !
{
	if (isset($_POST['nom'])) 
	{ //Vérification nom renseigné
		if (isset($_POST['prenom'])) 
		{ // Vérification prenom
			if (isset($_POST['pass1']) && isset($_POST['pass2'])) 
			{ //Mdp renseigné
				if ($_POST['pass1'] == $_POST['pass2'])
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
										if (isset($_POST['adresse']))
										{// vérification adresse
											if (isset($_POST['codePostal']))
											{// vérification code postal
													if (strlen($_POST['codePostal'])==5)
													{// vérification code postal longueur			

														if (isset($_POST['ville']))
														{// vérification ville

															if (isset($_POST['numDetel']))
															{// verfication num tel	
																	if (strlen($_POST['numDetel'])==10)
																	{// vérification de la taille du  numéro de téléphone

																			$user = new User(array(
																			'nom' => $_POST['nom'],
																			'prenom' => $_POST['prenom'],
																			'pseudo' => $_POST['pseudo'],
																			'pass' => sha1($_POST['pass1']),
																			'email' => $_POST['email'],
																			'adresse' => $_POST['adresse'],
																			'codePostal' => $_POST['codePostal'],
																			'ville' => $_POST['ville'],
																			'numDetel' => $_POST['numDetel'],
																			));
																			$_SESSION['user'] = $user;
																			$userManager->add($user);
																	}
																	
																	else
																   {//verification de numero de telephone
																	$erreur = "Votre numéro de téléphone n'est pas valide";
																	
																	}
															}
															else
															{//numero de telephone
															$erreur = "Votre numéro de téléphone n'est pas valide";
															}
														}
														else
														{// ville invalide 
															$erreur = "Votre ville n'est pas valide";
														}
												}	
												else
												{// taille code postal invalide
													$erreur = "Votre code postal n'est pas valide";
												}
											}
											else
											{// code Postal vide
												$erreur = "Votre code postal n'est pas valide il doit faire 5 caractère ";
											}	
										}
										else
										{// adresse non valide
											$erreur = "Votre adresse n'est pas valide";
										}
									}
									else
									{ //Email non valide
										$erreur = "Votre email n'est pas valide";
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
	{ // Nom vide
		$erreur = "Remplissez votre nom s'il vous plait.";
	}
} 
else 
{ //Formulaire vide
	$erreur = "Remplissez le formulaire pour vous inscrire.";
}
if(isset($erreur))
{// affichage d'erreur
	echo $erreur;
}