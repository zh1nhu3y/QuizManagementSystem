<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Student Attempted Quiz History Page 
 -->
<?php
session_start();
include 'dbConn.php';
$stdID = $_SESSION['stdID'];
$query = "SELECT * FROM quiz_result_t INNER JOIN quiz_t ON quiz_result_t.quiz_id = quiz_t.quiz_id WHERE std_id = '$stdID'";
$results = mysqli_query($connection, $query);
$count = mysqli_num_rows($results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/student.css">
    <style>
        .title {
            text-align: center;
        }
        .title h1 {
            color: #FFEEB3;
            text-transform: uppercase;
            width: 100%;
        }
        .details {
            width: 50%;
            height: 145px;
            background: whitesmoke;
            margin: auto;
            /* border-left: 7px solid #3AA6B9; */
            box-sizing: border-box;
            /* padding: 0.5px 40px; */
            margin-bottom: 40px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 10px;
        }
        .details h2 {
            float: right;
            color: white;
            margin-top: -120px;
            margin-right: 50px;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
        }
        .clear {
            clear: both;
        }
        .details h4 {
            margin-top: -11px;
            color: #4E3636;
            padding: 0px 40px;
        }
        .details h1 {
            background-color: #A9907E;
            color: white;
            width: 100%;
            padding: 22px 40px;
            border-radius: 10px 10px 0 0;
            text-transform: uppercase;
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
    <section>
        <div class="title">
            <h1 style="font-size: 50px">History</h1>
        </div>
        <?php
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
        ?>
                <div class="details">
                    <h1><?php echo $row['quiz_title']; ?></h1>
                    <h4>Subject: <?php echo $row['quiz_sub']; ?></h4>
                    <h4>Attempt Date: <?php echo $row['atd_dt']; ?></h4>
                    <h2>Score: <?php echo $row['quiz_rs']; ?></h2>
                    <div class="clear"></div>
                </div>

                <?} else { ?>
        <?php }}
        mysqli_close($connection);
        ?>
    </section>
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