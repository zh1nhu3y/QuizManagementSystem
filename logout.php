<!-- 
Programmer Name: Law Mei Jun, Pan Zhin Huey
Program Name   : Quizify System
Description    : Logout Page
 -->
<?php
session_start();
session_unset();
session_destroy();
header ("Location: home.php");
?>
