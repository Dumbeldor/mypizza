<?php 
function chargerClasses($classe)
{
  require '../../class/' . $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasses'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
include "session.php";

if (isset($_POST['nomPizzeria']) || isset($_POST['pass']))
{//Si le formulaire est remplis
	if (isset($_POST['nomPizzeria']))
	{ //Le nom de la pizzeria est remplis
		if (isset($_POST['pass']))
		{ //Le pass est remplis
			if($pizzeriaManager->exists($_POST['nomPizzeria']))
			{//vérification si le nom de la pizzeria exist
				if($pizzeriaManager->pass($_POST['nomPizzeria'], sha1($_POST['pass'])))
				{//vérification si le pass correspond
					$pizzeria = $pizzeriaManager->get($_POST['nomPizzeria']);
					$_SESSION['pizzeria'] = $pizzeria;
					echo "Bienvenue "; echo $pizzeria->nomResponsable();
				}
				else
				{ // Le pass est incorrect
					$erreur = "Mot de passe incorrect";
				}
			}
			else
			{//Le nom de la pizzera n'existe pas
				$erreur = "Le nom de votre pizzeria est incorrect";
			}
		}
		else
		{//le champ pass est vide
			$erreur = "Le champ mot de passe soit être remplis !";
		}
	}
	else
	{//Le champ nom pizzeria est vide
		$erreur = "Le champ nom pizzeria doit être remplis";
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
