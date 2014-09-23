<?php
function chargerClasse($classe)
{
  require 'class/' . $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
try {
    $db = new PDO('mysql:host=localhost;dbname=', '', '');
	$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$userManager = new UserManager($db);

session_start();

if (isset($_SESSION['user'])) // Si la session user existe, on restaure l'objet.
{
  $user = $_SESSION['user'];
}
else if (isset($perso)) // Si on a créé un user, on le stocke dans une variable session afin d'économiser une requête SQL.
{
  $_SESSION['user'] = $user;
}
if (isset($_GET['deconnexion']))
{
	$manager->update($perso);
	$inventaireManager->update($inventaire);
  session_destroy();
  header('Location: .');
  exit();
}
 ?>