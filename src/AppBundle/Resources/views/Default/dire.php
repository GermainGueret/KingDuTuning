<?php

        $pseudo = "utilisateur1";
        $pseudo2 = "utilisateur2"; 
        $phrase = $_GET['phrase'];

$maconnexion = new mysqli("localhost","root","iuttroyes","symfony");

$req = "INSERT INTO chat (chat_message, chat_joueur_1, chat_joueur_2) VALUES ('".$phrase."', '".$pseudo."', '".$pseudo2."";
            $resultat = $maconnexion->query($req);
?>
