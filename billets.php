<?php
	session_start();

	if(empty($_SESSION['login']))
	{
		session_destroy();
		header('Location: connexion.php');
	}

	include_once('CTRL_connexion_sql.php');
	include_once('GET_billets.php');
	include_once('GET_messages_count.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Billets</title>
		<meta charset='utf-8'/>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	</head>

	<body>
		<div id='menu_billets'>
			<a href='CTRL_deconnexion.php' class='button_link'># Se deconnecter</a>
			<div class='button_link'>
				+ Nouveau billet
			</div>
		</div>
		<div id='billets_list'>
			<?php
				$billets = get_billets(0, 10);

				foreach($billets as $billet)
				{
					?>
					<a class='billet' href='messenger.php?billet=<?php echo $billet['id'] ?>'>
						<div class='billet_title'>
							<?php
								echo nl2br(htmlspecialchars($billet['name']));
							?>
						</div>
						<div class='billet_infos'>
							<?php
								echo get_messages_count($billet['id']).' réponses';
							?>
						</div>
					</a>
					<?php
				}
			?>
		</div>
	</body>
</html>
