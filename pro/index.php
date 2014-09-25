<?php
include "include/session.php";
if(isset($pizzeria))
{ //Si le responsable de la pizzeria est connecté
	echo "bienvenue "; echo $pizzeria->nomResponsable(); ?>
	</br><p><?php
}
else
{//Si le responsable de la pizzeria est pas connecté
	?><a href="connexion.php">Connectez vous</a> <a href="inscription.php">Inscrivez votre pizzeria</a> <?php
}
