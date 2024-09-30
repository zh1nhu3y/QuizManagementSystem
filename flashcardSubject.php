<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Flashcard of Selected Subject Page 
 -->
<?php
session_start();
include 'dbConn.php';
$subject = $_GET['subject'];
$query = "SELECT * FROM flashcard_t INNER JOIN teacher_t ON flashcard_t.tcr_id = teacher_t.tcr_id WHERE fc_sub = '$subject'";
$results = mysqli_query($connection, $query);
$count = mysqli_num_rows($results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $subject; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/student.css">
    <style>
        .title {
            color: #DAEAF1;
            text-align: center;
        }
        .title h1 {
            color: #5A96E3;
            text-transform: uppercase;
        }
        .details {
            width: 55%;
            height: 90px;
            background: whitesmoke;
            margin: auto;
            border-left: 7px solid #3AA6B9;
            box-sizing: border-box;
            padding: 0.5px 40px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .details a {
            float: right;
            /* text-decoration: none; */
            color: #068DA9;
            margin-top: -60px;
            /* margin-right: 30px; */
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
        }
        .details a:hover {
            color: #05BFDB;
        }
        .clear {
            clear: both;
        }
        .details h4 {
            margin-top: -11px;
            color: #090580;
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
            <h3 style="font-size: 35px;">Flashcard</h3>
            <h1 style="font-size: 50px; margin-top: -10px;"><?php echo $subject; ?></h1>
        </div>
        <?php
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
        ?>
                <div class="details">
                    <h1><?php echo $row['fc_title']; ?></h1>
                    <h4>By: <?php echo $row['tcr_fn'] . ' ' . $row['tcr_ln']; ?></h4>
                    <a href="FlashcardFunction.php?fcID=<?php echo $row['fc_id']; ?>">Start Now</a>
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