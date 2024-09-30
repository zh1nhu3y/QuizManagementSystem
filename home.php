<!-- 
Programmer Name: Law Mei Jun, Pan Zhin Huey
Program Name   : Quizify System
Description    : Home Page 
 -->
<?php
session_start();
include 'dbConn.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuiZify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/student.css">
    <link rel="stylesheet" href="styles/home.css">
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
    <div class="main">
        <img src="./media/home.gif" alt="">
    </div>
    <section id="section1">
        <img src="media/bg2.jpg" alt="Elderly with Doctor" class="imgSection1">
        <div id="content1">
            <h1 style="color: red">WELCOME TO QUIZIFY</h1>
            <h3 style="color:#7a512f">"Unlock Your Knowledge with Interactive Flashcards and Engaging Quizzes!"</h3>
            <p>
            Welcome to our innovative flashcard and quiz system, where learning becomes a captivating and interactive experience. Whether you're a student looking to master new subjects or a lifelong learner seeking to expand your knowledge, our platform is designed to make studying engaging and effective.<br>
            </p>
            <button class="myButton" onclick="window.location.href = 'flashcard.php';">GET STARTED</button>
            <div class="clear"></div>
        </div>
    </section>
    <slideshow>
        <img class="mySlides" src="media/slide1.jpg">
        <button class="signBtn" onclick="window.location.href = '';">Sign Up Now</button>
        <div class="clear"></div>
    </slideshow>
    <section class="section-3">
        <h1 class="hidden">Why QuiZify?</h1>
        <div class="section2">
            <p class="content2 icn hidden" style="--order: 1">
                <img class="myIcon" src="media/card.png" alt="Flashcard Image">
                <br/>
                Thousands of</br>Flashcard
            </p>
            <p class="content2 icn hidden" style="--order: 2">
                <img class="myIcon" src="media/group.png" alt="Group of Students">
                <br/>
                Completely Free 
            </p>
            <p class="content2 icn hidden" style="--order: 3">
                <img class="myIcon" src="media/test.png" alt="Test Picture">
                <br/>
                Begin a Test
            </p>
        </div>
        <script>
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    console.log(entry)
                    if (entry.isIntersecting) {
                        entry.target.classList.add('show');
                    } 
                })
            })
            const hiddenElements = document.querySelectorAll('.hidden');
            hiddenElements.forEach((el) => observer.observe(el));
        </script>
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