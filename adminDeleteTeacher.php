<!-- 
Programmer Name: Phuah Kuang Yi
Program Name   : Quizify System
Description    : Admin Delete Teacher Page
 -->
<?php
include 'dbConn.php';

$myID = $_GET['myID'];

$query = "DELETE FROM teacher_t WHERE tcr_id = '$myID'";
if(mysqli_query($connection, $query)) {
    header("Location: adminTeacherList.php");
}   else {
    echo 'Sorry, something went wrong!';
    mysqli_close($connection);
}
?>