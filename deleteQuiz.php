<!-- 
Programmer Name: Pan Zhin Huey
Program Name   : Quizify System
Description    : Teacher Delete Quiz Page (delete selected question and answer)
 -->
<?php
include 'dbConn.php';

$quesID = $_GET['quesID'];
$quizID = $_GET['quizID'];

$query = "DELETE FROM `quiz_ans_t` WHERE '$quesID' = ques_id";
if (mysqli_query($connection, $query)) {
    header("Location: createQuiz2.php?quizID=".$quizID.""); 
}  else {
    echo 'Sorry, something went wrong!';
    mysqli_close($connection);
}
?>