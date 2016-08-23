<?php

    try
    {
        /*$bdd = new PDO('mysql:host=mysql.hostinger.fr;dbname=u957914581_890m', 'u957914581_890m', 'Fgtredcvb7913');*/
        $bdd = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

?>
