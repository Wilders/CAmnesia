<?php
session_start();
session_destroy();
session_start();
$_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté.';
header('Location: login.php');
die();
?>