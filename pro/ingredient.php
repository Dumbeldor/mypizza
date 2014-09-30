<?php
include "include/session.php";
if(isset($pizzeria))
{ //Si le responsable de la pizzeria est connecté
	echo "bienvenue "; echo $pizzeria->nomResponsable(); ?>
	</br><p>Voici la liste des ingredients, choissisez parmis cela ceux que vous avez en stock :</p>
	<?php
}
else
{//Si le responsable de la pizzeria est pas connecté
	header('Location: index.php');  
}
