<!-- 
Programmer Name: Pan Zhin Huey
Program Name   : Quizify System
Description    : Teacher Create Quiz Page (question and answer)
 -->
<?php
session_start();
include 'dbConn.php';
$quizID = $_GET['quizID'];
$query = "SELECT * FROM `quiz_t` WHERE quiz_id = '$quizID'";
$results = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($results);
$title = $row['quiz_title'];
$subject = $row['quiz_sub'];

$query2 = "SELECT * FROM `quiz_ans_t` WHERE quiz_id = '$quizID'";
$results2 = mysqli_query($connection, $query2);
$count = mysqli_num_rows($results2);

if (isset($_POST['save'])) {
    $ques = $_POST['question'];
    $ansA = $_POST['answerA'];
    $ansB = $_POST['answerB'];
    $ansC = $_POST['answerC'];
    $ansD = $_POST['answerD'];
    $corrAns = $_POST['correct-ans'];

    $query3 = "INSERT INTO `quiz_ans_t`(`quiz_id`, `question`, `ans_a`, `ans_b`, `ans_c`, `ans_d`, `cor_ans`) VALUES ('$quizID','$ques','$ansA','$ansB','$ansC','$ansD','$corrAns')";
    if (mysqli_query($connection, $query3)) {
        header("Location: createQuiz2.php?quizID=".$quizID."");
    } else {
        echo '<script>alert("Sorry, something went wrong. Please try again.")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Quiz</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="styles/flashcard.css">
    <link rel="stylesheet" href="styles/quiz.css">
    <link rel="stylesheet" href="styles/teacher.css">
    <link rel="shortcut icon" href="media/logo.png" />
</head>
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
                    <a href="" class="sub-item">My Quiz</a>
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

    <div class="container">
        <div class="header">
            <h1><span style="color: #8F43EE; margin-right:10px;">Quiz Title:</span> <?php echo $title?></h1>
            <h2><span style="color: #F0EB8D; margin-right:10px;">Subject:</span> <?php echo $subject?></h2>
        </div>
        <!-- button -->
        <div class="add-quiz-con">
            <button id="add-quiz">Add Quiz Question</button>
            <button id = "save-quiz">Save</button>
        </div>
        <script>
            var saveBtn = document.getElementById("save-quiz");
            saveBtn.addEventListener("click", function() {
                location = "myQuiz.php";
                alert("Quiz Saved!");
            })
        </script>
        <div class="card-con">
            <div class="card-list-container">        
            <?php
                if ($count != 0) {
                    while ($row2 = mysqli_fetch_assoc($results2)) {
        
            ?>
                        <div class="card">
                            <p class="question-div" id="question-div"><?php echo $row2['question']; ?></p>
                            <div href="#" class="ans-title" id="show-hide-btn">Correct Answer:</div>
                            <p class="answer-div" id="answer-div"><?php echo $quizCorAns= $row2['cor_ans']; ?></p>
                            <div class="buttons-con">
                                <a href="editQuiz.php?quesID=<?php echo $row2['ques_id'] ?>" class="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="deleteQuiz.php?quesID=<?php echo $row2['ques_id']?>&quizID=<?php echo $quizID?>" class="delete"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
            <?php }} ?>
            </div>
        </div>
    </div>

    <form action="#" method="post">
        <div class="quiz-question-container hide" id="add-question-card">
            <h2>Add Quiz</h2>
            <div class="wrapper">
                <!-- Error message -->
                <div class="error-con">
                    <span class="hide" id="error">Input fields cannot be empty</span>
                </div>
                <!-- Close Button -->
                <i class="fa-solid fa-xmark xButton" id="close-btn"></i>
            </div>

            <label for="question">Question:</label>
            <textarea id="question" name="question" placeholder="Type the question here..." rows="4" required></textarea>

            <label for="answer">Answer A:</label>
            <textarea id="answer" name="answerA" rows="2" placeholder="Type the answer here..." required></textarea>
            
            <label for="answer">Answer B:</label>
            <textarea id="answer" name="answerB" rows="2" placeholder="Type the answer here..." required></textarea>
            
            <label for="answer">Answer C:</label>
            <textarea id="answer" name="answerC" rows="2" placeholder="Type the answer here..." required></textarea>
            
            <label for="answer">Answer D:</label>
            <textarea id="answer" name="answerD" rows="2" placeholder="Type the answer here..." required></textarea>
            <!-- <textarea id="answer" name="correct-ans" rows="1" placeholder="Type the correct answer here..." required></textarea> -->
            
            <label for="answer">Correct Answer:</label>
            <select name="correct-ans" id="answer">
                <option value="" disabled selected>Select The Correct Answer</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
            <input type="submit" value="Save" id="save-button" name="save">
        </div>
    </form>
    <script src="javaScript/quiz.js"></script>
    
</body>
</html>
<?php
mysqli_close($connection);
?>