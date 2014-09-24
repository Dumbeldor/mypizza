<?php
function chargerClasse($classe)
{
  require '../class/' . $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
try {
    $db = new PDO('mysql:host=localhost;dbname=mypizza', 'root', '');
	$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$pizzeriaManager = new PizzeriaManager($db);

session_start();

if (isset($_SESSION['pizzeria'])) // Si la session user existe, on restaure l'objet.
{
  $pizzeria = $_SESSION['pizzeria'];
}
else if (isset($pizzeria)) // Si on a créé un user, on le stocke dans une variable session afin d'économiser une requête SQL.
{
  $_SESSION['pizzeria'] = $pizzeria;
}
if (isset($_GET['deconnexion']))
{
	$pizzeriaManager->update($pizzeria);
  session_destroy();
  header('Location: .');
  exit();
}
 ?>