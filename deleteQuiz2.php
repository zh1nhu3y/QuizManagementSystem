<!-- 
Programmer Name: Pan Zhin Huey
Program Name   : Quizify System
Description    : Teacher Delete Quiz Page (delete selected question set)
 -->
<?php
include 'dbConn.php';

$quizID = $_GET['quizID'];

$query = "DELETE FROM `quiz_ans_t` WHERE quiz_id = '$quizID' ; DELETE FROM `quiz_result_t` WHERE quiz_id = '$quizID' ; DELETE FROM `quiz_t` WHERE  quiz_id  = '$quizID'";
$results = $connection->multi_query($query);
if($results) {
    header("Location: myQuiz.php?quizID=".$quizID."");
} else {
    echo 'Sorry, Something Went Wrong';
    mysqli_close($connection);
}
?>