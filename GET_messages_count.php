<?php
    function get_messages_count($billet_id)
    {
        global $bdd;
        $billet_id = (int) $billet_id;
        $message_count = 0;

        $req = $bdd->prepare('SELECT date_post
                                FROM messages
                                WHERE billet_id = :billet_id
                                ORDER BY id');

        $req->execute(array('billet_id' => $billet_id));
        while($answer = $req->fetch())
        {
            $message_count++;
        }

        return $message_count;
    }
?>
