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
require(__DIR__ . 'app/controllers/BaseController.php');
require(__DIR__ . 'app/controllers/ClientController.php');
require(__DIR__ . 'app/controllers/MessageController.php');

/**
 * @param $method - The user's request method
 * @param $route
 * @param $callback - The callback to be executed
 * @throws Exception
 */
function respond($method, $route, $callback){
    if(gettype($callback)!=="string" && !is_callable($callback)){
        throw new Exception('$callback needs to be a parameter or function');
    }
    if($_SERVER['REQUEST_METHOD'] !== $method){
        return;
    }
    $matches = null;
    if (!preg_match('/^\/' . $route . '/', $_SERVER['REQUEST_URI'], $matches)) {
        return;
    }
    if(gettype($callback) === "string") {
        list($basecontroller, $action) = explode("@", $callback);
        if (class_exists($basecontroller)) {
            $controller = new $basecontroller();
            header('Content-type: app/json');
            echo $basecontroller->$action();
            exit;
        }
    } else {
            echo $callback($matches);
            exit;
        }
    }
    //Respond to user creation
    respond('POST', 'users', 'ClientController@createUser');
    respond('GET', 'users', 'ClientController@getID');
    //Respond to messaging
    respond('POST', 'messages', 'MessageController@newMessage');
    respond('GET', 'messages', 'MessageController@getMessages');

    respond('GET', '[a-z_]*\.(css|js)$', function ($matches) {
        // $matches = array(0 => '/filename.extension', 1 => 'extension')
        if (file_exists(__DIR__ . '/client' . $matches[0])) {
            $type = $matches[1] === 'css' ? 'css' : 'javascript';
            header('Content-type: text/' . $type);
            readfile(__DIR__ . '/client' . $matches[0]);
        }
    });
    // If all else fails, send the user to index.html
    respond('GET', '', function() {
        readfile(__DIR__ . '/client/index.html');
});