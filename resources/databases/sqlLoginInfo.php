<?php
//makes it easier for this code to work on different computers, as changing login information here
//changes it throughout this project
$host = 'localhost';
$username = 'phpmyadmin';
$password = 'root';
$database = 'team7';

$db = new mysqli($host, $username, $password, $database);

//if can not connect to database, error
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

?>