<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Code for Ajax Live Search
 -->
<?php
session_start();
include 'dbConn.php';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="blog.css">
<link rel="stylesheet" href="event.css">
</head>
<style>
    .details {
        width: 55%;
        height: 120px;
        background: whitesmoke;
        margin: auto;
        border-bottom: 3px solid #FF8400;
        box-sizing: border-box;
        padding: 1px 40px;
        margin-bottom: 0px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        line-height: 1;
        transition: all 0.3s ease;
        /* margin-top: 30px; */
    }
    .details h4 {
        margin-top: -10px;
    }
    .details a {
        /* float: right; */
        text-decoration: none;
        color: black;
        /* margin-top: -70px; */
        /* margin-right: 30px; */
        /* text-transform: uppercase; */
        /* font-weight: bold; */
        /* font-size: 18px;  */
    }
    .details a:hover {
        color: #176B87;
    }
    .clear {
        clear: both;
    }
</style>
<?php
if ($_POST['option'] == "flashcard"){
    $sql = "SELECT * FROM flashcard_t INNER JOIN teacher_t ON flashcard_t.tcr_id = teacher_t.tcr_id WHERE (fc_title LIKE '%".$_POST['name']."%' )";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result) > 0){
        while ($row=mysqli_fetch_assoc($result)) { ?>

            <div class="container" >
                <div class="details">
                    <a href="FlashcardFunction.php?fcID=<?php echo $row['fc_id'];?>">
                        <h2><?php echo $row['fc_title'] ?></h2>
                        <h4><?php echo $row['fc_sub'] ?></h4>
                        <h4>By: <?php echo $row['tcr_fn'] . ' ' . $row['tcr_ln'] ?></h4>
                        <div class="clear"></div>
                    </a>
                </div>
            </div>
<?php
    }
} 
else{
    ?>
    <div style="width: 100%"><h1 style="text-align: center; color: white">No Result Found</h1></div>
<?php
} 
} elseif ($_POST['option'] == "quiz") { 
    $sql = "SELECT * FROM quiz_t INNER JOIN teacher_t ON quiz_t.tcr_id = teacher_t.tcr_id WHERE (quiz_title LIKE '%".$_POST['name']."%' )";
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result) > 0){
        while ($row=mysqli_fetch_assoc($result)) { ?>

            <div class="container" >
            <div class="details">
                    <a href="QuizFunction.php?quizID=<?php echo $row['quiz_id'];?>">
                        <h2><?php echo $row['quiz_title'] ?></h2>
                        <h4><?php echo $row['quiz_sub'] ?></h4>
                        <h4>By: <?php echo $row['tcr_fn'] . ' ' . $row['tcr_ln'] ?></h4>
                        <div class="clear"></div>
                    </a>
                </div>
            </div>
            <?php
        }
    } else{
    ?>
    <div style="width: 100%"><h1 style="text-align: center; color: white">No Result Found</h1></div>
    <?php
    } }?>
</html>