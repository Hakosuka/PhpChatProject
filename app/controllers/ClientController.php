<?php
/**
 * Created by PhpStorm.
 * Author: Ciaran Cumiskey
 * Date: 12/10/2018
 * Time: 16:54
 */
namespace app\controllers;

class Client extends \BaseController {
    public function createUser(){
        //TODO: Increment the user count from the Server to get the ID for the new user
        if(strlen($_POST['username']) > 20){
            return json_encode([
               'status' => 'error',
               'message' => 'Please enter 20 characters or less.'
            ]);
        }
        $nameQ = 'INSERT INTO users (userID, username) VALUES (:userID, :username)';
        $name = trim(strtolower($_POST['username']));
        $name = htmlspecialchars($name);
        try {
            $nameSt = $this -> pdo -> prepare($nameQ);
            $nameSt -> execute([
                'userID' => uniqid(),
                'username' => $name
            ]);
            $_GET['username'] = $name;
            return $this -> getID();
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

function getID(){
    //Don't bother looking for a name longer than 20 characters
    if(strlen($_GET['username'] > 20)){
        return json_encode(['status' => 'okay', 'id' => null]);
    }
    $name = trim(strtolower($_GET['username']));
    $nameQ = 'SELECT userID FROM users WHERE username = :username';
    $nameSt = $this -> pdo -> prepare($nameQ);
    $nameSt -> execute(['username' => $name]);
    $row = $nameSt -> fetch();
    return json_encode(['status' => 'OK', 'id' => $row['userID']]);
}
