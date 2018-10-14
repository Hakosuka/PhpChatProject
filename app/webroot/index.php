<?php
/**
 * Created by PhpStorm.
 * User: Ciaran Cumiskey
 * Date: 13/10/2018
 * Time: 20:17
 */

if ($messages) {
    $msgSt = $db->prepare('SELECT * FROM "messages" WHERE "userId" = ? BY "msgTime"');
    //TODO: Retrieve the user's ID somehow
    $msgSt->bindValue(1, 33);
    $msgRes = $msgSt->execute();
    //Cycle through the messages
    foreach($msgRes as $message){
        print_r($msgRes->fetchArray(SQLITE3_NUM));
        echo("\n");
    }
}