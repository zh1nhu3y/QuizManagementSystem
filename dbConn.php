<!-- 
Programmer Name: Law Mei Jun, Pan Zhin Huey
Program Name   : Quizify System
Description    : Database Connection
 -->
<?php
$host = 'localhost'; // 
$user = 'root';
$password = '';
$database = 'quizifySystem'; //127.0.0.1
$connection = mysqli_connect($host, $user, $password, $database);

if ($connection === false) {
    die('Connection failed ' . mysqli_connect_error());
}
?>