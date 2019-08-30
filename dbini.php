<?php
session_start();
$user = 'root';
$pass = '';
$db = 'movie_reviewer';
$db = new mysqli('localhost', $user, $pass, $db) or die("connection fail");
?>
