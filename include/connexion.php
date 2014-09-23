<?php 
function chargerClasses($classe)
{
  require '../class/' . $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasses'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
include "session.php";

if (isset($_POST['pseudo']) || isset($_POST['pass']))
{//Si le formulaire est remplis
	if (isset($_POST['pseudo']))
	{ //Le pseudo est remplis
		if (isset($_POST['pass']))
		{ //Le pass est remplis
			if($userManager->exists($_POST['pseudo']))
			{//vérification si le pseudo exist
				if($userManager->pass($_POST['pseudo'], sha1($_POST['pass'])))
				{//vérification si le pass correspond
					$user = $userManager->get($_POST['pseudo']);
					$_SESSION['user'] = $user;
					echo "Bienvenue "; echo $user->pseudo();
				}
				else
				{ // Le pass est incorrect
					$erreur = "Mot de passe incorrect";
				}
			}
			else
			{//Le pseudo n'existe pas
				$erreur = "Le pseudo est incorrect";
			}
		}
		else
		{//le champ pass est vide
			$erreur = "Le champ mot de passe soit être remplis !";
		}
	}
	else
	{//Le champ pseudo est vide
		$erreur = "Le champ pseudo doit être remplis";
	}
}
else
{ // Si le formulaire est vide
	$erreur = "Le formulaire de connexion doit être remplis";
}
if (isset($erreur))
{
	echo $erreur;
}
