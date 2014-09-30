<?php
include "include/session.php";
if(isset($pizzeria))
{ //Si le responsable de la pizzeria est connecté
	echo "bienvenue "; echo $pizzeria->nomResponsable(); ?>
	</br><p>Ajoutez des ingrédients disponible dans votre pizzeria ! Pour que vos clients puisse choisir lors de la création de leurs pizza</p>
	<a href="ingredient.php">Ajoutez ingredient</a><?php
}
else
{//Si le responsable de la pizzeria est pas connecté
	?><a href="connexion.php">Connectez vous</a> <a href="inscription.php">Inscrivez votre pizzeria</a> <?php
}
