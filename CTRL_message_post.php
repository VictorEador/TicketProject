<?php
	session_start();

	include_once('CTRL_connexion_sql.php');

	if(strlen($_POST['message']) > 0)
	{
		// Insertion du message à l'aide d'une requête préparée
		$req = $bdd->prepare('INSERT INTO messages (message, date_post, login, billet_id)
								VALUES(?, NOW(), ?, ?)');

		$req->execute(array($_POST['message'], $_SESSION['login'], $_GET['billet']));
	}

	// Redirection du visiteur vers la page du minichat
	header('Location: messenger.php?billet='.$_GET['billet']);
?>
