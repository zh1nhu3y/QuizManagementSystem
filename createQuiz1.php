<!-- 
Programmer Name: Pan Zhin Huey
Program Name   : Quizify System
Description    : Teacher Create Quiz Page (title and subject)
 -->
<?php
session_start();
include 'dbConn.php';
$tcr_id = $_SESSION['tcrID'];
if (isset($_POST['next'])) {
  $title = $_POST['title'];
  $subject = $_POST['radio'];
  $currentDateTime = new DateTime('now');
  $currentDate = $currentDateTime->format('Y-m-d');

  $query = "INSERT INTO `quiz_t`(`tcr_id`, `quiz_title`, `quiz_dt`, `quiz_sub`) VALUES ('$tcr_id','$title','$currentDate','$subject')";
  if (mysqli_query($connection, $query)) {
    $query = "SELECT * FROM `quiz_t` WHERE `tcr_id` = '$tcr_id' AND `quiz_title` = '$title'";
    $results = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($results);
    header("Location: createQuiz2.php?quizID=".$row['quiz_id']."");
  }else {
    echo '<script>alert("Sorry, something went wrong. Please try again.")</script>';
  }
}
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <link rel="stylesheet" href="styles/teacher.css">
    <link rel="stylesheet" href="styles/quiz.css">
    <link rel="stylesheet" href="styles/flashcard.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
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

    <div class="create-quiz">
        <div class="header">
            <h1>Create Quiz</h1>
        </div>
        <form action="#" method="post">
            <label class="title">Enter Quiz Title: </label><br>
            <textarea name="title" rows="2" required></textarea><br><br>

            <label class="subject">Select Subject: </label><br>
            <div class="radio-buttons">
                  <label class="custom-radio ">
                    <input type="radio" name="radio" value="Bahasa Malaysia" checked />
                    <span class="radio-btn bm">
                      <div class="subject-icon ">
                        <i class="fa-solid fa-book"></i>
                        <h3>Bahasa Malaysia</h3>
                      </div>
                    </span>
                  </label>           
                  <label class="custom-radio">
                    <input type="radio" name="radio" value="English" checked />
                    <span class="radio-btn eng">
                      <div class="subject-icon">
                        <i class="fa-solid fa-comments"></i>
                        <h3>English</h3>
                      </div>
                    </span>
                  </label>
                  <label class="custom-radio">
                    <input type="radio" name="radio" value="Mathematics" checked />
                    <span class="radio-btn mt">
                      <div class="subject-icon">
                        <i class="fa-solid fa-ruler-combined"></i>
                        <h3>Mathematics</h3>
                      </div>
                    </span>
                  </label>
                  <br><br>
                  <label class="custom-radio">
                    <input type="radio" name="radio" value="Science" checked />
                    <span class="radio-btn sc">
                      <div class="subject-icon">
                        <i class="fa-solid fa-flask"></i>
                        <h3>Science</h3>
                      </div>
                    </span>
                  </label>
                  <label class="custom-radio">
                    <input type="radio" name="radio" value="History" checked />
                    <span class="radio-btn history">
                      <div class="subject-icon">
                        <i class="fa-solid fa-ship"></i>
                        <h3>History</h3>
                      </div>
                    </span>
                  </label>
                  <label class="custom-radio">
                    <input type="radio" name="radio" value="Pure Science" checked />
                    <span class="radio-btn puresc">
                      <div class="subject-icon">
                        <i class="fa-solid fa-microscope"></i>
                        <h3>Pure Science</h3>
                      </div>
                    </span>
                  </label>
            </div>
            <input type="submit" value="Next" name="next" class="next">
        </form>
    </div>
</body>
</html>
