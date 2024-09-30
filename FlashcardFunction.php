<!-- 
Programmer Name: Shu Yee Feng
Program Name   : Quizify System
Description    : Flashcard Function Page 
 -->
<?php
session_start();
include 'dbConn.php';
if (!empty($_SESSION['stdID'])) {
    $fcID = $_GET['fcID'];
    $query = "SELECT * FROM flashcard_content_t WHERE fc_id = '$fcID'";
    $result = mysqli_query($connection, $query);
    $flashcards = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $query2 = "SELECT * FROM flashcard_t INNER JOIN teacher_t ON flashcard_t.tcr_id = teacher_t.tcr_id WHERE fc_id = '$fcID'";
    $result2 = mysqli_query($connection, $query2);
    $row2 = mysqli_fetch_assoc($result2);
?>

<!-- 
if (isset($_GET['subject'])) {
    $subject = $_GET['subject'];

    $query = "SELECT fc_ques, fc_ans FROM flashcard_content_t WHERE fc_id IN (SELECT fc_id FROM flashcard_t WHERE fc_sub = '$subject')";
    $result = mysqli_query($connection, $query);
    $flashcards = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {

    header("Location: previous_page.php");
    exit();
}
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/student.css">
    <style>
        body {
            background: black;
        }
        .flashcard-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .flashcard {
            width: 300px;
            height: 200px;
            perspective: 1000px;
            margin: 30px 40px;
        }

        .card {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.5s;
            margin-top: 70px;
        }

        .front,
        .back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 15px;
        }

        .front {
            background-color: #f1f1f1;
            padding-left: 20px;
            padding-right: 20px;
            text-align: center;
        }

        .back {
            background-color: #e9e9e9;
            padding-left: 20px;
            padding-right: 20px;
            text-align: center;
            transform: rotateX(180deg);
        }

        .flashcard.flipped .card {
            transform: rotateX(180deg);
        }

        .front p{
            font-size: 17px;
            color: black;
        }

        .back p{
            font-size: 17px;
            color: black;
        }

        .front h1{
            color: #4FC0D0;
        }

        .back h1{
            color: #164B60;
        }

        .fc-header {
            width: 100%;
            height: 50px;
            /* background-color: #333; */
            color: #fff;
            /* text-align: center; */
            /* line-height: 50px; */
        }
        .fc-header h1 {
            margin-left: 240px;
            margin-top: 50px;
            text-transform: uppercase;
            color: #C5DFF8;
            font-size: 39px;
        }
        .fc-header .fc-details {
            display: flex;
        }
        .fc-header .fc-details h2 {
            margin-left: 240px;
            margin-top: -10px;
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
        <a href="flashcard.php"><i class="fa-solid fa-xmark"></i></a>
        <h1><?php echo $row2['fc_title']; ?></h1><br>
        <div class="fc-details">
            <h2><span style="color: #7895CB; margin-right:10px;">Subject:</span> <?php echo $row2['fc_sub']; ?></h2>
        <h2><span style="color: #7895CB; margin-right:10px;">Created By:</span> <?php echo $row2['tcr_fn'] . ' ' . $row2['tcr_ln']; ?></h2>
        </div>
        
    </div>
    <br>
    <div class="clear"></div>
    <div class="flashcard-container">
        <?php
        $flashcardCount = 0;
        foreach ($flashcards as $flashcard) {
            $flashcardCount++;
            ?>
            <div class="flashcard">
                <div class="card">
                    <div class="front">
                        <h1>Question</h1>
                        <p><?php echo $flashcard['fc_ques']; ?></p>
                    </div>
                    <div class="back">
                        <h1>Answer</h1>
                        <p><?php echo $flashcard['fc_ans']; ?></p>
                    </div>
                </div>
            </div>
            <?php
            // Check if three flashcards have been displayed in the row
            if ($flashcardCount % 3 === 0) {
                echo '</div><div class="flashcard-container">';
            }
        }
        ?>
    </div>
    <br><br><br><br><br>
    <script>
        // Get all the flashcard elements
        const flashcards = document.querySelectorAll('.flashcard');

        // Add event listeners to each flashcard
        flashcards.forEach((card) => {
            card.addEventListener('click', () => {
                // Toggle the 'flipped' class to flip the card
                card.classList.toggle('flipped');
            });
        });
    </script>

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
    echo "<script> window.location.href='flashcard.php'; </script>";
}
mysqli_close($connection);
?>