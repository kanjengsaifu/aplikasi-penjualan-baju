<?php
// require_once 'vendor/autoload.php';
require "pengaturan.php";

// Using Medoo namespace
use Medoo\Medoo;

// Initialize
$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => $nama_database,
    'server' => $nama_server,
    'username' => $username,
    'password' => $password
]);
?>
