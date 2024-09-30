<!-- 
Programmer Name: Shu Yee Feng
Program Name   : Quizify System
Description    : Quiz Function Page 
 -->
<?php
session_start();
include 'dbConn.php';
if (!empty($_SESSION['stdID'])) {
$quizId = $_GET['quizID']; // Replace with the ID of the quiz you want to retrieve
$query2 = "SELECT * FROM quiz_t INNER JOIN teacher_t ON quiz_t.tcr_id = teacher_t.tcr_id WHERE quiz_id = '$quizId'";
$result2 = mysqli_query($connection, $query2);
$row2 = mysqli_fetch_assoc($result2);

// Retrieve quiz questions and answers from the database

$query = "SELECT * FROM quiz_ans_t WHERE quiz_id = $quizId";
$result = mysqli_query($connection, $query);
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query3 = "SELECT * FROM quiz_result_t WHERE quiz_id ='$quizId'";
$results3 = mysqli_query($connection, $query3);
$count3 = mysqli_num_rows($results3);

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Initialize score
  $score = 0;

  // Loop through each question
  foreach ($questions as $question) {
    $quesId = $question['ques_id'];
    $selectedOption = $_POST['q' . $quesId];

    // Check if the selected option is correct
    if (strtolower($selectedOption) === strtolower($question['cor_ans'])) {
      $score++;
    }
  }

  // Store the score in the session
  $_SESSION['quiz_score'] = $score;
  $currentDateTime = new DateTime('now');
  $scores = $_SESSION['quiz_score'] . '/' . count($questions);
  $_SESSION ['score'] = $scores;
  unset ($_SESSION['quiz_score']);
  $currentDate = $currentDateTime->format('Y-m-d');
  $stdID = $_SESSION['stdID'];

  $query = "INSERT INTO `quiz_result_t`(`quiz_id`, `std_id`, `atd_dt`, `quiz_rs`) VALUES ('$quizId','$stdID','$currentDate','$scores')";
  $result = mysqli_query($connection, $query);
  // Redirect to the same page to avoid form resubmission
  header('Location: ' . $_SERVER['PHP_SELF']);
  header("Location: quizScore.php"); 
  // exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/student.css">
    <style>
    /* body {
      background-color: #f1f1f1;
      padding: 20px;
      background: black;
    } */

    h1 {
      text-align: center;
      color: white;
      font-size: 40px;
    }

    form {
      max-width: 800px;
      margin: 0 auto;
      background-color: #EEE2DE;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h3 {
      margin-bottom: 10px;
    }

    .question {
      background-color: #f9f9f9;
      border-radius: 4px;
      padding: 10px 20px;
      margin-bottom: 15px;
    }

    .question input[type="radio"] {
      margin-bottom: 10px;
    }

    input[type="submit"] {
      margin-top: 20px;
      display: block;
      width: 100%;
      padding: 10px;
      border-radius: 30px;
      background-color: #9BCDD2;
      color: #fff;
      font-weight: bold;
      border: none;
      cursor: pointer;
      text-transform: uppercase;
    }

    input[type="submit"]:hover {
      background-color: #A6D0DD;
    }

    .score-container {
      margin-top: 20px;
      text-align: center;
      display: <?php echo isset($_SESSION['quiz_score']) ? 'block' : 'none'; ?>;
    }

    .score-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      color: white;
    }

    .score-value {
      font-size: 36px;
      color: #4caf50;
    }
    .fc-header {
            width: 100%;
            height: 130px;
            /* background-color: #333; */
            color: #fff;
            /* text-align: center; */
            /* line-height: 50px; */
            /* margin-left: 360px; */
            
        }
        .fc-header h1 {
            text-align: left;
            margin-left: 360px;
            margin-top: 50px;
            color: #F2D8D8;
            text-transform: uppercase;
        }
        .fc-header .fc-details {
            display: flex;
        }
        .fc-header .fc-details h2 {
            margin-left: 360px;
            margin-top: -30px;
        }
        .fc-header a{
            text-decoration: none;
            float: right;
            margin-right: 40px;
        }
        .fc-header a i {
            color: white;
            font-size: 40px;
            margin-top: -20px;
        }
        .fc-header h3 {
          margin-left: 360px;
          margin-top: -5px;
        }
  </style>
