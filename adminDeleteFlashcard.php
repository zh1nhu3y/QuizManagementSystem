<?php
include 'dbConn.php';

$myID = $_GET['myID'];

$query = "DELETE FROM flashcard_t WHERE fc_id = '$myID'";
if(mysqli_query($connection, $query)) {
    header("Location: adminFlashcardList.php");
}   else {
    echo 'Sorry, something went wrong!';
    mysqli_close($connection);
}
?>