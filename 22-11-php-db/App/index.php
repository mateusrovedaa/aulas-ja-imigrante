<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$db = new Database();
$connection = $db->getConnection();
$sql = "SELECT * FROM users ORDER BY id";
$stmt = $connection->query($sql);
$users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
$db->closeConnection();
var_dump($users);