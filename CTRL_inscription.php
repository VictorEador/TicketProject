<?php
    $inscriptionError = false;
    $login = '';
    $email = '';

    if(isset($_POST['inscription_login']) AND isset($_POST['inscription_email']) AND isset($_POST['inscription_password']) AND isset($_POST['inscription_password2']))
    {
        if(strlen($_POST['inscription_login']) > 0 AND strlen($_POST['inscription_email']) > 0 AND strlen($_POST['inscription_password']) > 0 AND strlen($_POST['inscription_password2']) > 0)
        {
            $reqLogin = $bdd->prepare('SELECT * FROM members WHERE login = :login');
            $reqLogin->bindParam(':login', $_POST['inscription_login'], PDO::PARAM_STR);
            $reqLogin->execute();
            $resultatLogin = $reqLogin->fetch();

            if($resultatLogin)
            {
                $inscriptionError = true;
                echo '<p class=\'error\'>Identifiant déja utilisé!</p>';
            }
            else
            {
                $login = $_POST['inscription_login'];
            }

            $reqEmail = $bdd->prepare('SELECT * FROM members WHERE email = :email');
            $reqEmail->bindParam(':email', $_POST['inscription_email'], PDO::PARAM_STR);
            $reqEmail->execute();
            $resultatMail = $reqEmail->fetch();

            if($resultatMail)
            {
                $inscriptionError = true;
                echo '<p class=\'error\'>Adresse mail déja utilisé!</p>';
            }
            else if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", htmlspecialchars($_POST['inscription_email'])))
            {
                $inscriptionError = true;
                echo '<p class=\'error\'>Adresse mail non conforme!</p>';
            }
            else
            {
                $email = $_POST['inscription_email'];
            }

            if($_POST['inscription_password'] != $_POST['inscription_password2'])
            {
                $inscriptionError = true;
                echo '<p class=\'error\'>Les deux mots de passes ne sont pas identiques!</p>';
            }

            if(!$inscriptionError)
            {
                $password_hach = sha1(htmlspecialchars($_POST['inscription_password']));

        		$req = $bdd->prepare('INSERT INTO members (login, email, password) VALUES(:login, :email, :password)');
        		$req->execute(array('login'=>$_POST['inscription_login'], 'email'=>$_POST['inscription_email'], 'password'=>$password_hach));
                echo '<p class=\'error\'>Votre inscription est effective</p>';

                $login = '';
                $email = '';
            }
        }
    }
?>
