<!-- 
Programmer Name: Pan Zhin Huey
Program Name   : Quizify System
Description    : FAQ Page
 -->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>How To Create Quiz</title>
    <link rel="shortcut icon" href="media/logo.png">
    <link rel="stylesheet" href="styles/student.css">
    <style>
        .qna h1 {
            color: #f9004d;
            font-size: 50px;
            margin-bottom: 30px;
            }

        .qna h2{
            color: #0A6EBD;
            }

        .qna ul li {
            font-size: large;
            color: #9DB2BF;
            margin-top: 30px;
            margin-bottom: 10px;
            }

            .qna ul {
             margin-top: 20px;
            margin: 70px 400px 50px 50px;
            text-align: justify;
            line-height: 1.6;
         }
            .qna p {
            margin-bottom: 20px;
            }
            .qna {
            margin-left: 100px;
            }
    </style>
</head>
<body style="background-color: black;">
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
    <div class="clear"></div>
    <section style="color: whitesmoke;">
            <div class="quizQues">
                <div class="qna">
                    <h1>FAQ</h1>
                    <h2>Here, you can find FAQ about QuiZify. Hope this helps!</h2>
                    <ul>
                        <li><b>How do I find quizzes that are relevant to my studies?</b></li>
                        <p>You can search for quizzes by subject, topic, or difficulty level. You can also browse our featured quizzes or take a look at the most popular quizzes.</p>

                        <li><b>How do I take a quiz?</b></li>
                        <p>To take a quiz, simply click on the "Take Quiz" button. You will be given a set of questions to answer. Once you have answered all of the questions, you will receive your score.</p>

                        <li><b>Can I create my own Quiz or Flashcards?</b></li>
                        <p>We understand that you might want to create your own quizzes and flashcards to test your knowledge or to help others learn. However, we want to ensure that all of the quizzes on our website are high-quality and accurate. That's why we only allow teachers to create quizzes.</p>

                        <li><b>What types of subjects and topics are covered in your quiz and flashcard database?</b></li>
                        <p>Our quiz and flashcard database covers a wide range of subjects and topics. Whether you're studying math, science, history and language learning, or even preparing for standardized exams, you'll find a vast collection of pre-made quizzes and flashcards. </p>

                        <li><b>How do I find flashcards and quizzes that are relevant to my studies?</b></li>
                        <p>You can search for flashcards and quizzes by subject or topic. You can also browse our featured flashcards and quizzes or take a look at the most popular flashcards and quizzes.</p>
                    </ul>
                </div>
            </div>
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