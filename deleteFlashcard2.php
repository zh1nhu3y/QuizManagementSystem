<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Teacher Delete Flashcard Page (delete selected flashcard set)
 -->
<?php
include 'dbConn.php';

$fcID = $_GET['fcID'];

$sql = "DELETE FROM flashcard_content_t WHERE fc_id = '$fcID'; DELETE FROM flashcard_t WHERE fc_id = '$fcID'; ";
$results = $connection->multi_query($sql);
if($results) {
    header("Location: myFlashcard.php?fcID=".$fcID.""); 
} else {
    echo 'Sorry, something went wrong!';
    mysqli_close($connection);
}
?>