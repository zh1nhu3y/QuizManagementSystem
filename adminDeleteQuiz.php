<!-- 
Programmer Name: Phuah Kuang Yi
Program Name   : Quizify System
Description    : Admin Delete Quiz Page
 -->
<?php
include 'dbConn.php';

$myID = $_GET['myID'];

$query = "DELETE FROM quiz_t WHERE quiz_id = '$myID'";
if(mysqli_query($connection, $query)) {
    header("Location: adminQuizList.php");
}   else {
    echo 'Sorry, something went wrong!';
    mysqli_close($connection);
}
?>