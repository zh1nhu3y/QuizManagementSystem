<!-- 
Programmer Name: Pan Zhin Huey
Program Name   : Quizify System
Description    : Teacher My Quiz Page 
 -->
<?php
session_start();
include 'dbConn.php';
$tcrID = $_SESSION['tcrID'];
$query = "SELECT * FROM `quiz_t` WHERE `tcr_id` = '$tcrID'";
$results = mysqli_query($connection, $query);
$count = mysqli_num_rows($results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Quiz</title>
    <link rel="stylesheet" href="styles/teacher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/quiz.css">
    <script src="javaScript/validation.js"></script>
    <style>
        .quiz-container {
            width: 50%;
        }
    </style>
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
            <div class="item"><a href=""><i class="fas fa-user"></i>Profile</a></div>
            <div class="item"><a href=""><i class="fas fa-circle-info"></i>Helpdesk</a></div>
            <div class="item"><a href="logout.php"><i class="fas fa-power-off"></i>Logout</a></div>

        </div>
    </div>
    <script src="javaScript/nav.js"></script>

    <div class="quiz-title">
            <h1>My Quiz</h1>
        </div>
    <div class="quiz-container">
        <?php
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
                    $quizID = $row['quiz_id'];
                    $query2 = "SELECT COUNT(*) AS quiz_count FROM `quiz_result_t` WHERE `quiz_id` = '$quizID'";
                    $results2 = mysqli_query($connection, $query2);
                    $row2 = mysqli_fetch_assoc($results2);
                    $quizCount = $row2['quiz_count'];
                    $quizCount = ($count > 0) ? $quizCount : 0;

        ?>
                  <div class="quiz">
                        <div class="quiz-details">
                            <h2><?php echo $row['quiz_title']; ?></h2>
                            <h4><?php echo $row['quiz_sub']; ?></h4>
                        </div>
                        <!-- panel -->
                       
                        <div class="panel">
                            <h5>Number of Students Attempted: <?php echo $quizCount; ?><br><br>Date Created: <?php echo $row['quiz_dt']; ?></h5>
                        </div>
                        
                        <div class="action">
                            <a href="createQuiz2.php?quizID=<?php echo $row['quiz_id']?>" class="edit-link"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="deleteQuiz2.php?quizID=<?php echo $row['quiz_id'] ?>" onclick="return confirmDelete();" class="delete-link"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
    <?} else { ?>
        <?php }}
        mysqli_close($connection);
        ?>
    </div>
</body>
</html>