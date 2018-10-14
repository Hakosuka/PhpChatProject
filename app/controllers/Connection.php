<?php
/**
 * Created by PhpStorm.
 * User: Ciaran Cumiskey
 * Date: 14/10/2018
 * Time: 23:41
 */

$pdo = new PDO('sqlite:' . __DIR__ . '/messages.db') or
    exit(json_encode(['status' => 'error', 'message' => 'Failed to open database']));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('PRAGMA foreign_keys = ON');