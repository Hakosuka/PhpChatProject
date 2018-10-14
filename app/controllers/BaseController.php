<?php
/**
 * Created by PhpStorm.
 * Author: Ciaran Cumiskey
 * Date: 12/10/2018
 * Time: 16:55
 */
require(__DIR__ . 'Connection.php');
class BaseController {
    function __construct(){
        global $pdo;
        $this -> pdo = $pdo;
    }
}