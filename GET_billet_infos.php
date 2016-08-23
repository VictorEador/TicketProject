<?php
    function get_billet_infos($billet_id)
    {
        global $bdd;
        $billet_id = (int) $billet_id;

        $req = $bdd->prepare('SELECT members.login, billets.name
                                FROM members
                                INNER JOIN billets
                                ON members.id = billets.auteur_id
                                WHERE billets.id = :billet_id');

        $req->execute(array('billet_id' => $billet_id));
        $billet_infos = $req->fetch();

        echo '<span class=\'title_post\'>Billet - ' . htmlspecialchars($billet_infos['name']) . '</span>';

        echo '<span class=\'auteur\'>Posté par ' . htmlspecialchars($billet_infos['login']) . '</span>';
    }
?>
