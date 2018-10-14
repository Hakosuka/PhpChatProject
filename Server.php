<?php
/**
 * Created by PhpStorm.
 * Author: Ciaran Cumiskey
 * Date: 10/10/2018
 * Time: 19:43
 *
 * TODO: Server constructor
 * TODO: Handle user registration
 * TODO: Sending messages (hint: multi-D arrays)
 * TODO: User can read their messages
 * TODO: User can pick messages from particular users
 */
$host = "DB_HOST";
$username = "DB_USER";
$password = "1TwoThree";
$database = "DB_NAME";

function __construct(){
    $msgDB = new SQLite3('analtyics.sqlite', SQLITE3_OPEN_CREATE || SQLITE3_OPEN_READWRITE);
    $msgDB->query('CREATE TABLE IF NOT EXISTS "messages" (
        "msgID" INTEGER PRIMARY KEY NOT NULL,
        "senderID"
        "senderName" VARCHAR,
        "inboxID" INTEGER,
        "inboxName" VARCHAR,
        "msgContent" VARCHAR,
        "msgTime" DATETIME
    )');
    $usersDB = new SQLite3('analtyics.sqlite', SQLITE3_OPEN_CREATE || SQLITE3_OPEN_READWRITE);
    $usersDB->query('CREATE TABLE IF NOT EXISTS "users" (
        "userID" INTEGER PRIMARY KEY NOT NULL,
        "username" VARCHAR
    )');
}

__construct();

if(!$_POST['content'] || !$_POST['sender'] || !$_POST['recipient']){
    exit("All fields are required.");
}
if($_POST){
    //TODO: Handle user messages1`
}
?>
<!doctype HTML>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Chat</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div id="user-sidebar">
    <!---->
</div>
<div id="message-entry">
    <form action="ClientController.php" method="POST">
        <input type="text" name="sender" placeholder="Enter your username"/>
        <input type="text" name="recipient"/>
        <textarea name="content" placeholder="Enter your message"></textarea>
        <button type="submit">Send</button>
    </form>
</div>
<script src="./script.js"></script>
</body>
</html>
