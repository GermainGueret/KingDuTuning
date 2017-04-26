<?php

    $maconnexion = new mysqli("localhost","root","iuttroyes","symfony"); 
   // $resultat = $maconnexion -> query("SELECT pseudo, phrase FROM ( select * from chat ORDER BY id DESC LIMIT 10) as chat_virtuel ORDER BY id ASC");
    // solution php 
    $resultat = $maconnexion -> query("SELECT chat_joueur_1, chat_joueur_2, chat_message FROM chat ORDER BY id DESC LIMIT 10");
    while($un=$resultat->fetch_array())
        {
            echo '<div class="text">'.$un['chat_joueur_1'].' > ';
            echo $un['chat_message'].'</div><br>';
        };

/** solution php : 
$messages = array();
    while($un=$resultat->fetch_array())
        {
        $messages[] = $un;
        };
    $messages = array_reverse($messages);
    foreach($messages as $un)
        {
            echo $un['pseudo'].' > ';
            echo $un['phrase'].'<br>';
        };**/

?>