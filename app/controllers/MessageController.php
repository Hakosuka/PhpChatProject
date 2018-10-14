<?php
/**
 * Created by PhpStorm.
 * User: Ciaran Cumiskey
 * Date: 14/10/2018
 * Time: 22:43
 */
class MessageController extends BaseController {
    public function newMessage(){
        if(!isset($_POST['content'], $_POST['to'], $_POST['from'])) {
            return http_response_code(400);
        }
        if($_POST['content']===''){
            return json_encode([
                'status' => 'error',
                'message' => 'Please enter a message'
            ]);
        }
        $msgContent = trim($_POST['content']);
        $msgContent = htmlspecialchars($msgContent);
        $msgDBQuery = "INSERT INTO messages (msgId, 'senderName', 'inboxName', msgContent, msgTime)
          VALUES(:msgId, :yourName, :recipient, :content, :msgTime)";
        try {
            $msgSt = $this -> pdo -> prepare($msgDBQuery);
            $msgSt -> execute(['msgId' => uniqid(),
                'senderName' => $_POST['sender'],
                'inboxName' => $_POST['recipient'],
                'msgContent' => $msgContent,
                'msgTime' => time()]);
        } catch (PDOException $e) {
            throw $e;
        }
    }
    public function getMessages(){
    }
}