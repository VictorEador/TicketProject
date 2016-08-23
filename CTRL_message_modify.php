<?php
	session_start();

	include_once('CTRL_connexion_sql.php');

	if(strlen($_POST['message']) > 0)
	{
		$req = $bdd->prepare('UPDATE messages SET message = :new_message WHERE id = :id');
		$req->execute(array('new_message' => $_POST['message'], 'id' => $_GET['modify']));
	}

	header('Location: messenger.php?billet='.$_GET['billet']);
?>