</head>
<body>
    <div class="header">
        <nav>
            <div class="logo">
                <a href=""><img src="./media/logo.png" alt="" ></a>
            </div>
            <a href="home.php" class="logo1">QuiZify</a>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="quiz.php">Quiz</a></li>
                <li><a href="flashcard.php">Flashcard</a></li>
                <li><a href="">Help Centre</a>
                    <ul>
                        <li><a href="StdHowTo.php">FAQ</a></li>
                        <li><a href="StdHowTo.php">Contact Us</a></li>
                    </ul>
                </li>
            </ul>
            <div class="login">
            <?php
            if (!empty($_SESSION['stdID'])) {
            ?>
                <div class="profile-btn" onclick="toggleMenu()"><i class="fa fa-user"></i></div>
                <div class="profile-wrap" id="profileMenu">
                    <div class="profile">
                        <div class="name">
                            <h3><?php echo $_SESSION['stdFn'] . ' ' . $_SESSION['stdLn']; ?></h3>
                        </div>
                        <hr>
                        <a href="studentProfile.php" class="profile-link">
                            <i class="fa fa-user"></i>
                            <p>My Profile</p>
                            <span>></span>
                        </a>
                        <a href="studentHistory.php" class="profile-link">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <p>History</p>
                            <span>></span>
                        </a>
                        <a href="logout.php" class="profile-link">
                            <i class="fa fa-power-off"></i>
                            <p>Logout</p>
                            <span>></span>
                        </a>
                    </div>
                </div> 
            <?php } else { ?>
                <a href="login.php" class="btn">Login</a>
            <?php
            }
            ?>
            </div>
            <script src="javaScript/profile.js"></script>
        </nav>
    </div>
    <div class="fc-header">
        <a href="quiz.php"><i class="fa-solid fa-xmark"></i></a>
        <h1><?php echo $row2['quiz_title']; ?></h1><br>
        <div class="fc-details">
            <h2><span style="color: #FCAEAE; margin-right:10px;">Subject:</span> <?php echo $row2['quiz_sub']; ?></h2>
          <h2><span style="color: #FCAEAE; margin-right:10px;">Created By:</span> <?php echo $row2['tcr_fn'] . ' ' . $row2['tcr_ln']; ?></h2>
        </div>
        <h3><span style="color: #FCAEAE; margin-right:10px;"><i class="fa fa-user"></i></span>  <?php echo $count3 ?> Attempts</h3>
        
    </div>
    <br>
    <div class="clear"></div>
  <form id="quiz-form" method="post" action="">
    <?php foreach ($questions as $question) : ?>
      <div class="question">
        <h3><?php echo $question['question']; ?></h3>
        <input type="radio" name="q<?php echo $question['ques_id']; ?>" value="A"><?php echo $question['ans_a']; ?><br>
        <input type="radio" name="q<?php echo $question['ques_id']; ?>" value="B"><?php echo $question['ans_b']; ?><br>
        <input type="radio" name="q<?php echo $question['ques_id']; ?>" value="C"><?php echo $question['ans_c']; ?><br>
        <input type="radio" name="q<?php echo $question['ques_id']; ?>" value="D"><?php echo $question['ans_d']; ?><br>
      </div>
    <?php endforeach; ?>

    <input type="submit" value="Submit" id="submit-button">
  </form>
  <br>
  <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Home</h4>
                        <ul>
                            <li><a href="home.php">Home</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Quiz</h4>
                        <ul>
                            <li><a href="quizSubject.php?subject=Bahasa%20Malaysia">Bahasa Malaysia</a></li>
                            <li><a href="quizSubject.php?subject=English">English</a></li>
                            <li><a href="quizSubject.php?subject=Mathematics">Mathematics</a></li>
                            <li><a href="quizSubject.php?subject=Science">Science</a></li>
                            <li><a href="quizSubject.php?subject=History">History</a></li>
                            <li><a href="quizSubject.php?subject=Pure%20Science">Pure Science</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Flashcard</h4>
                        <ul>
                            <li><a href="flashcardSubject.php?subject=Bahasa%20Malaysia">Bahasa Malaysia</a></li>
                            <li><a href="flashcardSubject.php?subject=English">English</a></li>
                            <li><a href="flashcardSubject.php?subject=Mathematics">Mathematics</a></li>
                            <li><a href="flashcardSubject.php?subject=Science">Science</a></li>
                            <li><a href="flashcardSubject.php?subject=History">History</a></li>
                            <li><a href="flashcardSubject.php?subject=Pure%20Science">Pure Science</a></li>
                        </ul>
                </div>
                <div class="footer-col">
                    <h4>Help Centre</h4>
                        <ul>
                            <li><a href="StdHowTo.php">FAQ</a></li>
                            <li><a href="StdHowTo.php">Contact Us</a></li>
                        </ul>
                </div>
                <div class="footer-col"></li>
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
  </footer>
</body>
</html>
<?php


} else {
    echo '<script>alert("Please Login to Continue!")</script>';
    echo "<script> window.location.href='quiz.php'; </script>";
}
mysqli_close($connection);
?>