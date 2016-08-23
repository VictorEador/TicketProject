<?php
	session_start();

	if(empty($_SESSION['login']))
	{
		session_destroy();
		header('Location: connexion.php');
	}

	include_once('CTRL_connexion_sql.php');
	include_once('GET_messages.php');
	include_once('GET_billet_infos.php');
	include_once('GET_messages_count.php');

	if(isset($_GET['billet']))
	{
		$post_id = htmlspecialchars($_GET['billet']);
	}
	else
	{
		header('Location: billets.php');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Billet</title>
		<meta charset='utf-8'/>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	</head>

	<body>
		<div id='upper_bar'>
			<?php
				get_billet_infos($post_id);
			?>
			<a href='billets.php' class='button_come_back'>Retour</a>
		</div>

		<div id='post'>
			<div id='messages_list'>
					<?php
						$messages = get_messages(0, 10, $post_id);

						foreach($messages as $message)
						{
							if($message['login'] == $_SESSION['login'])
							{
								$date = date_create($message['date_post']);
								?>
								<div class='user_message'>
									<div class='transition'>
									</div>
									<div class='user_message_contenu'>
										<?php
										if(isset($_GET['modify']) AND $_GET['modify'] == $message['id'])
										{
											?>
											<form action='CTRL_message_modify.php?billet=<?php echo $post_id ?>&modify=<?php echo $message['id']?>' method='POST'>
												<textarea name='message' class='message_area' rows='10'><?php echo $message['message']; ?></textarea>
												<input type='submit' name='Envoi' value='Modifier' class='button_black'/>
											</form>
											<?php
										}
										else
										{
											echo '<span><strong>Je dit...</strong></span>';
											echo nl2br(htmlspecialchars($message['message']));
										}
										?>
									</div>
									<div class='message_info'>
										<?php echo date_format($date, 'd/m/Y H:i:s'); ?>
										<a href='CTRL_message_delete.php?billet=<?php echo $post_id ?>&id=<?php echo $message['id']?>' class='button_link'>Supprimer</a>
										<a href='messenger.php?billet=<?php echo $post_id ?>&modify=<?php echo $message['id']?>' class='button_link'>Modifier</a>
									</div>
								</div>
								<?php
							}
							else
							{
								?>
								<div class='other_message'>
									<div class='other_message_contenu'>
										<span><strong><?php echo htmlspecialchars($message['login']); ?> dit...</strong></span>
										<?php echo nl2br(htmlspecialchars($message['message'])); ?>
									</div>
									<div class='message_info'>
										<?php echo $message['date_post']; ?>
									</div>
								</div>
								<?php
							}
						}
					?>
			</div>
		</div>

		<div id='footer'>
			<div id='message_form'>
				<form action='CTRL_message_post.php?billet=<?php echo $post_id?>' method='POST'>
					<textarea name='message' class='message_area' rows='10'></textarea>
					<input type='submit' name='Envoi' value='Contribuer' class='button_black'/>
				</form>
			</div>
			<div id='infos_post'>
				<p id='infos_title'>Infos >>></p>
				<?php
					if(get_messages_count($post_id) == 1)
					{
						echo 'Ce billet ne contient aucunes réponses';
					}
					else
					{
						echo 'Ce billet contient ' . get_messages_count($post_id) . ' réponses';
					}
				?>
			</div>
		</div>
	</body>
</html>
