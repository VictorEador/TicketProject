<?php
    function connexion($login, $password)
    {
        global $bdd;
        $password_hach = sha1($password);

        $req = $bdd->prepare('SELECT id FROM members WHERE login = :login AND password = :password');
        $req->execute(array('login' => $login, 'password' => $password_hach));
        $resultat = $req->fetch();

        if($resultat)
        {
            session_start();
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['login'] = $login;
            header('Location: billets.php');
            exit();
        }
        else
        {
            echo '<p class=\'error\'>Identifiant ou mot de passe incorrect!</p>';
        }
    }
?>
