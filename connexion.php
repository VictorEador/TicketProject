<?php
	include_once('CTRL_connexion_sql.php');
	include_once('SET_connexion.php');

	session_start();
	if(!empty($_SESSION['login']))
	{
		header('Location: billets.php');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
		<meta charset='utf-8'/>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	</head>

	<body>
		<div id='connexion_part'>
			<p class='title'>Connexion</p>

			<p>Vous possédez déja un compte?</p>

			<?php
				if(isset($_POST['connexion_login']) AND strlen($_POST['connexion_login']) > 0 AND isset($_POST['connexion_password']) AND strlen($_POST['connexion_password']) > 0)
				{
					$member_connexion = connexion(htmlspecialchars($_POST['connexion_login']), htmlspecialchars($_POST['connexion_password']));
				}
			?>

			<p>
				<form action='connexion.php' method='POST'>
					<p class='label'>Identifiant</p>
					<input type='text' name='connexion_login' class='area'>
					<p class='label'>Mot de passe</p>
					<input type='password' name='connexion_password' maxlength='30' class='area'>
					<p style='text-align: center;'><input type='submit' name='Envoi' class='button_black' value='Se connecter'/></p>
				</form>
			</p>
		</div>

		<div id='inscription_part'>
			<p class='title'>Inscription</p>

			<p>Créer un nouveau compte!</p>

			<?php
				include_once('CTRL_inscription.php');
			?>

			<p>
				<form action='connexion.php' method='POST'>
					<p class='label'>Identifiant</p>
					<input type='text' name='inscription_login' <?php echo 'value="'.$login.'"'; ?> class='area'>
					<p class='label'>E-mail</p>
					<input type='text' name='inscription_email' <?php echo 'value="'.$email.'"'; ?> class='area'>
					<p class='label'>Mot de passe</p>
					<input type='password' name='inscription_password' maxlength='30' class='area'>
					<p class='label'>Confirmez le mot de passe</p>
					<input type='password' name='inscription_password2' maxlength='30' class='area'>
					<p style='text-align: center;'><input type='submit' name='Envoi' class='button_white' value="S'inscrire"/></p>
				</form>
			</p>
		</div>
	</body>
</html>
