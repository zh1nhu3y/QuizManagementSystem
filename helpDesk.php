<!-- 
Programmer Name: Pan Zhin Huey
Program Name   : Quizify System
Description    : Teacher Help Desk Page 
 -->
<?php
session_start();
include 'dbConn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Helpdesk</title>
    <link rel="shortcut icon" href="media/logo.png" />
    <link rel="stylesheet" href="styles/teacher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <style>
        .qna h1 {
            color: #f9004d;
            font-size: 60px;
            margin-right: 50px;
            padding-top: 50px;
            text-align: center;
        }
        .qna ul li {
            color: #9DB2BF;
            margin-top: 30px;
            margin-bottom: 10px;
            font-size: 1.6em;
        }
        .qna ul {
            margin: 70px 0px 0px 70px;
            text-align: justify;
            line-height: 1.6;
        }
        .qna ul ol li {
            font-size: 16px;
            margin-left: 30px;
            margin-bottom: 20px;
            color: whitesmoke;
        }

        .qna {
            margin-left: 100px;
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
            <div class="item"><a href="teacherProfile.php"><i class="fas fa-user"></i>Profile</a></div>
            <div class="item"><a href="helpDesk.php"><i class="fas fa-circle-info"></i>Helpdesk</a></div>
            <div class="item"><a href="logout.php"><i class="fas fa-power-off"></i>Logout</a></div>

        </div>
    </div>
    <script src="javaScript/nav.js"></script>
    <section style="color: whitesmoke;">
        <div class="quizQues">
            <div class="qna">
                <h1>QuiZify Helpdesk</h1>
                <!-- <h2>Here, you can find FAQ about QuiZiz. Hope this helps!</h2> -->
                <ul>
                    <li><b>How to create Quiz?</b></li>
                    <ol>
                        <li>Open Create Quiz Page<br><i>Hamburger Menu -> Quiz -> Create Quiz</i></li>
                        <li>Enter Quiz Title </li>
                        <li>Select Quiz Subject and click <i>NEXT</i></li>
                        <li>Quiz Created! Teachers can now add Quiz Questions</li>
                    </ol>
                    <li><b>How to add Quiz Questions?</b></li>
                    <ol>
                        <li>Click <i>Add Quiz Question</i></li>
                        <li>Insert Question and Answers </li>
                        <li>Click <i>SAVE</i></li>
                        <li>Click <i>SAVE</i> to save all qestions in the created Quiz</li>
                    </ol>

                    <li><b>How to create flashcard?</b></li>
                    <ol>
                        <li>Open Create Flashcard Page<br><i>Hamburger Menu -> Flashcard -> Create Flashcard</i></li>
                        <li>Enter Flashcard Title </li>
                        <li>Select Flashcard Subject and click <i>NEXT</i></li>
                        <li>Flashcard Created! Teachers can now add Flashcard Questions</li>
                    </ol>

                    <li><b>How to Delete Quiz?</b></li>
                    <ol>
                        <li>Open My Quiz Page<br><i>Hamburger Menu -> Flashcard -> My Quiz</i></li>
                        <li>Find Quiz to delete and Press the Delete Icon</li>
                    </ol>

                    <li><b>How to Delete Flashcard?</b></li>
                    <ol>
                        <li>Open My Flashcard Page<br><i>Hamburger Menu -> Flashcard -> My Flashcard</i></li>
                        <li>Find Flashcard to delete and Press the Delete Icon</li>
                    </ol>

                    <li><b>How to Edit Quiz or Flashcard?</b></li>
                    <ol>
                        <li>Open My Quiz or My Flashcard Page<br></li>
                        <li>Find Quiz or Flashcard to edit and Press the Edit Icon</li>
                    </ol>
                </ul>
            </div>
        </div>
    </section>

</body>
</html>