<!-- 
Programmer Name: Law Mei Jun
Program Name   : Quizify System
Description    : Quiz Page 
 -->
<?php
session_start();
include 'dbConn.php';
unset($_SESSION['score']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/student.css">
    <link rel="stylesheet" href="styles/studentMain.css">
    
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
        <h1 class="title">QUIZ</h1>
        <form action="#" method="post">
            <div class="search-bg">
                <input type="text" name="name" class="search-stuff" id="searchstf" placeholder="Search quiz..."></div>
                <div id="output"></div>
        </form>
        <div class= "search-icon">
            <i class="fa fa-search"></i>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
            $("#searchstf").keypress(function(){
                $.ajax({
                type:'POST',
                url:'search.php',
                data:{
                    name:$("#searchstf").val(), option:"quiz"
                },
                success:function(data){
                    $("#output").html(data);
                }
                });
            });
            });
        </script>

        <div class="subjects">
            <a href="quizSubject.php?subject=Bahasa%20Malaysia" class="bm"><i class="fa-solid fa-book"></i></a>
            <a href="quizSubject.php?subject=English" class="eng"><i class="fa-solid fa-comments"></i></a>
            <a href="quizSubject.php?subject=Mathematics" class="mt"><i class="fa-solid fa-ruler-combined"></i></a>
            <a href="quizSubject.php?subject=Science" class="sc"><i class="fa-solid fa-flask"></i></a>
            <a href="quizSubject.php?subject=History" class="sej"><i class="fa-solid fa-ship"></i></a>
            <a href="quizSubject.php?subject=Pure%20Science" class="puresc"><i class="fa-solid fa-microscope"></i></a>
        </div>
        <div class="subjects-title">
            <ul>
                <li>Bahasa Malaysia</li>
                <li>English</li>
                <li>Mathematics</li>
                <li>Science</li>
                <li>History</li>
                <li>Pure Science</li>
            </ul>
        </div>
    </section>
    <section>
        <div class="list left">
            <h1>Bahasa Malaysia</h1>
            <div class="row-1 malay">
            <?php 
            $query = "SELECT * FROM quiz_t WHERE quiz_sub = 'Bahasa Malaysia' LIMIT 2;";
            $results = mysqli_query($connection, $query);
            $count = mysqli_num_rows($results);
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
            ?>
                <a href="QuizFunction.php?quizID=<?php echo $row['quiz_id'];?>">
                    <h2>
                        <i class="fa-solid fa-book"></i>
                    </h2>
                    <div class="quiz-info">
                        <h3><?php echo $row['quiz_title']; ?></h3>
                    </div>
                </a>
            <?php }} ?>
            </div>
        </div>

        <div class="list right">
            <h1>English</h1>
            <div class="row-1 english">
            <?php 
            $query = "SELECT * FROM quiz_t WHERE quiz_sub = 'English' LIMIT 2;";
            $results = mysqli_query($connection, $query);
            $count = mysqli_num_rows($results);
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
            ?>
                <a href="QuizFunction.php?quizID=<?php echo $row['quiz_id'];?>">
                    <h2>
                        <i class="fa-solid fa-comments"></i>
                    </h2>
                    <div class="quiz-info">
                        <h3><?php echo $row['quiz_title']; ?></h3>
                    </div>
                </a>
            <?php }} ?> 
            </div>
        </div>
        <div class="clear"></div>
        <div class="list left">
            <h1>Mathematics</h1>
            <div class="row-1 maths">
            <?php 
            $query = "SELECT * FROM quiz_t WHERE quiz_sub = 'Mathematics' LIMIT 2;";
            $results = mysqli_query($connection, $query);
            $count = mysqli_num_rows($results);
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
            ?>
                <a href="QuizFunction.php?quizID=<?php echo $row['quiz_id'];?>">
                    <h2>
                        <i class="fa-solid fa-ruler-combined"></i>
                    </h2>
                    <div class="quiz-info">
                        <h3><?php echo $row['quiz_title']; ?></h3>
                    </div>
                </a>
            <?php }} ?> 
            </div>
        </div>

        <div class="list right">
            <h1>Science</h1>
            <div class="row-1 science">
            <?php 
            $query = "SELECT * FROM quiz_t WHERE quiz_sub = 'Science' LIMIT 2;";
            $results = mysqli_query($connection, $query);
            $count = mysqli_num_rows($results);
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
            ?>
                <a href="QuizFunction.php?quizID=<?php echo $row['quiz_id'];?>">
                    <h2>
                        <i class="fa-solid fa-flask"></i>
                    </h2>
                    <div class="quiz-info">
                        <h3><?php echo $row['quiz_title']; ?></h3>
                    </div>
                </a>
            <?php }} ?> 
            </div>
        </div>
        <div class="clear"></div>

        <div class="list left">
            <h1>History</h1>
            <div class="row-1 history">
            <?php 
            $query = "SELECT * FROM quiz_t WHERE quiz_sub = 'History' LIMIT 2;";
            $results = mysqli_query($connection, $query);
            $count = mysqli_num_rows($results);
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
            ?>
                <a href="QuizFunction.php?quizID=<?php echo $row['quiz_id'];?>">
                    <h2>
                        <i class="fa-solid fa-ship"></i>
                    </h2>
                    <div class="quiz-info">
                        <h3><?php echo $row['quiz_title']; ?></h3>
                    </div>
                </a>
            <?php }} ?> 
            </div>
        </div>

        <div class="list right">
            <h1>Pure Science</h1>
            <div class="row-1 pure-science">
            <?php 
            $query = "SELECT * FROM quiz_t WHERE quiz_sub = 'Pure Science' LIMIT 2;";
            $results = mysqli_query($connection, $query);
            $count = mysqli_num_rows($results);
            if ($count != 0) {
                while ($row = mysqli_fetch_assoc($results)) {
            ?>
                <a href="QuizFunction.php?quizID=<?php echo $row['quiz_id'];?>">
                    <h2>
                        <i class="fa-solid fa-microscope"></i>
                    </h2>
                    <div class="quiz-info">
                        <h3><?php echo $row['quiz_title']; ?></h3>
                    </div>
                </a>
            <?php }} ?> 
            </div>
        </div>
        <div class="clear"></div>

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