<!-- 
Programmer Name: Phuah Kuang Yi
Program Name   : Quizify System
Description    : Admin Delete Student Page
 -->
<?php
include 'dbConn.php';

$myID = $_GET['myID'];

$query = "DELETE FROM student_t WHERE std_id = '$myID'";
if(mysqli_query($connection, $query)) {
    header("Location: adminStudentList.php");
}   else {
    echo 'Sorry, something went wrong!';
    mysqli_close($connection);
}
?>