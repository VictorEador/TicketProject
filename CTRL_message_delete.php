<?php
	session_start();

	include_once('CTRL_connexion_sql.php');

	// Insertion du message à l'aide d'une requête préparée
	$req = $bdd->prepare('DELETE FROM messages WHERE id=:id');
	$req->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
	$req->execute();

	// Redirection du visiteur vers la page du minichat
	header('Location: messenger.php?billet='.$_GET['billet']);
?>
