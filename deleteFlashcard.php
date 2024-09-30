<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Teacher Delete Flashcard Page (delete selected flashcard content)
 -->
<?php
include 'dbConn.php';

$contID = $_GET['contID'];
$fcID = $_GET['fcID'];

$query = "DELETE FROM flashcard_content_t WHERE cont_id = '$contID'";
if(mysqli_query($connection, $query)) {
    header("Location: createFlashcard2.php?fcID=".$fcID.""); 
}   else {
    echo 'Sorry, something went wrong!';
    mysqli_close($connection);
}
?>