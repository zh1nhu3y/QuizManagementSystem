<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Teacher My Flashcard Page 
 -->
<?php
session_start();
include 'dbConn.php' ;
$tcrID = $_SESSION['tcrID'];

$query = "SELECT * FROM `flashcard_t` WHERE tcr_id = '$tcrID'";
$results = mysqli_query($connection, $query);
$count = mysqli_num_rows($results); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Flashcard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/teacher.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/flashcard.css">
    <script src="javaScript/validation.js"></script>
</head>
<body>
<div class="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
    <div class="side-bar">
        <header>
            <div class="close-btn">
                <i class="fas fa-times"></i>
            </div>
            <img src="media/logo.png" alt="">
            <h1><?php echo $_SESSION['tcrFn'] . ' ' . $_SESSION['tcrLn']; ?></h1>
        </header>

        <div class="menu">
            <div class="item"><a href="teacherHome.php"><i class="fas fa-house"></i>Home</a></div>
            <div class="item"><a class="sub-btn"><i class="fas fa-newspaper"></i>Quiz
                <i class="fa fa-angle-right dropdown"></i>
                </a>
                <div class="sub-menu">
                    <a href="createQuiz1.php" class="sub-item">Create Quiz</a>
                    <a href="myQuiz.php" class="sub-item">My Quiz</a>
                </div>
            </div>
            <div class="item"><a class="sub-btn"><i class="fas fa-pen"></i>Flashcard
                <i class="fa fa-angle-right dropdown"></i>
                </a>
                <div class="sub-menu">
                    <a href="createFlashcard1.php" class="sub-item">Create Flashcard</a>
                    <a href="myFlashcard.php" class="sub-item">My Flashcard</a>
                </div>
            </div>
            <div class="item"><a href="teacherProfile.php"><i class="fas fa-user"></i>Profile</a></div>
            <div class="item"><a href="helpDesk.php"><i class="fas fa-circle-info"></i>Helpdesk</a></div>
            <div class="item"><a href="logout.php"><i class="fas fa-power-off"></i>Logout</a></div>

        </div>
    </div>
    <script src="javaScript/nav.js"></script>

    <div class="flashcard-container">
        <h1>My Flashcard</h1>
        <?php
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
        ?>
                    <div class="flashcard">
                        <div class="details">
                            <h2><?php echo $row['fc_title']; ?></h2>
                            <h4><?php echo $row['fc_sub']; ?></h4>
                        </div>
                        <div class="actions">
                            <a href="createFlashcard2.php?fcID=<?php echo $row['fc_id'] ?>" class="edit-link"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="deleteFlashcard2.php?fcID=<?php echo $row['fc_id'] ?>" onclick="return confirmDelete();" class="delete-link"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
        <? } else { ?>
        <?php } }
        mysqli_close($connection);
        ?>
    </div>

</body>
</html>