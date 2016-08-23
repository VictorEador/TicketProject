<?php
    function get_messages($offset, $limit, $billet_id)
    {
        global $bdd;
        $offset = (int) $offset;
        $limit = (int) $limit;
        $billet_id = (int) $billet_id;

        $req = $bdd->prepare('SELECT id, message, date_post, login
                                FROM messages
                                WHERE billet_id = :billet_id
                                ORDER BY id LIMIT :offset, :limit ');

        $req->bindParam(':offset', $offset, PDO::PARAM_INT);
        $req->bindParam(':limit', $limit, PDO::PARAM_INT);
        $req->bindParam(':billet_id', $billet_id, PDO::PARAM_INT);
        $req->execute();
        $messages = $req->fetchAll();

        return $messages;
    }
?>
