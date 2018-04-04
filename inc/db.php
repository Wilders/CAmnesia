<?php
try {
$bdd = new PDO('mysql:host=HOST;dbname=DATABASE;charset=utf8', 'USER', 'PASSWORD');
}
catch(Exception $e) {
	die('Erreur : ' . $e->getMessage());
}
?>